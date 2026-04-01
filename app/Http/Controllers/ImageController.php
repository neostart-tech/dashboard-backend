<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $query = Image::query();
        if ($request->has('id_blog')) {
            $query->where('id_blog', $request->id_blog);
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image',
            'id_blog' => 'nullable|exists:blogs,id',
            'is_couverture' => 'boolean',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $image = Image::create([
            'path' => $path,
            'id_blog' => $request->id_blog ?? null,
            'is_couverture' => $request->is_couverture ?? false,
        ]);

        return response()->json($image, 201);
    }

    public function destroy($id)
    {
        Image::findOrFail($id)->delete();
        return response()->json(['message' => 'Supprimé avec succès']);
    }
}
