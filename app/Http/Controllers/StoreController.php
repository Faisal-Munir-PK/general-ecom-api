<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return response()->json($stores);
    }

    public function store(StoreRequest $request)
    {
        // Check if store with the same name exists under the same company
        $existingStore = Store::where('name', $request->name)
            ->where('company_id', $request->company_id)
            ->first();
        if ($existingStore) {
            return response()->json(['error' => 'Store with the same name already exists under the same company'], 409); // Conflict
        }

        $store = Store::create($request->validated());
        return response()->json($store, 201);
    }

    public function show(Store $store)
    {
        return response()->json($store);
    }

    public function update(StoreRequest $request, Store $store)
    {
        // Check if store with the same name exists under the same company (excluding the current store)
        $existingStore = Store::where('name', $request->name)
            ->where('company_id', $store->company_id)
            ->where('id', '<>', $store->id)
            ->first();
        if ($existingStore) {
            return response()->json(['error' => 'Store with the same name already exists under the same company'], 409); // Conflict
        }

        $store->update($request->validated());
        return response()->json($store);
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return response()->json(['message' => 'Store deleted']);
    }
}