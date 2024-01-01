<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop\Products;
use App\Models\Shop\Categories;

class ProductsController extends Controller
{
    public function downloadProducts($category_name)
    {
        // Znajdź kategorię po nazwie
        $category = Categories::where('category_name', $category_name)->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Znajdź produkty związane z daną kategorią
        $products = Products::where('category', $category_name)->get();

        return response()->json(['products' => $products]);
    }

    public function downloadProduct($id)
    {
        try {
            // Używamy metody find z modelu Product do pobrania produktu po ID
            $product = Products::find($id);

            if (!$product) {
                return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
            }

            // Zwracamy produkt w formie JSON
            return response()->json(['product' => $product], 200);
        } catch (\Exception $e) {
            // Obsługa błędów
            return response()->json(['error' => 'Wystąpił błąd podczas pobierania produktu.'], 500);
        }
    }
}