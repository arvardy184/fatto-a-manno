<?php

namespace App\Http\Controllers;

use App\Models\Cloth;
use App\Models\Store;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClothesController extends Controller
{
    public function addClothes()
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'type' => 'required',
            'name' => 'required',
            'size' => 'required',
            'color' => 'required',
            'price_per_piece' => 'required',
            'description' => 'required',
            'image_url' => 'required',
            'stored_in' => 'required',
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()]);
        }

        $cloth = Cloth::create([
            'type' => request('type'),
            'name' => request('name'),
            'size' => request('size'),
            'color' => request('color'),
            'price_per_piece' => request('price_per_piece'),
            'description' => request('description'),
            'image_url' => request('image_url'),
        ]);

        //Get Storage Name
        $storage = Storage::where('name', request('stored_in'))->firstOrFail();

        if ($storage->fails()) {
            return response()->json([
                'message' => 'No Storage found'
            ], 404);
        };

        //Set Store Value
        $store = Store::create([
            'cloth_id' => $cloth->id,
            'storage_id' => $storage->id,
            'quantity' => request('quantity'),
        ]);

        if ($storage) {
            $res = response()->json([
                'clothes' => $cloth,
                'storage' => $storage,
                'store' => $store
            ]);
            return $res;
        } else {
            return response()->json(['message' => "Function Failed"], 400);
        }
    }

    public function editClothes($id)
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'type' => 'required',
            'name' => 'required',
            'size' => 'required',
            'color' => 'required',
            'price_per_piece' => 'required',
            'description' => 'required',
            'image_url' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()]);
        }

        // Find the cloth by ID
        $cloth = Cloth::find($id);

        // Check if the cloth exists
        if (!$cloth) {
            return response()->json(['message' => 'Clothes not found'], 404);
        }

        // Update the cloth with the new data
        $cloth->update([
            'type' => request('type'),
            'name' => request('name'),
            'size' => request('size'),
            'color' => request('color'),
            'price_per_piece' => request('price_per_piece'),
            'description' => request('description'),
            'image_url' => request('image_url')
        ]);

        if ($cloth) {
            $res = response()->json([
                'clothes' => $cloth,
            ]);
            return $res;
        } else {
            return response()->json(['message' => "Function Failed"], 400);
        }
    }

    public function editStock($cloth_id, $storage_id)
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()]);
        }

        //Edit Stock
        // Find the corresponding record in the pivot table
        $store = Store::where('cloth_id', $cloth_id)
            ->where('storage_id', $storage_id)
            ->first();

        // Check if the record exists
        if (!$store) {
            return response()->json(['message' => 'Stock not found'], 404);
        }

        // Update the 'quantity' column with the new value
        $store->update([
            'quantity' => request('quantity')
        ]);

        if ($store) {
            $res = response()->json([
                'store' => $store,
            ]);
            return $res;
        } else {
            return response()->json(['message' => "Function Failed"], 400);
        }
    }

    public function deleteClothes($id)
    {
        // Find the cloth by ID
        $cloth = Cloth::find($id);

        // Check if the cloth exists
        if (!$cloth) {
            return response()->json(['message' => 'Clothes not found'], 404);
        }

        // Delete the cloth
        if ($cloth->delete()) {
            return response()->json(['message' => "Function Success"]);
        } else {
            return response()->json(['message' => "Function Failed"], 400);
        }
    }

    public function findClothWithTotalQuantity($clothId)
    {
        $cloth = Cloth::find($clothId);

        $totalQuantity = $cloth->storages()->sum('stores.quantity');

        if ($totalQuantity) {
            return $totalQuantity;
        } else {
            return 0;
        }
    }

    public function getAllClothes()
    {
        // Retrieve all clothes
        $clothes = Cloth::all();

        // Iterate over each cloth
        $clothes->each(function ($cloth) {
            // Attach total quantity to the cloth object
            $cloth->total_quantity = (int) $this->findClothWithTotalQuantity($cloth->id);
        });

        // Return the clothes with total quantities
        return response()->json($clothes);
    }

    public function getClothesbyId($id)
    {
        $clothes = Cloth::find($id);

        // Check if the cloth exists
        if (!$clothes) {
            return response()->json(['message' => 'Clothes not found'], 404);
        }

        // Return the clothes with total quantities
        return response()->json([
            'clothes' => $clothes,
        ]);
    }
}
