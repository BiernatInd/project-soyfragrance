<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop\PromoCode;

class PromoCodeController extends Controller
{
    public function checkPromoCode(Request $request)
{
    $promoCodeValue = $request->input('promo_code');
    $promoCode = PromoCode::where('promo_code', $promoCodeValue)->first();

    if ($promoCode && $promoCode->quantity > 0) {
        // Zmniejsz ilość dostępnych kodów
        $promoCode->decrement('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Kod rabatowy jest ważny.',
            'discount' => $promoCode->discount
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Kod rabatowy jest nieprawidłowy lub wykorzystany.',
            'discount' => 0
        ]);
    }
}
}
