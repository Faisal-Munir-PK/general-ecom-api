<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{
    public function index() {
        $categoryTrees = Category::getTree();
        return response()->json($categoryTrees);
    }

    public function store(CategoryRequest $request) {

        $data = [];
        $imageUrl = '';
        if($request->has('image')) {
            $files = $request->file('image');
            $filename = Uuid::uuid4() .  $files->getClientOriginalName();
            $imageUrl = 'public/category_images/' . $filename;
            $files->move(public_path('category_images'), $filename);
        }
        $data = array_merge($data, $request->except('has_child', 'image'), ['image' => $imageUrl]);
        Category::create($data);
        if($request->input('has_child'))
            Category::whereId($request->input('category_id'))->update(['has_child' => true]);
        return response()->json('Category created');
    }

    public function update(Category $category, CategoryRequest $request) {
        $category->update($request->all());
        return response()->json('Category updated');
    }

    public function destroy(Category $category) {
        if($category->is_active)
            Category::whereId($category->id)->update(['is_active' => false]);
        else
            Category::whereId($category->id)->update(['is_active' => true]);
    }

    public function show(Category $category) {

        return $category::with('products')->get()->first();
    }
}

