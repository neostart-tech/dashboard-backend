<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\AdminCreatedMail;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(User::where('role', 'admin')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'nullable|string',
        ]);

        $plainPassword = Str::password(12);

        $validated['password'] = Hash::make($plainPassword);
        $validated['role'] = 'admin';

        $admin = User::create($validated);

        Mail::to($admin->email)->send(new AdminCreatedMail($admin, $plainPassword));

        return response()->json($admin, 201);
    }

    public function show($id)
    {
        return response()->json(User::where('id', $id)->where('role', 'admin')->firstOrFail());
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('id', $id)->where('role', 'admin')->firstOrFail();

        $validated = $request->validate([
            'nom' => 'sometimes|string',
            'prenom' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'telephone' => 'nullable|string',
        ]);

        $admin->update($validated);

        return response()->json($admin);
    }

    public function destroy($id)
    {
        $admin = User::where('id', $id)->where('role', 'admin')->firstOrFail();
        $admin->delete();

        return response()->json(['message' => 'Admin supprimé avec succès']);
    }
}
