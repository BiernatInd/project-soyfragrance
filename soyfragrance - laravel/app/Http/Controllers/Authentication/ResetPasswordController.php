<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request, $token)
{
    $passwordReset = DB::table('users')->where('token', $token)->first();

    if (!$passwordReset) {
        return response()->json(['message' => 'Nieprawidłowy token resetowania hasła'], 400);
    }

    $user = User::where('email', $passwordReset->email)->first();

    if (!$user) {
        return response()->json(['message' => 'Nieprawidłowy adres e-mail'], 400);
    }

    // Aktualizacja hasła, nie usuwanie użytkownika
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'Hasło zostało zresetowane.']);
}

}
