<?php

namespace App\Http\Controllers;

use App\Models\Cloth;
use App\Models\Store;
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
            return redirect()->back()->withErrors($validator->messages());
        }

        $storage = Storage::create([
            'name' => request('name'),
            'quantity_limit' => request('quantity_limit'),
            'address' => request('address')
        ]);

        if (request()->is('api/*')) {
            return response()->json(['storage' => $storage], 201);
        }

        return redirect()->route('Data Gudang');
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
            return redirect()->back()->withErrors($validator->messages());
        }

        // Find storage by ID
        $storage = Storage::find($id);

        // Check if storage exists
        if (!$storage) {
            return redirect()->back()->withErrors(["Storage not Found"]);
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

        return redirect()->route('Data Gudang');
    }

    public function deleteStorage($id)
    {
        // Find storage by ID
        $storage = Storage::find($id);

        // Check if storage exists
        if (!$storage) {
            return redirect()->back()->withErrors(["Storage not Found"]);
        }

        // Delete storage
        $storage->delete();

        if (request()->is('api/*')) {
            return response()->json(['message' => 'Storage deleted successfully'], 200);
        }

        return redirect()->back();
    }

    public function getAllStorage()
    {
        // Get all storages
        $storages = Storage::paginate(10, ['*'], 'storages_page');

        if (request()->is('api/*')) {
            return response()->json(['storages' => $storages], 200);
        }

        // Return the clothes with var
        return view('Storage.data_storage', ['title' => 'Data Storage'], compact('storages'));
    }

    public function getStoragebyId($id)
    {
        // Find storage by ID
        $storages = Storage::find($id);

        // Check if storage exists
        if (!$storages) {
            return redirect()->back()->withErrors(["Storage not Found"]);
        }

        if (request()->is('api/*')) {
            return response()->json(['storage' => $storages], 200);
        }

        // Return the clothes with var
        return view('Storage.data_storage', ['title' => 'Data Storage'], compact('storages'));
    }

    public function getDataEditStorage($id)
    {
        // Find storage by ID
        $storages = Storage::find($id);

        // Check if storage exists
        if (!$storages) {
            return redirect()->back()->withErrors(["Storage not Found"]);
        }

        if (request()->is('api/*')) {
            return response()->json(['storage' => $storages], 200);
        }

        // Return the clothes with var
        return view('Storage.edit_storage', ['title' => 'Edit Storage'], compact('storages'));
    }

    public function getStorageDetail($id)
    {
        // Find storage by ID
        $storage = Storage::find($id);

        // Check if storage exists
        if (!$storage) {
            return redirect()->back()->withErrors(["Storage not Found"]);
        }

        $stores = Store::where('storage_id', $storage->id)->paginate(10, ['*'], 'stores');

        if (request()->is('api/*')) {
            return response()->json(['stores' => $stores], 200);
        }

        // Return the clothes with var
        return view('Storage.detail_items', ['title' => 'Detail Item'], compact('stores'));
    }

    public function editStock($id)
    {
        $validator = Validator::make(request()->all(), [
            'quantity' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        //Find Store
        $store = Store::find('id', $id);
        $store->update([
            'quantity' => request('quantity')
        ]);

        // Check if storage exists
        if (!$store) {
            return redirect()->back()->withErrors(["Storage not Found"]);
        }

        if (request()->is('api/*')) {
            return response()->json(['stores' => $store], 200);
        }

        // Return the clothes with var
        return redirect()->route('Detail Items');
    }
}
