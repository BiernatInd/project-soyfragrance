<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordEmail;

class RecoverPasswordController extends Controller
{
    public function recoverPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Zabezpieczenie numer 1: Ograniczenie liczby prób odzyskiwania hasła w określonym czasie
        $recentAttempts = DB::table('users')
            ->where('email', $request->email)
            ->where('created_at', '>', now()->subMinutes(15))
            ->count();

        if ($recentAttempts >= 3) {
            return response()->json(['error' => 'Przekroczono limit prób odzyskiwania hasła. Spróbuj ponownie za kilka minut.'], 429);
        }

        // Zabezpieczenie numer 2: Usuwanie starej informacji o resetach hasła przed dodaniem nowej
        DB::table('users')
            ->where('email', $request->email)
            ->update(['token' => null]); // Usunięcie starego tokenu

        $token = Str::random(60);

        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'token' => $token,
                'created_at' => now(),
            ]);

        $resetLink = "/resetowanie-hasla/{$token}";

        // Wyślij e-mail z linkiem do resetowania hasła
        Mail::to($request->email)->send(new ResetPasswordEmail('http://localhost:3000/resetowanie-hasla/' . $token));

        return response()->json(['message' => 'E-mail z linkiem do resetowania hasła został wysłany', 'resetLink' => $resetLink]);
    }
}
