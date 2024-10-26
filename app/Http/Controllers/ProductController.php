<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        $companyId = $request->header('company_id');
        if (!$companyId) {
            return response()->json(['error' => 'Company ID not provided'], 400);
        }

        $query = Product::where('company_id', $companyId);
        if ($request->has('categories') && !empty($request->get('categories'))) {
            $categories = $request->get('categories');
            $query->whereIn('category_id', $categories);
        }

        if ($request->has('brands') && !empty($request->get('brands'))) {
            $brands = $request->get('brands');
            $query->whereIn('brand_id', $brands);
        }
        if ($request->has('colors') && !empty($request->get('colors'))) {
            $colors = $request->get('colors');
            $query->whereJsonContains('colors', $colors);
        }

        if ($request->has('price') && count($request->get('price')) === 2) {
            [$minPrice, $maxPrice] = $request->get('price');
            $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
        }

        if ($request->has('sizes') && !empty($request->get('sizes'))) {
            $sizes = $request->get('sizes');
            $query->whereJsonContains('sizes', $sizes);
        }

        if ($request->has('materials') && !empty($request->get('materials'))) {
            $materials = $request->get('materials');
            $query->whereJsonContains('materials', $materials);
        }

        if ($request->has('availability') && !empty($request->get('availability'))) {
            $availability = $request->get('availability');
        
            // Check if 'In Stock' and 'Out of Stock' are both present, in which case we ignore the filter
            if (!in_array('In Stock', $availability) || !in_array('Out of Stock', $availability)) {
                // If only 'In Stock' is present, filter by stock > 0
                if (in_array('In Stock', $availability)) {
                    $query->where('stock', '>', 0);
                }
        
                // If only 'Out of Stock' is present, filter by stock == 0
                if (in_array('Out of Stock', $availability)) {
                    $query->where('stock', '=', 0);
                }
            }
        }

        $perPage = $request->get('per_page', 15);
        $currentPage = $request->get('current_page', 1);

        $products = $query->paginate($perPage, ['*'], 'page', $currentPage);

        $products->getCollection()->transform(function ($product) {
            $product->image = $product->image;
            $product->colors = $product->colors;
            $product->sizes = $product->sizes;
            $product->description = $product->description;
            $product->meta = $product->meta;
            return $product;
        });

        return response()->json($products);
    }

    public function store(ProductRequest $request)
    {
        $existingProduct = Product::where('title', $request->title)
            ->where('store_id', $request->store_id)
            ->where('price', $request->price)
            // Add additional property checks here, like colors, sizes, etc.
            ->first();
        if ($existingProduct) {
            return response()->json(['error' => 'Product with the same properties already exists for the same store'], 409); // Conflict
        }

        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }
    public function getProductBySlug($slug)
    {
        // Retrieve the product by its slug
        $product = Product::where('slug', $slug)->first();
        // Check if product exists
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Return the product as JSON
        return response()->json($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        // Check if a product with the same properties exists for the same store (excluding the current product)
        $existingProduct = Product::where('title', $request->title)
            ->where('store_id', $product->store_id)
            ->where('id', '<>', $product->id)
            ->first();
        if ($existingProduct) {
            return response()->json(['error' => 'Product with the same properties already exists for the same store'], 409); // Conflict
        }

        $product->update($request->validated());
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }

    public function getProductsByParams(Request $request)
    {
        $query = Product::query();
        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }
        if ($request->has('colors') && count($request->colors) !== 0) {
            $query->where(function ($innerQuery) use ($request) {
                foreach ($request->colors as $color) {
                    $innerQuery->orWhereRaw("JSON_CONTAINS(colors, '\"$color\"')");
                }
            });
        }
        if ($request->has('price') && count($request->price) !== 0) {
            $query->whereBetween('price', $request->price);
        }
        if ($request->has('sizes') && count($request->sizes) !== 0) {
            $query->where(function ($innerQuery) use ($request) {
                foreach ($request->sizes as $size) {
                    $innerQuery->orWhereRaw("JSON_CONTAINS(sizes, '\"$size\"')");
                }
            });
        }
        if ($request->has('materials') && count($request->materials) !== 0) {
            $query->whereIn('material', $request->materials);
        }
        if ($request->has('availability') && count($request->availability) !== 0) {
            $query->whereIn('stock', $request->availability);
        }
        if ($request->has('brands') && count($request->brands) !== 0) {
            $query->whereIn('brand_id', $request->brands);
        }
        if ($request->has('discount') && count($request->discount) !== 0) {
            $query->whereIn('discount', $request->discount);
        }
        $products = $query->get()->map(function ($product) {
            $product->image = json_decode($product->image, true);
            $product->colors = json_decode($product->colors, true);
            $product->sizes = json_decode($product->sizes, true);
            $product->description = json_decode($product->description, true);
            $product->meta = json_decode($product->meta, true);
            return $product;
        });
        return response()->json($products);
    }

}