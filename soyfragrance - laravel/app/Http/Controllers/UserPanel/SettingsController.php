<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingsController extends Controller
{
    public function downloadUser() {
        $user = User::where('role', 'user')->get();
        return response()->json(['user' => $user]);
    }

    public function changeUserEmail(Request $request, $id)
    {
        // Walidacja żądania
        $request->validate([
            'new_email' => 'required|email',
            'password' => 'required',
        ]);

        // Znajdź administratora
        $user = User::findOrFail($id);

        // Sprawdź poprawność hasła
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Nieprawidłowe hasło'], 401);
        }

        // Zmiana adresu e-mail
        $user->email = $request->new_email;
        $user->save();

        return response()->json(['message' => 'Adres e-mail został pomyślnie zmieniony']);
    }
}
