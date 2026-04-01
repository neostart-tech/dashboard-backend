<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        if (!$contact) {
            $contact = Contact::create([]);
        }
        return response()->json($contact);
    }

    public function update(Request $request)
    {
        $contact = Contact::first();
        if (!$contact) {
            $contact = Contact::create([]);
        }

        $validated = $request->validate([
            'telephone1' => 'nullable|string',
            'telephone2' => 'nullable|string',
            'email' => 'nullable|string',
            'adresse' => 'nullable|string',
        ]);

        $contact->update($validated);

        return response()->json($contact);
    }
}
