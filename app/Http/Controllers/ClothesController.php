<?php

namespace App\Http\Controllers;

use App\Models\Cloth;
use App\Models\Store;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class ClothesController extends Controller
{
    public function addClothes()
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'type' => 'required|string',
            'name' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'stored_in' => 'required|exists:storages,name',
            'quantity' => 'required|numeric',
            'price_per_piece' => 'required|numeric',
            'image_url' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
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
            return redirect()->back()->withErrors(["Storage not Found"]);
        };

        //Check if the quantity exceed the storage limit
        if ($this->getStorageLimit($storage) - (int) request('quantity') < 0) {
            return redirect()->back()->withErrors(["Limit Exceeded"]);
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

            if (request()->is('api/*')) {
                return $res;
            }
            return redirect()->route('Data Pakaian');
        } else {
            return redirect()->back()->withErrors(["Error"]);
        }
    }

    public function editClothes($id)
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'type' => 'required|string',
            'name' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'price_per_piece' => 'required|numeric|min:1',
            'description' => 'required|string',
            'image_url' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        // Find the cloth by ID
        $cloth = Cloth::find($id);

        // Check if the cloth exists
        if (!$cloth) {
            return redirect()->back()->withErrors(["Clothes not Found"]);
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

            if (request()->is('api/*')) {
                return $res;
            }
            return redirect()->route('Data Pakaian');
        } else {
            return redirect()->back()->withErrors(["Error"]);
        }
    }

    public function editStock($cloth_id, $storage_id)
    {
        //Validate Request
        $validator = Validator::make(request()->all(), [
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        // Find the cloth by ID
        $cloth = Cloth::find($cloth_id);

        // Check if the cloth exists
        if (!$cloth) {
            return redirect()->back()->withErrors(["Clothes not Found"]);
        }

        // Find the storage by ID
        $storage = Storage::find($storage_id);

        if (!$storage) {
            return redirect()->back()->withErrors(["Storage not Found"]);
        };

        // Delete the corresponding record in the pivot table
        $deletedRows = Store::where('cloth_id', $cloth_id)
            ->where('storage_id', $storage_id)
            ->delete();

        // Check if the record exists
        if ($deletedRows == 0) {
            return redirect()->back()->withErrors(["Stock not Found"]);
        }

        // Add the stock update
        $cloth->storages()->attach($storage, ['quantity' => request('quantity')]);

        $store = Store::where('cloth_id', $cloth_id)
            ->where('storage_id', $storage_id)
            ->get();

        if ($store) {
            if (request()->is('api/*')) {
                return response()->json(['store' => $store]);
            }
            return redirect()->route('Data Pakaian');
        } else {
            return redirect()->back()->withErrors(["Error"]);
        }
    }

    public function deleteClothes($id)
    {
        // Find the cloth by ID
        $cloth = Cloth::find($id);

        // Check if the cloth exists
        if (!$cloth) {
            return redirect()->back()->withErrors(["Clothes not Found"]);
        }

        // Delete the cloth
        if ($cloth->delete()) {
            if (request()->is('api/*')) {
                return response()->json(['message' => "Function Success"]);
            }
            return redirect()->route('Data Pakaian');
        } else {
            return redirect()->back()->withErrors(["Error"]);
        }
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

    public function getAllClothes()
    {
        $clothes = Cloth::all();

        // Check if the cloth exists
        if (!$clothes) {
            return redirect()->back()->withErrors(["Clothes not Found"]);
        }

        $clothes->each(function ($cloth) {
            // Attach total quantity to the cloth object
            $cloth->total_quantity = (int) $this->findClothWithTotalQuantity($cloth->id);
        });

        // Paginate the results for clothes
        $perPage = 10;
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

        // Return the clothes with total quantities
        if (request()->expectsJson() || request()->is('api/*')) {
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

        // Attach total quantity to the cloth object
        $clothes->total_quantity = (int) $this->findClothWithTotalQuantity($clothes->id);

        // Check if the cloth exists
        if (!$clothes) {
            return redirect()->back()->withErrors(["Clothes not Found"]);
        }

        // Return the clothes with total quantities
        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'clothes' => $clothes,
            ]);
        }

        // Return the clothes with total quantities
        return view('Clothes.data_pakaian', ['title' => 'Data Pakaian'], compact('clothes'));
    }

    public function getClothesDetail($id)
    {
        $clothes = Cloth::find($id);

        // Attach total quantity to the cloth object
        $clothes->total_quantity = (int) $this->findClothWithTotalQuantity($clothes->id);

        // Check if the cloth exists
        if (!$clothes) {
            return redirect()->back()->withErrors(["Clothes not Found"]);
        }

        // Return the clothes with total quantities
        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'clothes' => $clothes,
            ]);
        }

        // Return the clothes with total quantities
        return view('Clothes.deskripsi_pakaian', ['title' => 'Deskripsi Pakaian'], compact('clothes'));
    }

    //The params are optional in the URL
    public function getClothesbyAttribute()
    {
        $data = request()->all();

        // Convert buys_id from a comma-separated string to an array of integers
        if (isset($data['type'])) {
            $data['type'] = explode(',', $data['type']);
        }

        if (isset($data['size'])) {
            $data['size'] = explode(',', $data['size']);
        }

        if (isset($data['color'])) {
            $data['color'] = explode(',', $data['color']);
        }

        $validator = Validator::make($data, [
            'type' => 'sometimes|array|nullable',
            'size' => 'sometimes|array|nullable',
            'color' => 'sometimes|array|nullable',
            'price' => 'sometimes|numeric|nullable|min:1',
            'name' => 'sometimes|string|nullable',
            'sorting' => 'sometimes|in:0,1,2|nullable'
        ]);

        if ($validator->fails()) {
            // Handle validation failures
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $type = $validatedData['type'] ?? null;
        $size = $validatedData['size'] ?? null;
        $color = $validatedData['color'] ?? null;
        $price = $validatedData['price'] ?? null;
        $description = $validatedData['name'] ?? null;
        $sorting = $validatedData['sorting'] ?? null;

        // Build query conditions based on provided arguments
        $query = Cloth::query();

        if (!is_null($type)) {
            $query->whereIn('type', $type);
        }

        if (!is_null($size)) {
            $query->whereIn('size', $size);
        }

        if (!is_null($color)) {
            $query->whereIn('color', $color);
        }

        if (!is_null($price)) {
            $query->where('price_per_piece', '<=', $price);
        }

        if (!is_null($description)) {
            $query->where('name', 'like', '%' . $description . '%');
        }

        if (!is_null($sorting)) {
            if ($sorting == 0) {
                $query->orderBy('created_at', 'desc'); // Sort by created_at in descending order (newest first)
            } else if ($sorting == 1) {
                $query->orderBy('price_per_piece', 'asc'); // Sort by price in ascending order (low to high)
            } else if ($sorting == 2) {
                $query->orderBy('price_per_piece', 'desc'); // Sort by price in descending order (high to low)
            }
        }

        // Get the results
        $results = $query->get();

        // Iterate over each cloth
        $results->each(function ($cloth) {
            // Attach total quantity to the cloth object
            $cloth->total_quantity = (int) $this->findClothWithTotalQuantity($cloth->id);
        });


        // Paginate the results for clothes
        $perPage = 8;
        $page = request()->get('clothes_page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedResults = $results->slice($offset, $perPage);
        $clothes = new LengthAwarePaginator(
            $paginatedResults,
            $results->count(),
            $perPage,
            $page,
            ['path' => request()->fullUrl(), 'pageName' => 'clothes_page']
        );

        // Check if clothes exist
        if ($clothes->isEmpty()) {
            return redirect()->back()->withErrors(["Clothes not Found"]);
        }

        // Return the clothes with total quantities
        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'clothes' => $clothes,
            ]);
        }

        // Return the clothes with total quantities
        return view('Guest.all_products', ['title' => 'All Products'], compact('clothes'));
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

    public function getDataEditClothes($id)
    {
        $clothes = Cloth::find($id);

        // Check if the cloth exists
        if (!$clothes) {
            return redirect()->back()->withErrors(["Clothes not Found"]);
        }

        // Iterate over each cloth
        $clothes->each(function ($cloth) {
            // Attach total quantity to the cloth object
            $cloth->total_quantity = (int) $this->findClothWithTotalQuantity($cloth->id);
        });

        // Return the clothes with total quantities
        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'clothes' => $clothes,
            ]);
        }

        // Return the clothes with total quantities
        return view('Clothes.edit_pakaian', ['title' => 'Data Pakaian'], compact('clothes'));
    }

    //The params are optional in the URL
    public function getClothesbyAttributeAdmin()
    {
        $data = request()->all();

        // Convert buys_id from a comma-separated string to an array of integers
        if (isset($data['type'])) {
            $data['type'] = explode(',', $data['type']);
        }

        if (isset($data['size'])) {
            $data['size'] = explode(',', $data['size']);
        }

        if (isset($data['color'])) {
            $data['color'] = explode(',', $data['color']);
        }

        $validator = Validator::make($data, [
            'type' => 'sometimes|array|nullable',
            'size' => 'sometimes|array|nullable',
            'color' => 'sometimes|array|nullable',
            'price' => 'sometimes|numeric|nullable|min:1',
            'name' => 'sometimes|string|nullable',
            'sorting' => 'sometimes|in:0,1,2|nullable'
        ]);

        if ($validator->fails()) {
            // Handle validation failures
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $type = $validatedData['type'] ?? null;
        $size = $validatedData['size'] ?? null;
        $color = $validatedData['color'] ?? null;
        $price = $validatedData['price'] ?? null;
        $description = $validatedData['name'] ?? null;
        $sorting = $validatedData['sorting'] ?? null;

        // Build query conditions based on provided arguments
        $query = Cloth::query();

        if (!is_null($type)) {
            $query->whereIn('type', $type);
        }

        if (!is_null($size)) {
            $query->whereIn('size', $size);
        }

        if (!is_null($color)) {
            $query->whereIn('color', $color);
        }

        if (!is_null($price)) {
            $query->where('price_per_piece', '<=', $price);
        }

        if (!is_null($description)) {
            $query->where('name', 'like', '%' . $description . '%');
        }

        if (!is_null($sorting)) {
            if ($sorting == 0) {
                $query->orderBy('created_at', 'desc'); // Sort by created_at in descending order (newest first)
            } else if ($sorting == 1) {
                $query->orderBy('price_per_piece', 'asc'); // Sort by price in ascending order (low to high)
            } else if ($sorting == 2) {
                $query->orderBy('price_per_piece', 'desc'); // Sort by price in descending order (high to low)
            }
        }

        // Get the results
        $results = $query->get();

        // Iterate over each cloth
        $results->each(function ($cloth) {
            // Attach total quantity to the cloth object
            $cloth->total_quantity = (int) $this->findClothWithTotalQuantity($cloth->id);
        });


        // Paginate the results for clothes
        $perPage = 8;
        $page = request()->get('clothes_page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedResults = $results->slice($offset, $perPage);
        $clothes = new LengthAwarePaginator(
            $paginatedResults,
            $results->count(),
            $perPage,
            $page,
            ['path' => request()->fullUrl(), 'pageName' => 'clothes_page']
        );

        // Return the clothes with total quantities
        if (request()->expectsJson() || request()->is('api/*')) {
            return response()->json([
                'clothes' => $clothes,
            ]);
        }

        // Return the clothes with total quantities
        return view('Clothes.data_pakaian', ['title' => 'Data Pakaian'], compact('clothes'));
    }
}
