<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\User;
use App\Models\Cloth;
use App\Models\Store;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;



class BuyController extends Controller
{
    public function addBuy(Request $request)
    {
        //Validate Request
        $validator = Validator::make($request->all(), [
            'cloth_id' => 'required|exists:cloths,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|int|in:0,1,2',
            'payment_status' => 'integer|in:0,1'
        ]);

        // Check if the user exists

        // if(!$user) {
        //     return response()->json(['message' => 'User not found'], 404);
        // }

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $user = auth()->user();
        // $user = User::find(1);
        // Find the cloth
        $cloth = Cloth::find($request->cloth_id);
        $storage = $cloth->storages()->first();

        // // Check if the cloth exists
        //  if(!$cloth) {
        //     return response()->json(['message' => 'Cloth not found'], 404);
        // }

        // Check if the storage exists
        if (!$storage) {
            return redirect()->back()->withErrors(['Storage not Found']);
        }

        if ($this->findClothWithTotalQuantity($cloth->id) < $request->quantity) {
            return redirect()->back()->withErrors(['Stock Not Enough!']);
        }

        // // Create the buy record
        // $cloth->users()->attach($user, [
        //     'quantity' => $request->quantity,
        //     'payment_method' => $request->payment_method,
        //     'payment_status' => 0,
        //     'confirmation_status' => 0
        // ]);

        $buy = Buy::where('user_id', $user->id)->where('cloth_id', $cloth->id)
            ->where('payment_method', 2)->where('payment_status', $request->payment_status)->where('confirmation_status', 0)->first();

        if ($buy) {
            $buy->quantity += $request->quantity;
            $buy->save();

            if ($request->is('api/*')) {
                return response()->json(['buy2' => $buy], 201);
            }
        } else {
            DB::transaction(function () use ($user, $cloth, $storage, $request) {
                $cloth->users()->attach($user, [
                    'quantity' => $request->quantity,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
                    'confirmation_status' => 0
                ]);
            });

            $buy = Buy::where('user_id', $user->id)
                ->where('cloth_id', $cloth->id)
                ->where('payment_method', $request->payment_method)
                ->where('payment_status', $request->payment_status)
                ->where('confirmation_status', 0)
                ->orderBy('updated_at', 'desc') // Sort by updated_at in descending order
                ->first();
        }

        // Update the stock
        $store = Store::where('storage_id', $storage->id)->where('cloth_id', $cloth->id)->first();
        $store->quantity -= $request->quantity;
        $store->save();

        // $buy = Buy::orderBy('id', 'desc')->first()

        // if ($request->is('api/*')) {
        //     return response()->json(['buy' => $buy], 201);
        // }

        if ($request->payment_method == 1) {
            $params = [
                "transaction_details" => [
                    "order_id" => "ORDER-" . $buy->id,
                    "gross_amount" => (float) $cloth->price_per_piece * (float) $buy->quantity
                ]
            ];

            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth"
            ])->timeout(30)
                ->retry(3, 1000)
                ->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

            if ($response->failed()) {
                if ($request->is('api/*')) {
                    return response()->json(['Error' => $response->status()], 201);
                }
                return redirect()->back()->withErrors(['Error Connecting to Midtrans']);
            }

            $redirect_url = json_decode($response->body())->redirect_url;

            $buy->update([
                'payment_url' => $redirect_url
            ]);

            if ($request->is('api/*')) {
                return response()->json(['url' => json_decode($response->body())], 201);
            }

            return redirect()->back()->with('url', $redirect_url);
        } else
            return redirect()->back();
    }

    public function payBatch(Request $request)
    {
        $data = $request->all();

        // Convert buys_id from a comma-separated string to an array of integers
        if (isset($data['buys_id'])) {
            $data['buys_id'] = array_map('intval', explode(',', $data['buys_id']));
        }

        $validator = Validator::make($data, [
            'buys_id' => 'required|array',
            'buys_id.*' => 'integer',
            'total_price' => 'required|integer',
            'payment_method' => 'required|integer|in:0,1',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        // Retrieve validated data
        $validatedData = $validator->validated();

        // Retrieve buys_id from validated data
        $buysId = $validatedData['buys_id'];

        if ($request->payment_method == 1) {
            $params = [
                "transaction_details" => [
                    "order_id" => "ORDER-B-" . implode('-', $buysId),
                    "gross_amount" => (float) request('total_price')
                ]
            ];

            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth"
            ])->timeout(30)
                ->retry(3, 1000)
                ->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

            $url = json_decode($response->body())->redirect_url;

            $affectedRows = Buy::whereIn('id', $buysId)->update(
                [
                    'payment_status' => 1,
                    'payment_method' => $request->payment_method,
                    'payment_url' => $url
                ]
            );

            return redirect()->back()->with('url', $url);
        } else {
            $affectedRows = Buy::whereIn('id', $buysId)->update(
                [
                    'payment_status' => 1,
                    'payment_method' => $request->payment_method
                ]
            );
            return redirect()->back();
        }
    }

    public function editBuy($id)
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $buy = Buy::find($id);

        if (!$buy) {
            return redirect()->back()->withErrors('Buy not Found');
        }

        $storage = $buy->cloth->storages()->first();

        // Update the stock
        $store = Store::where('storage_id', $storage->id)->where('cloth_id', $buy->cloth->id)->first();
        $current = $buy->quantity;

        if ($this->findClothWithTotalQuantity($buy->cloth->id) + (int) $current < (int) request()->quantity) {
            return redirect()->back()->withErrors(['Storage Quantity Exceeded!']);
        }

        $store->quantity -= ((int) request()->quantity - (int) $current);
        $store->save();


        $buy->update(request()->all());

        if ($buy) {
            $res = response()->json([
                'buy' => $buy,
            ]);

            if (request()->is('api/*')) {
                return response()->json(['buy' => $buy], 201);
            }

            return redirect()->route('Keranjang User');
        } else {
            return redirect()->back()->withErrors('Edit Failed');
        }
    }

    public function getDataEditKeranjang($id)
    {
        $buy = Buy::with('cloth')->find($id);

        $buy->cloth->total_quantity = (int) $this->findClothWithTotalQuantity($buy->cloth->id);

        if (!$buy) {
            return redirect()->back()->withErrors(['Buy not Found']);
        }

        if ($buy) {
            $res = response()->json([
                'buy' => $buy,
            ]);

            if (request()->is('api/*')) {
                return response()->json(['buy' => $buy], 201);
            }
            return view('User.edit_keranjang', ['title' => 'Edit Keranjang'], compact('buy'));
        } else {
            return redirect()->back()->withErrors('Edit Failed');
        }
    }

    public function deleteKeranjang($id)
    {
        $buy = Buy::find($id);

        if (!$buy) {
            return response()->json(['message' => 'Buy not found'], 404);
        }

        $storage = $buy->cloth->storages()->first();

        // Update the stock
        $store = Store::where('storage_id', $storage->id)->where('cloth_id', $buy->cloth->id)->first();
        $store->quantity += (int) $buy->quantity;
        $store->save();

        if ($buy->delete()) {
            if (request()->is('api/*')) {
                return response()->json(['message' => "Successfully Deleted"], 200);
            }
            return redirect()->route('Keranjang User');
        } else {
            return redirect()->back()->withErrors('Delete Failed');
        }
    }

    public function editPayment($id)
    {
        $buy = Buy::find($id);

        if (!$buy) {
            return response()->json(['message' => 'Buy not found'], 404);
        }

        $buy->update([
            'payment_status' => 1
        ]);

        if ($buy) {
            if (request()->is('api/*')) {
                return response()->json(['message' => "Successfully Confirmed"], 200);
            }
            return redirect()->route('Data Pembelian');
        } else {
            return redirect()->back()->withErrors('Change Failed');
        }
    }

    public function deleteBuy($id)
    {
        $buy = Buy::find($id);

        $storage = $buy->cloth->storages()->first();

        // Update the stock
        $store = Store::where('storage_id', $storage->id)->where('cloth_id', $buy->cloth->id)->first();
        $store->quantity += (int) $buy->quantity;
        $store->save();

        if (!$buy) {
            return response()->json(['message' => 'Buy not found'], 404);
        }

        if ($buy->delete()) {
            if (request()->is('api/*')) {
                return response()->json(['message' => "Successfully Deleted"], 200);
            }
            return redirect()->route('Data Pembelian');
        } else {
            return redirect()->back()->withErrors('Delete Failed');
        }
    }

    public function getAllBuys()
    {
        $buys = Buy::paginate(10, ['*'], 'buys_page');

        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'buys' => $buys,
            ]);
        }

        return view('Buy.data_pembelian', ['title' => 'Data Pembelian'], compact('buys'));
    }

    public function getBuyById($id)
    {
        $buy = Buy::find($id);

        if (!$buy) {
            return response()->json(['message' => 'Buy not found'], 404);
        }

        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'buy' => $buy,
            ]);
        }

        return view('Buy.edit_pembelian', ['title' => 'Data Pembelian'], compact('buy'));
    }

    public function getBuybyAttribute($user_id)
    {
        $validator = Validator::make(request()->all(), [
            'payment_method' => 'sometimes|in:0,1,2',
            'payment_status' => 'sometimes|in:0,1',
            'confirmation_status' => 'sometimes|in:0,1,2',
        ]);

        $payment_method = request('payment_method', null);
        $payment_status = request('payment_status', null);
        $confirmation_status = request('confirmation_status', null);

        // Build query conditions based on provided arguments
        $query = Buy::with('user'); // Eager load the user relationship

        if (!is_null($payment_method)) {
            $query->where('payment_method', $payment_method);
        }

        if (!is_null($payment_status)) {
            $query->where('payment_status', $payment_status);
        }

        if (!is_null($confirmation_status)) {
            $query->where('confirmation_status', $confirmation_status);
        }

        $query->where('user_id', $user_id);

        // Get the results
        $results = $query->orderBy('created_at', 'desc')->get();

        // Get user data
        $user = User::find($user_id);

        // Iterate over each cloth
        $results->each(function ($buy) {
            // Attach total total price to the cloth object
            $buy->total_price = (int) $buy->cloth->price_per_piece * (int) $buy->quantity;
        });

        // Paginate the results for clothes
        $perPage = 10;
        $page = request()->get('buys_page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedResults = $results->slice($offset, $perPage);
        $buys = new LengthAwarePaginator(
            $paginatedResults,
            $results->count(),
            $perPage,
            $page,
            ['path' => request()->fullUrl(), 'pageName' => 'buys_page']
        );

        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'buys' => $buys
            ]);
        }

        return view('Admin.detail_user', ['title' => 'Detail User', 'user' => $user], compact('buys'));
    }

    public function getBuybyAttributeCustomer()
    {
        $validator = Validator::make(request()->all(), [
            'payment_method' => 'sometimes|in:0,1,2',
            'payment_status' => 'sometimes|in:0,1',
            'confirmation_status' => 'sometimes|in:0,1,2',
        ]);

        $payment_method = request('payment_method', null);
        $payment_status = request('payment_status', null);
        $confirmation_status = request('confirmation_status', null);

        // Build query conditions based on provided arguments
        $query = Buy::with('cloth');

        if (!is_null($payment_method)) {
            $query->where('payment_method', $payment_method);
        }

        if (!is_null($payment_status)) {
            $query->where('payment_status', $payment_status);
        }

        if (!is_null($confirmation_status)) {
            $query->where('confirmation_status', $confirmation_status);
        }

        $query->where('user_id', auth()->user()->id);

        // Get the results
        $results = $query->orderBy('created_at', 'desc')->get();

        // Iterate over each cloth
        $results->each(function ($buy) {
            // Attach total total price to the cloth object
            $buy->total_price = (int) $buy->cloth->price_per_piece * (int) $buy->quantity;
        });

        // Paginate the results for clothes
        $perPage = 10;
        $page = request()->get('buys_page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedResults = $results->slice($offset, $perPage);
        $buys = new LengthAwarePaginator(
            $paginatedResults,
            $results->count(),
            $perPage,
            $page,
            ['path' => request()->fullUrl(), 'pageName' => 'buys_page']
        );

        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'buys' => $buys
            ]);
        }

        return view('User.histori_user', ['title' => 'Histori User'], compact('buys'));
    }

    public function getKeranjang()
    {

        // Build query conditions based on provided arguments
        $query = Buy::with('cloth')->where('user_id', auth()->user()->id)
            ->where('payment_status', 0)->where('payment_method', 2);

        // Get the results
        $results = $query->orderBy('created_at', 'desc')->get();

        // Iterate over each cloth
        $results->each(function ($buy) {
            // Attach total total price to the cloth object
            $buy->total_price = (int) $buy->cloth->price_per_piece * (int) $buy->quantity;
        });

        // Paginate the results for clothes
        $perPage = 10;
        $page = request()->get('buys_page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedResults = $results->slice($offset, $perPage);
        $buys = new LengthAwarePaginator(
            $paginatedResults,
            $results->count(),
            $perPage,
            $page,
            ['path' => request()->fullUrl(), 'pageName' => 'buys_page']
        );

        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'buys' => $buys
            ]);
        }

        return view('User.keranjang_user', ['title' => 'Keranjang User'], compact('buys'));
    }

    private function findClothWithTotalQuantity($clothId)
    {
        $cloth = Cloth::find($clothId);

        $totalQuantity = $cloth->storages()->sum('stores.quantity');

        if ($totalQuantity) {
            return $totalQuantity;
        } else {
            return 0;
        }
    }
}
