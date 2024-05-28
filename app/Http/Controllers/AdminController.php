<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\User;
use App\Models\Cloth;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

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
            'confirmation_status' => 1
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

        if ($buy) {
            if (request()->is('api/*')) {
                return response()->json(['message' => "Successfully Confirmed"], 200);
            }
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('Function Failed');
        }
    }
}
