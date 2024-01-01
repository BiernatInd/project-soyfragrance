<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop\OrderCompany;
use App\Models\Shop\OrderPrivatePerson;

class OrdersController extends Controller
{
    public function ordersListUser(Request $request)
    {
        try {
            $userName = $request->input('userName', '');

            // Pobierz rekordy z obu tabel
            $ordersCompany = OrderCompany::all();
            $ordersPrivatePerson = OrderPrivatePerson::all();

            // Filtruj rekordy dla danego użytkownika
            $filteredOrdersCompany = $ordersCompany->where('user_name', $userName);
            $filteredOrdersPrivatePerson = $ordersPrivatePerson->where('user_name', $userName);

            // Łącz i zwróć wyniki
            $allOrders = $filteredOrdersCompany->merge($filteredOrdersPrivatePerson);
            
            return response()->json($allOrders, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function downloadOrderStatus($orderNumber)
    {
        $ordersCompany = OrderCompany::where('order_number', 'LIKE', '%' . $orderNumber . '%')->first();
        $ordersPrivatePerson = OrderPrivatePerson::where('order_number', 'LIKE', '%' . $orderNumber . '%')->first();
    
        if ($ordersCompany) {
            $ordersCompany['order_type'] = 'company';
            return response()->json(['order' => $ordersCompany]);
        } elseif ($ordersPrivatePerson) {
            $ordersPrivatePerson['order_type'] = 'private_person';
            return response()->json(['order' => $ordersPrivatePerson]);
        } else {
            return response()->json(['message' => 'Zamówienie o podanym numerze nie zostało znalezione.']);
        }
    }
}
