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

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('isAdmin');
    // }

    //TEST MIDTRANS======================================================================================================================
    public function test()
    {
        $id = 17;

        $buy = Buy::find($id);
        $clothes = Cloth::find($buy->cloth_id);

        // return response()->json($buy);

        $params = [
            "transaction_details" => [
                "order_id" => "ORDER-" . $buy->id,
                "gross_amount" => (float) $clothes->price_per_piece * (float) $buy->quantity
            ]
        ];

        // return response()->json($params);

        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth"
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

        $response = json_decode($response->body());

        return redirect()->route("$response->redirect_url");

        // $cloth = Cloth::find(1);
        // $user = User::find(1);

        // // Assuming $cloth and $user are already defined
        // // Attach the Buy object to the Cloth and User relationship
        // $cloth->users()->attach($user, [
        //     'quantity' => 1,
        //     'payment_method' => 1,
        //     'payment_status' => 1,
        //     'confirmation_status' => 1
        // ]);

        // $buy = Buy::orderBy('id', 'desc')->first();

        // return response()->json($buy);
    }

    public function webhook(Request $request)
    {
        $req = $request->order_id;
        $id = (int) str_replace("ORDER-", "", $req);
        $buy = Buy::find($id);

        if (!$buy) {
            return response()->json([
                'error' => 'No transaction Found'
            ]);
        }

        $buy->update([
            'payment_status' => 1,
            'confirmation_status' => 1
        ]);

        return response()->json($buy);

        return redirect('http://fatto-a-manno-production.up.railway.app/');
    }
    //=============================================================================================================================

    public function getAllData()
    {
        $users = User::paginate(10);
        $clothes = Cloth::all();
        $storages = Storage::paginate(10);

        $clothes->each(function ($cloth) {
            // Attach total quantity to the cloth object
            $cloth->total_quantity = (int) $this->findClothWithTotalQuantity($cloth->id);
        });

        // Paginate the results
        $perPage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        // Slice the results to get the subset for the current page
        $paginatedResults = $clothes->slice($offset, $perPage);
        // Create a LengthAwarePaginator instance
        $clothes = new LengthAwarePaginator(
            $paginatedResults,
            $clothes->count(),
            $perPage,
            $page
        );

        return view('dashboard', [
            'title' => 'Dashboard',
            'users' => $users,
            'clothes' => $clothes,
            'storage' => $storages,
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
}
