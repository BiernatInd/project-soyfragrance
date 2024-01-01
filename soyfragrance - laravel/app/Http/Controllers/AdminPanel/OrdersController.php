<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPanel\OrderCompanyAdmin;
use App\Models\AdminPanel\OrderPrivatePersonAdmin;

class OrdersController extends Controller
{
    public function downloadOrdersList()
    {
        $ordersCompany = OrderCompanyAdmin::all();
        $ordersPrivatePerson = OrderPrivatePersonAdmin::all();

        return response()->json(['ordersCompany' => $ordersCompany, 'ordersPrivatePerson' => $ordersPrivatePerson]);
    }

    public function deleteOrder($orderNumber)
    {
        try {
            $ordersCompany = OrderCompanyAdmin::where('order_number', 'LIKE', '%' . $orderNumber . '%')->first();
            $ordersPrivatePerson = OrderPrivatePersonAdmin::where('order_number', 'LIKE', '%' . $orderNumber . '%')->first();

            if ($ordersCompany) {
                $ordersCompany->delete();
                return response()->json(['message' => 'Zamówienie usunięte pomyślnie']);
            } elseif ($ordersPrivatePerson) {
                $ordersPrivatePerson->delete();
                return response()->json(['message' => 'Zamówienie usunięte pomyślnie']);
            } else {
                return response()->json(['message' => 'Zamówienie o podanym numerze nie zostało znalezione.'], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Błąd usuwania zamówienia: ' . $e->getMessage());
            return response()->json(['error' => 'Wystąpił błąd podczas usuwania zamówienia. Sprawdź logi dla więcej informacji.'], 500);
        }
    }

    public function downloadContentOrder($orderNumber)
    {
        $ordersCompany = OrderCompanyAdmin::where('order_number', 'LIKE', '%' . $orderNumber . '%')->first();
        $ordersPrivatePerson = OrderPrivatePersonAdmin::where('order_number', 'LIKE', '%' . $orderNumber . '%')->first();
    
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

    public function updateAvailability(Request $request, $orderNumber)
    {
        try {
            $validatedData = $request->validate([
                'new_order_status' => 'required|in:Zrealizowano,Opłacono,Nieopłacono',
            ]);

            $ordersCompany = OrderCompanyAdmin::where('order_number', 'LIKE', '%' . $orderNumber . '%')->first();
            $ordersPrivatePerson = OrderPrivatePersonAdmin::where('order_number', 'LIKE', '%' . $orderNumber . '%')->first();

            if ($ordersCompany) {
                $ordersCompany->update(['order_status' => $validatedData['new_order_status']]);
                return response()->json(['message' => 'Status zamówienia zaktualizowany pomyślnie']);
            } elseif ($ordersPrivatePerson) {
                $ordersPrivatePerson->update(['order_status' => $validatedData['new_order_status']]);
                return response()->json(['message' => 'Status zamówienia zaktualizowany pomyślnie']);
            } else {
                return response()->json(['message' => 'Zamówienie o podanym numerze nie zostało znalezione.'], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Błąd aktualizacji statusu zamówienia: ' . $e->getMessage());
            return response()->json(['error' => 'Wystąpił błąd podczas aktualizacji statusu zamówienia. Sprawdź logi dla więcej informacji.'], 500);
        }
    }
}
