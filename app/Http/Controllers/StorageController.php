<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StorageController extends Controller
{
    public function addStorage()
    {
        // Validate Request
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'quantity_limit' => 'required',
            'address' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        $storage = Storage::create([
            'name' => request('name'),
            'quantity_limit' => request('quantity_limit'),
            'address' => request('address')
        ]);

        if (request()->is('api/*')) {
            return response()->json(['storage' => $storage], 201);
        }

        return $this->getAllStorage();
    }

    public function editStorage($id)
    {
        // Validate Request
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'quantity_limit' => 'required',
            'address' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        // Find storage by ID
        $storage = Storage::find($id);

        // Check if storage exists
        if (!$storage) {
            return response()->json(['error' => 'Storage not found'], 404);
        }

        // Update storage details and save
        $storage->update([
            'name' => request('name'),
            'quantity_limit' => request('quantity_limit'),
            'address' => request('address')
        ]);

        if (request()->is('api/*')) {
            return response()->json(['storage' => $storage], 201);
        }

        return $this->getAllStorage();
    }

    public function deleteStorage($id)
    {
        // Find storage by ID
        $storage = Storage::find($id);

        // Check if storage exists
        if (!$storage) {
            return response()->json(['error' => 'Storage not found'], 404);
        }

        // Delete storage
        $storage->delete();

        if (request()->is('api/*')) {
            return response()->json(['message' => 'Storage deleted successfully'], 200);
        }

        return $this->getAllStorage();
    }

    public function getAllStorage()
    {
        // Get all storages
        $storages = Storage::paginate(10);

        if (request()->is('api/*')) {
            return response()->json(['storages' => $storages], 200);
        }
        // Return the clothes with var
        return view('view.view', ['title' => 'View'], compact('var'));
    }

    public function getStoragebyId($id)
    {
        // Find storage by ID
        $storage = Storage::find($id);

        // Check if storage exists
        if (!$storage) {
            return response()->json(['error' => 'Storage not found'], 404);
        }

        if (request()->is('api/*')) {
            return response()->json(['storage' => $storage], 200);
        }

        // Return the clothes with var
        return view('view.view', ['title' => 'View'], compact('var'));
    }
}
