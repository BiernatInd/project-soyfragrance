<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPanel\CategoriesAdmin;

class CategoriesController extends Controller
{
    public function downloadCategories()
    {
        $categories = CategoriesAdmin::all();

        return response()->json(['categories' => $categories]);
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string',
        ]);

        $categories = new CategoriesAdmin;
        $categories->category_name = $request->input('category_name');

        $categories->save();

        return response()->json(['message' => 'Kategoria dodana pomyślnie'], 201);
    }

    public function deleteCategory($id)
    {
        $categories = CategoriesAdmin::find($id);

        if (!$categories) {
            return response()->json(['error' => 'Kategoria nie został znaleziona.'], 404);
        }

        $categories->delete();

        return response()->json(['message' => 'Kategoria została pomyślnie usunięta.']);
    }

    public function editCategoryName(Request $request, $id)
    {
        $request->validate([
            'newCategoryName' => 'required|string|max:255',
        ]);

        $categories = CategoriesAdmin::find($id);

        if (!$categories) {
            return response()->json(['error' => 'Kategoria nie została znaleziona.'], 404);
        }

        $categories->category_name = $request->input('newCategoryName');
        $categories->save();

        return response()->json(['message' => 'Nazwa kategorii została zaktualizowana pomyślnie.']);
    }

    public function downloadCategoryData($id)
    {
        $categories = CategoriesAdmin::find($id);
    
        if (!$categories) {
            return response()->json(['error' => 'Kategoria nie została znaleziona.'], 404);
        }
    
        return response()->json(['kategorie' => $categories]);
    }
}
