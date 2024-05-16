<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Cloth;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuyController extends Controller
{
    public function addBuy(Request $request)
    {
        //Validate Request
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'cloth_id' => 'required|exists:cloths,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'payment_status' => 'integer',
            'confirmation_status' => 'integer',
        ]);

        $user = User::find($request->user_id);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()]);
        }

        // Find the cloth
         $cloth = Cloth::find($request->cloth_id);
         $storage = $cloth->storages()->first();

        //check if the quantity exceed the storage limit
        if ($storage->quantity_limit < $request->quantity) {
            return response()->json(['message' => 'Storage Quantity Exceeded'], 400);
        }

        // Create the buy record
        $cloth->users()->attach($user, [
            'quantity' => $request->quantity,
            'payment_method' => $request->payment_method,
            'payment_status' => 0,
            'confirmation_status' => 0
        ]);
        $buy = Buy::where('quantity', $request->quantity) 
        ->where('payment_method', $request->payment_method)
        ->where( 'payment_status' , $request->payment_status)
        ->where( 'confirmation_status' , $request->confirmation_status)->first();

        if ($cloth) {
            // Update the storage quantity
            $storage->quantity_limit -= $request->quantity;
            $storage->save();

            //check if the quantity exceed the storage limit
            if($storage->quantity_limit < 0) {
                return response()->json(['message' => 'Storage Quantity Exceeded'], 400);
            }

            // $res = response()->json([
            //     'buy' => $cloth
            // ]);'

            if ($request->is('api/*')) {
                return response()->json(['buy' => $buy], 201);
            } 
            return $this->getAllBuys();
        } else {
            return response()->json(['message' => "Failed"], 400);
        }
    }

    public function editBuy($id, Request $request)
    {
        //Validate Request
        $validator = Validator::make($request->all(), [
            'quantity' => 'integer|min:1',
            'payment_method' => 'string',
            'payment_status' => 'integer',
            'confirmation_status' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()]);
        }

        $buy = Buy::find($id);

        if (!$buy) {
            return response()->json(['message' => 'Buy not found'], 404);
        }

        $buy->update($request->all());

        if ($buy) {
            $res = response()->json([
                'buy' => $buy,
            ]);

            if ($request->is('api/*')) {
               return response()->json(['buy' => $buy], 201);
            }

            return $this->getAllBuys();
        } else {
            return response()->json(['message' => "Function Failed"], 400);
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
            return $this->getAllBuys();
        } else {
            return response()->json(['message' => "Function Failed"], 400);
        }
    }



    public function deleteBuy($id)
    {
        $buy = Buy::find($id);

        if (!$buy) {
            return response()->json(['message' => 'Buy not found'], 404);
        }

        if ($buy->delete()) {
            if (request()->is('api/*')) {
                return response()->json(['message' => "Successfully Deleted"], 200);
            }
            return $this->getAllBuys();
        } else {
            return response()->json(['message' => "Delete Failed"], 400);
        }
    }

    public function getAllBuys()
    {
        $buys = Buy::paginate(10);

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

        return view('Buy.data_pembelian', ['title' => 'Data Pembelian'], compact('buy'));
    }
}