<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPanel\NewsletterListAdmin;

class NewsletterController extends Controller
{
    public function downloadNewsletterList()
    {
        $newsletter = NewsletterListAdmin::all();

        return response()->json(['newsletter' => $newsletter]);
    }

    public function addNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
        ]);

        $newsletter = new NewsletterListAdmin;
        $newsletter->email = $request->input('email');

        $newsletter->save();

        return response()->json(['message' => 'Kategoria dodana pomyślnie'], 201);
    }
}
