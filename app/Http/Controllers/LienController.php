<?php

namespace App\Http\Controllers;

use App\Models\Lien;
use Illuminate\Http\Request;

class LienController extends Controller
{
    public function index()
    {
        $lien = Lien::first();
        if (!$lien) {
            $lien = Lien::create([]);
        }
        return response()->json($lien);
    }

    public function update(Request $request)
    {
        $lien = Lien::first();
        if (!$lien) {
            $lien = Lien::create([]);
        }

        $validated = $request->validate([
            'instagram' => 'nullable|string',
            'facebook' => 'nullable|string',
            'x' => 'nullable|string',
            'tiktok' => 'nullable|string',
        ]);

        $lien->update($validated);

        return response()->json($lien);
    }
}
