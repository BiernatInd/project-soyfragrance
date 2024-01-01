<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPanel\PromoCodeAdmin;

class PromoCodeController extends Controller
{
    public function downloadPromoCodeList()
    {
        $promoCode = PromoCodeAdmin::all();

        return response()->json(['promoCode' => $promoCode]);
    }
    public function addPromoCode(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
            'discount' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $promoCode = new PromoCodeAdmin;
        $promoCode->promo_code = $request->input('promo_code');
        $promoCode->discount = $request->input('discount');
        $promoCode->quantity = $request->input('quantity');

        $promoCode->save();

        return response()->json(['message' => 'Kategoria dodana pomyślnie'], 201);
    }

    public function deletePromoCode($id)
    {
        $promoCode = PromoCodeAdmin::find($id);

        if (!$promoCode) {
            return response()->json(['error' => 'Kategoria nie został znaleziona.'], 404);
        }

        $promoCode->delete();

        return response()->json(['message' => 'Kategoria została pomyślnie usunięta.']);
    }
}
