<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buy;
use App\Models\User;
use App\Charts\Chart;
use App\Models\Cloth;
use App\Models\Store;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('isAdmin');
    // }

    //TEST MIDTRANS======================================================================================================================
    // public function test()
    // {
    //     $id = 17;

    //     $buy = Buy::find($id);
    //     $clothes = Cloth::find($buy->cloth_id);


    //     $params = [
    //         "transaction_details" => [
    //             "order_id" => "ORDER-" . $buy->id,
    //             "gross_amount" => (float) $clothes->price_per_piece * (float) $buy->quantity
    //         ]
    //     ];

    //     $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

    //     $response = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Content-Type' => 'application/json',
    //         'Authorization' => "Basic $auth"
    //     ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

    //     $response = json_decode($response->body())->redirect_url;

    //     return redirect()->route("$response->redirect_url");

    //     // $cloth = Cloth::find(1);
    //     // $user = User::find(1);

    //     // // Assuming $cloth and $user are already defined
    //     // // Attach the Buy object to the Cloth and User relationship
    //     // $cloth->users()->attach($user, [
    //     //     'quantity' => 1,
    //     //     'payment_method' => 1,
    //     //     'payment_status' => 1,
    //     //     'confirmation_status' => 1
    //     // ]);

    //     // $buy = Buy::orderBy('id', 'desc')->first();

    //     // return response()->json($buy);
    // }

    public function webhook(Request $request)
    {
        $req = $request->order_id;
        if (strpos($req, 'ORDER-B-') !== false) {
            // Remove the prefix
            $ids_string = str_replace('ORDER-B-', '', $req);

            $ids = array_map('intval', explode('-', $ids_string));
        } else {
            $ids[] = (int) str_replace("ORDER-", "", $req);
        }

        $affectedRows = Buy::whereIn('id', $ids)->update([
            'payment_status' => 1,
            'confirmation_status' => 1,
            'payment_url' => null
        ]);

        return response()->json($affectedRows);

        // return redirect('http://fatto-a-manno-production.up.railway.app/');
    }
    //=============================================================================================================================

    public function getAllData()
    {
        $users = User::paginate(10, ['*'], 'users_page');
        $storages = Storage::paginate(10, ['*'], 'storages_page');

        $clothes = Cloth::all();
        $clothes->each(function ($cloth) {
            // Attach total quantity to the cloth object
            $cloth->total_quantity = (int) $this->findClothWithTotalQuantity($cloth->id);
        });

        // Paginate the results for clothes
        $perPage = 8;
        $page = request()->get('clothes_page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedResults = $clothes->slice($offset, $perPage);
        $clothes = new LengthAwarePaginator(
            $paginatedResults,
            $clothes->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'clothes_page']
        );

        return view('dashboard', [
            'title' => 'Dashboard',
            'users' => $users,
            'clothes' => $clothes,
            'storages' => $storages,
        ]);
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

    public function confirmPayment($id)
    {
        $validator = Validator::make(request()->all(), [
            'confirmation_status' => 'required|in:1,2'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $buy = Buy::find($id);

        if (!$buy) {
            return response()->json(['message' => 'Buy not found'], 404);
        }

        $buy->update([
            'confirmation_status' => request('confirmation_status')
        ]);

        if (request('confirmation_status') == 2) {
            $storage = $buy->cloth->storages()->first();

            // Update the stock
            $store = Store::where('storage_id', $storage->id)->where('cloth_id', $buy->cloth->id)->first();
            $store->quantity += (int) $buy->quantity;
            $store->save();
        }

        if ($buy) {
            if (request()->is('api/*')) {
                return response()->json(['message' => "Successfully Confirmed"], 200);
            }
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('Function Failed');
        }
    }

    public function getAnalysis(Chart $chart)
    {
        // Define the validation rules
        $validator = Validator::make(request()->all(), [
            'month' => 'sometimes|integer|min:1|max:12|nullable',
            'year' => 'sometimes|integer|nullable',
            'clothes_type' => 'sometimes|string|nullable',
            'clothes_color' => 'sometimes|string|nullable',
        ]);

        if ($validator->fails()) {
            // Handle validation failures
            // return redirect()->back()->withErrors($validator)->withInput();
            return response()->json(['Error']);
        }

        // Get the validated data
        $validatedData = $validator->validated();

        // Ensure all expected parameters are set, default to null if not provided
        $month = $validatedData['month'] ?? null;
        $year = $validatedData['year'] ?? date('Y');
        $clothesType = $validatedData['clothes_type'] ?? null;
        $clothesColor = $validatedData['clothes_color'] ?? null;

        // Start building the query
        $query = Buy::with('cloth');

        // Apply filters based on validated data
        if (!is_null($month)) {
            $query->whereMonth('created_at', $month);
            $query->whereYear('created_at', $year);
        } else {
            if (!is_null($year)) {
                $query->whereYear('created_at', $year);
            }
        }

        if (!is_null($clothesType) || !is_null($clothesColor)) {
            $query->whereHas('cloth', function ($q) use ($clothesType, $clothesColor) {
                if (!is_null($clothesType)) {
                    $q->where('type', $clothesType);
                }
                if (!is_null($clothesColor)) {
                    $q->where('color', $clothesColor);
                }
            });
        }

        // Determine how to group the results
        if (!is_null($month)) {
            // Group by day if month is provided
            $results = $query->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->get();
        } else {
            // Group by month if month is not provided
            $results = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->get();
        }

        if (request()->is('api/*')) {
            return response()->json(['results' => $results]);
        }
        // Return the results as JSON (or modify as needed)
        return view();
    }

    public function anal(Chart $chart)
    {
        // Define the validation rules
        $validator = Validator::make(request()->all(), [
            'month' => 'sometimes|integer|min:1|max:12|nullable',
            'year' => 'sometimes|integer|nullable',
            'clothes_type' => 'sometimes|string|nullable',
            'clothes_color' => 'sometimes|string|nullable',
        ]);

        if ($validator->fails()) {
            // Handle validation failures
            return response()->json(['Error' => $validator->errors()]);
        }

        // Get the validated data
        $validatedData = $validator->validated();

        // Ensure all expected parameters are set, default to null if not provided
        $month = $validatedData['month'] ?? null;
        $year = $validatedData['year'] ?? date('Y');
        $clothesType = $validatedData['clothes_type'] ?? null;
        $clothesColor = $validatedData['clothes_color'] ?? null;

        return view('Admin.chart', ['title' => 'Analisa', 'chart' => $chart->build(5, 2024, $clothesType, $clothesColor)]);
    }
}
