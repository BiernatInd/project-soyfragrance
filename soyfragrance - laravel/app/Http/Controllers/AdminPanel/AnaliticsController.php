<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPanel\OrderCompanyAdmin;
use App\Models\AdminPanel\OrderPrivatePersonAdmin;
use Carbon\Carbon;

class AnaliticsController extends Controller
{
    public function getMonthlyPurchases($month)
    {
        // Konwersja nazwy miesiąca na numer miesiąca
        $monthNumber = $this->convertMonthNameToNumber($month);
    
        if ($monthNumber === null) {
            return response()->json(['error' => 'Invalid month name'], 400);
        }
    
        // Zbierz wszystkie zakupy dla osób prywatnych z danego miesiąca
        $privateOrders = OrderPrivatePersonAdmin::whereMonth('created_at', $monthNumber)->get();
    
        // Zbierz wszystkie zakupy dla firm z danego miesiąca
        $companyOrders = OrderCompanyAdmin::whereMonth('created_at', $monthNumber)->get();
    
        // Zwróć dane zakupów
        return response()->json([
            'private_orders' => $privateOrders,
            'company_orders' => $companyOrders
        ]);
    }

    public function convertMonthNameToNumber($monthName)
{
    $months = [
        'styczen' => 1,
        'luty' => 2,
        'marzec' => 3,
        'kwiecien' => 4,
        'maj' => 5,
        'czerwiec' => 6,
        'lipiec' => 7,
        'sierpien' => 8,
        'wrzesien' => 9,
        'pazdziernik' => 10,
        'listopad' => 11,
        'grudzien' => 12,
    ];

    return $months[strtolower($monthName)] ?? null;
}

public function getYearlyPurchases()
{
// Zbierz i zsumuj zamówienia po miesiącu
$privateOrders = OrderPrivatePersonAdmin::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
->whereYear('created_at', date('Y'))
->groupBy('month')
->get();

$companyOrders = OrderCompanyAdmin::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
->whereYear('created_at', date('Y'))
->groupBy('month')
->get();
    
    // Zwróć dane zakupów
    return response()->json([
        'private_orders' => $privateOrders,
        'company_orders' => $companyOrders
    ]);
}
}
