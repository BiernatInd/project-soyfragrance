<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPanel\ProductsAdmin;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    //funkcje lista produktow
    public function downloadProductsList()
    {
        $products = ProductsAdmin::all();

        return response()->json(['products' => $products]);
    }

    public function downloadProduct($id)
    {
        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        return response()->json(['product' => $product]);
    }

    public function deleteProduct($id)
    {
        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produkt został pomyślnie usunięty.']);
    }

    //funkcje dodawanie produktu
    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|string',
            'promo_price' => 'nullable|string',
            'availability' => 'required|string'
        ]);

        $products = new ProductsAdmin;
        $products->name = $request->input('name');
        $products->category = $request->input('category');
        $products->price = $request->input('price');
        $products->promo_price = $request->input('promo_price');
        $products->availability = $request->input('availability');

        $products->save();

        return response()->json(['message' => 'Produkt dodany pomyślnie', 'id' => $products->id], 201);
    }

    public function addProductMeta(Request $request, $id)
    {
        $request->validate([
            'product_title' => 'required|string',
            'product_description' => 'required|string',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->product_title = $request->input('product_title');
        $product->product_description = $request->input('product_description');
        $product->save();

        return response()->json(['message' => 'Produkt dodany pomyślnie', 'id' => $product->id], 201);
    }

    public function addProductPhotos(Request $request, $id) {
        // Pobierz produkt na podstawie ID
        $product = ProductsAdmin::find($id);
    
        if (!$product) {
            return response()->json(['message' => 'Produkt nie znaleziony'], 404);
        }
    
        for ($i = 1; $i <= 3; $i++) {
            $inputName = "product_photo_$i";
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $path = "products-photos/{$product->id}";
                $filename = "$i.jpg"; // Zawsze zapisz jako JPG
    
                // Utwórz folder jeśli nie istnieje
                $directory = public_path($path);
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
    
                // Konwersja i zapis obrazu jako JPG
                $image = imagecreatefromstring(file_get_contents($file));
                imagejpeg($image, $directory . '/' . $filename, 90); // Zapisz jako JPG z jakością 90%
    
                // Zwolnij pamięć
                imagedestroy($image);
    
                // Zapisz ścieżkę pliku w bazie danych
                $columnName = "product_photo_$i";
                $product->$columnName = url("$path/$filename");
            }
        }
    
        $product->save();
    
        return response()->json(['message' => 'Produkt dodany pomyślnie', 'id' => $product->id], 201);
    }
    
    public function addProductDescription(Request $request, $id)
    {
        $request->validate([
            'short_description' => 'required|string',
            'long_description' => 'required|string',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('long_description');
        $product->save();

        return response()->json(['message' => 'Produkt dodany pomyślnie', 'id' => $product->id], 201);
    }

    //Edytowanie
    public function editProductName(Request $request, $id)
    {
        $request->validate([
            'newName' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->name = $request->input('newName');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }

    public function editProductCategory(Request $request, $id)
    {
        $request->validate([
            'newCategory' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->category = $request->input('newCategory');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }
    public function editProductPrice(Request $request, $id)
    {
        $request->validate([
            'newPrice' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->price = $request->input('newPrice');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }

    public function editProductPromoPrice(Request $request, $id)
    {
        $request->validate([
            'newPromoPrice' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->promo_price = $request->input('newPromoPrice');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }

    public function editProductAvailability(Request $request, $id)
    {
        $request->validate([
            'newAvailability' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->availability = $request->input('newAvailability');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }
    public function editProductTitle(Request $request, $id)
    {
        $request->validate([
            'newTitle' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->product_title = $request->input('newTitle');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }
    public function editProductDescription(Request $request, $id)
    {
        $request->validate([
            'newDescription' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->product_description = $request->input('newDescription');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }
    public function editProductShortDescription(Request $request, $id)
    {
        $request->validate([
            'newShortDescription' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->short_description = $request->input('newShortDescription');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }
    public function editProductLongDescription(Request $request, $id)
    {
        $request->validate([
            'newLongDescription' => 'required|string|max:255',
        ]);

        $product = ProductsAdmin::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $product->long_description = $request->input('newLongDescription');
        $product->save();

        return response()->json(['message' => 'Nazwa produktu została zaktualizowana pomyślnie.']);
    }
    
    public function editProductMainPhoto(Request $request, $id)
    {
        $product = ProductsAdmin::find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }
    
        $request->validate([
            'newMainPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $file = $request->file('newMainPhoto');
        $filename = '1.jpg'; // Zawsze zapisz jako JPG
    
        // Utwórz folder jeśli nie istnieje
        $path = public_path('products-photos/' . $product->id);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        // Konwersja obrazu do formatu JPG
        $image = imagecreatefromstring(file_get_contents($file));
        imagejpeg($image, $path . '/' . $filename, 90); // Zapisz jako JPG z jakością 90%
    
        // Zwolnij pamięć
        imagedestroy($image);
    
        // Aktualizuj ścieżkę zdjęcia w bazie danych
        $product->product_photo_1 = url('products-photos/' . $product->id . '/' . $filename);
        $product->save();
    
        return response()->json(['message' => 'Główne zdjęcie produktu zostało zaktualizowane pomyślnie.']);
    }

    public function editProductSecondPhoto(Request $request, $id)
    {
        $product = ProductsAdmin::find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }
    
        $request->validate([
            'newSecondPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $file = $request->file('newSecondPhoto');
        $filename = '2.jpg'; // Zawsze zapisz jako JPG
    
        // Utwórz folder jeśli nie istnieje
        $path = public_path('products-photos/' . $product->id);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        // Konwersja obrazu do formatu JPG
        $image = imagecreatefromstring(file_get_contents($file));
        imagejpeg($image, $path . '/' . $filename, 90); // Zapisz jako JPG z jakością 90%
    
        // Zwolnij pamięć
        imagedestroy($image);
    
        // Aktualizuj ścieżkę zdjęcia w bazie danych
        $product->product_photo_2 = url('products-photos/' . $product->id . '/' . $filename);
        $product->save();
    
        return response()->json(['message' => 'Główne zdjęcie produktu zostało zaktualizowane pomyślnie.']);
    }

    public function editProductThirdPhoto(Request $request, $id)
    {
        $product = ProductsAdmin::find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }
    
        $request->validate([
            'newThirdPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $file = $request->file('newThirdPhoto');
        $filename = '3.jpg'; // Zawsze zapisz jako JPG
    
        // Utwórz folder jeśli nie istnieje
        $path = public_path('products-photos/' . $product->id);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        // Konwersja obrazu do formatu JPG
        $image = imagecreatefromstring(file_get_contents($file));
        imagejpeg($image, $path . '/' . $filename, 90); // Zapisz jako JPG z jakością 90%
    
        // Zwolnij pamięć
        imagedestroy($image);
    
        // Aktualizuj ścieżkę zdjęcia w bazie danych
        $product->product_photo_3 = url('products-photos/' . $product->id . '/' . $filename);
        $product->save();
    
        return response()->json(['message' => 'Główne zdjęcie produktu zostało zaktualizowane pomyślnie.']);
    }

    public function downloadMetaProduct($id)
    {
        $product = ProductsAdmin::where('id', $id)->first();
    
        if (!$product) {
            return response()->json(['message' => 'Artykuł nie znaleziony'], 404);
        }
    
        return response()->json(['article' => $product], 200);
    }        
}
