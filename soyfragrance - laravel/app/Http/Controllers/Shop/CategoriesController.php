<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop\Categories;

class CategoriesController extends Controller
{
    public function downloadCategories()
    {
        $categories = Categories::all();

        return response()->json(['categories' => $categories]);
    }

    public function downloadCategory($category_name)
    {
        $category = Categories::where('category_name', $category_name)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }
}
