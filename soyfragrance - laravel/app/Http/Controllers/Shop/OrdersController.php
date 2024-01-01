<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop\OrderPrivatePerson;
use App\Models\Shop\OrderCompany;
use App\Models\Shop\Products;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function orderPrivatePerson(Request $request)
    {
        // Validate the request data
        $validator = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country' => 'required|string',
            'street_and_house_number' => 'required|string',
            'place' => 'required|string',
            'postal_code' => 'required|string',
            'invoice_name' => 'nullable|string',
            'invoice_surname' => 'nullable|string',
            'invoice_street_and_house_number' => 'nullable|string',
            'invoice_place' => 'nullable|string',
            'invoice_postal_code' => 'nullable|string',
            'total_price' => 'nullable|string',
            'payment' => 'nullable|string',
            'delivery' => 'nullable|string',
            'order_status' => 'nullable|string',
            'order_number' => 'nullable|string',
            'purchased_products' => 'nullable|string',
            'entered_promo_code' => 'nullable|string',
            'discount' => 'nullable|numeric',
            'user_name' => 'nullable|string',
            'paczkomat_number' => 'nullable|string'
        ]);

        // Create a new order
        $order = OrderPrivatePerson::create($validator);

        $this->decreaseProductAvailability($order->purchased_products);
    
        // Wysłanie e-maila potwierdzającego
        $orderData = $order->toArray(); // lub inny sposób, aby uzyskać dane zamówienia
        Mail::to($order->email)->send(new OrderConfirmationMail($orderData));
        
    
        // You can return a success response
        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
    }

    public function orderCompany(Request $request)
    {
        // Validate the request data
        $validator = $request->validate([
            'nip' => 'required|string',
            'company_name' => 'required|string',
            'street_and_house_number' => 'required|string',
            'place' => 'required|string',
            'postal_code' => 'required|string',
            'invoice_name' => 'nullable|string',
            'invoice_surname' => 'nullable|string',
            'invoice_email' => 'nullable|email',
            'invoice_phone' => 'nullable|string',
            'invoice_country' => 'nullable|string',
            'invoice_street_and_house_number' => 'nullable|string',
            'invoice_place' => 'nullable|string',
            'invoice_postal_code' => 'nullable|string',
            'total_price' => 'nullable|string',
            'payment' => 'nullable|string',
            'delivery' => 'nullable|string',
            'order_status' => 'nullable|string',
            'order_number' => 'nullable|string',
            'entered_promo_code' => 'nullable|string',
            'discount' => 'nullable|string',
            'purchased_products' => 'nullable|string',
            'entered_promo_code' => 'nullable|string',
            'discount' => 'nullable|numeric',
            'user_name' => 'nullable|string',
            'paczkomat_number' => 'nullable|string'
        ]);

        // Create a new order
        $order = OrderCompany::create($validator);

        $this->decreaseProductAvailability($order->purchased_products);
    
        $orderData = $order->toArray(); // lub inny sposób, aby uzyskać dane zamówienia
        Mail::to($order->invoice_email)->send(new OrderConfirmationMail($orderData));
    
        // You can return a success response
        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
    }

    protected function decreaseProductAvailability($purchasedProducts)
    {
        // Rozdziel zakupione produkty na pojedyncze elementy
        $products = explode(', ', $purchasedProducts);

        foreach ($products as $product) {
            // Rozdziel nazwę produktu od ilości
            list($productName, $quantity) = explode(' (x', $product);
            $quantity = rtrim($quantity, ')');

            // Znajdź produkt w magazynie
            $productModel = Products::where('name', $productName)->first();

            // Zmniejsz dostępność produktu
            if ($productModel) {
                $newAvailability = max(0, $productModel->availability - $quantity);
                $productModel->update(['availability' => $newAvailability]);
            }
        }
    }
}

