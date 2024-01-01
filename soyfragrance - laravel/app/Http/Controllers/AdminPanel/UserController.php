<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function downloadUsersList()
    {
        $users = User::all();

        return response()->json(['users' => $users]);
    }

    public function deleteUser($id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json(['error' => 'Kategoria nie został znaleziona.'], 404);
        }

        $users->delete();

        return response()->json(['message' => 'Kategoria została pomyślnie usunięta.']);
    }
}
