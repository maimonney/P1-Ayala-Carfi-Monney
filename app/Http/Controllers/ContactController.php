<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactConfirmation;
use App\Mail\ContactNotification;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Mail::to($validated['email'])
            ->send(new ContactConfirmation($validated));

            Mail::to('mailen.monney@davinci.edu.ar')->send(new ContactNotification($validated));

        return redirect()->route('contact.sent');
    }
}
