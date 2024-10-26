<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    public function store(BrandRequest $request)
    {
        // Check if brand with the same name already exists
        $existingBrand = Brand::where('name', $request->name)->first();
        if ($existingBrand) {
            return response()->json(['error' => 'Brand with the same name already exists'], 409); // Conflict
        }

        $brand = Brand::create($request->validated());
        return response()->json($brand, 201);
    }

    public function show(Brand $brand)
    {
        return response()->json($brand);
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        // Check if brand with the same name already exists (excluding the current brand)
        $existingBrand = Brand::where('name', $request->name)
            ->where('id', '<>', $brand->id)
            ->first();
        if ($existingBrand) {
            return response()->json(['error' => 'Brand with the same name already exists'], 409); // Conflict
        }

        $brand->update($request->validated());
        return response()->json($brand);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(['message' => 'Brand deleted']);
    }
}

