<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingsController extends Controller
{
    public function downloadAdmin() {
        $admin = User::where('role', 'admin')->get();
        return response()->json(['admin' => $admin]);
    }

    public function changeAdminEmail(Request $request, $id)
    {
        // Walidacja żądania
        $request->validate([
            'new_email' => 'required|email',
            'password' => 'required',
        ]);

        // Znajdź administratora
        $admin = User::findOrFail($id);

        // Sprawdź poprawność hasła
        if (!Hash::check($request->password, $admin->password)) {
            return response()->json(['error' => 'Nieprawidłowe hasło'], 401);
        }

        // Zmiana adresu e-mail
        $admin->email = $request->new_email;
        $admin->save();

        return response()->json(['message' => 'Adres e-mail został pomyślnie zmieniony']);
    }
}
