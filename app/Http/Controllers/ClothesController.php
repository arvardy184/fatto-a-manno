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
            'stored_in' => 'required|exists:storages,name',
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()]);
        }

        // Check if the same clothes exist
        $exist_clothes = Cloth::where('type', request('type'))
            ->where('name', request('name'))
            ->where('size', request('size'))
            ->where('color', request('color'))
            ->first();

        //Get Storage Name
        $storage = Storage::where('name', request('stored_in'))->first();

        if (!$storage) {
            return response()->json([
                'message' => 'No Storage found'
            ], 404);
        };

        //Check if the quantity exceed the storage limit
        if ($this->getStorageLimit($storage) - (int) request('quantity') < 0) {
            return response()->json([
                'message' => 'Storage Quantity Exceeded'
            ], 404);
        }

        if ($exist_clothes) {

            // Assuming $cloth and $storage are instances of Cloth and Storage models respectively
            $exist_clothes->storages()->attach($storage, ['quantity' => request('quantity')]);

            $res = response()->json([
                'clothes' => $exist_clothes,
                'storage' => $storage
            ]);
            return $res;
        };

        //Create Cloth Instance
        $cloth = Cloth::create([
            'type' => request('type'),
            'name' => request('name'),
            'size' => request('size'),
            'color' => request('color'),
            'price_per_piece' => request('price_per_piece'),
            'description' => request('description'),
            'image_url' => request('image_url'),
        ]);

        // Assuming $cloth and $storage are instances of Cloth and Storage models respectively
        $cloth->storages()->attach($storage, ['quantity' => request('quantity')]);

        if ($storage) {
            $res = response()->json([
                'clothes' => $cloth,
                'storage' => $storage
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

        // Find the cloth by ID
        $cloth = Cloth::find($cloth_id);

        // Check if the cloth exists
        if (!$cloth) {
            return response()->json(['message' => 'Clothes not found'], 404);
        }

        // Find the storage by ID
        $storage = Storage::find($storage_id);

        if (!$storage) {
            return response()->json([
                'message' => 'No Storage found'
            ], 404);
        };

        // Delete the corresponding record in the pivot table
        $deletedRows = Store::where('cloth_id', $cloth_id)
            ->where('storage_id', $storage_id)
            ->delete();

        // Check if the record exists
        if ($deletedRows == 0) {
            return response()->json(['message' => 'Stock not found'], 404);
        }

        // Add the stock update
        $cloth->storages()->attach($storage, ['quantity' => request('quantity')]);

        $store = Store::where('cloth_id', $cloth_id)
            ->where('storage_id', $storage_id)
            ->get();

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

        if (request()->is('api/*')) {
            return response()->json([
                'clothes' => $clothes,
            ]);
        }

        // Return the clothes with total quantities
        return view('Clothes.data_pakaian', ['title' => 'Data Pakaian'], compact('clothes'));
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

    public function getStorageLimit($storage)
    {
        // Retrieve all clothes
        $clothes = Cloth::all();
        $sum = 0;

        // Iterate over each cloth
        $clothes->each(function ($cloth) use (&$sum) {
            // Attach total quantity to the cloth object
            $sum += (int) $this->findClothWithTotalQuantity($cloth->id);
        });

        $limit = (int) $storage->quantity_limit - $sum;

        return $limit;
    }
}