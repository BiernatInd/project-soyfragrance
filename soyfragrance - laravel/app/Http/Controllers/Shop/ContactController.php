<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function sendForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
    
        // Wyślij e-mail
        Mail::to('biuro.szambonalata@gmail.com')->send(new ContactFormMail($data));
    
        return response()->json(['message' => 'E-mail wysłany pomyślnie']);
    }
}
