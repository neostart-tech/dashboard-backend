<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewMessageMail;
use App\Mail\ReplyMail;

class MessageController extends Controller
{
    public function index()
    {
        return response()->json(Message::latest()->get());
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return response()->json($message);
    }

    public function reply(Request $request)
    {
        $validated = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string',
            'content' => 'required|string',
            'message_id' => 'required|exists:messages,id',
        ]);

        $message = Message::findOrFail($validated['message_id']);

        Mail::to($validated['to'])->send(new ReplyMail($validated['content'], $message));

        return response()->json(['message' => 'Réponse envoyée avec succès']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expediteur' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'nullable|string',
            'objet' => 'required|string',
            'contenu' => 'required|string',
        ]);

        $message = Message::create($validated);

        // Send email to contact email or default
        $contact = Contact::first();
        $adminEmail = $contact && $contact->email ? $contact->email : env('MAIL_FROM_ADDRESS');

        if ($adminEmail) {
            Mail::to($adminEmail)->send(new NewMessageMail($message));
        }

        return response()->json($message, 201);
    }

    public function destroy($id)
    {
        Message::findOrFail($id)->delete();
        return response()->json(['message' => 'Supprimé avec succès']);
    }
}
