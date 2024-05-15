<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('isAdmin');
    // }

    public function test()
    {
        $params = [
            "transaction_details" => [
                "order_id" => "ORDER-113",
                "gross_amount" => 100000
            ]
        ];

        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth"
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

        $response = json_decode($response->body());

        return response()->json($response);
    }

    public function webhook(Request $request)
    {
        return redirect('http://fatto-a-manno-production.up.railway.app/');
    }
}
