<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json(Blog::with('images')->latest()->get());
    }

    public function show($id)
    {
        return response()->json(Blog::with('images')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string',
            'contenu' => 'required|string',
            'categorie' => 'required|string',
            'couverture' => 'nullable|image|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
        ]);

        $blog = Blog::create([
            'titre' => $validated['titre'],
            'contenu' => $validated['contenu'],
            'categorie' => $validated['categorie'],
        ]);

        if ($request->hasFile('couverture')) {
            $path = $request->file('couverture')->store('blogs', 'public');
            $blog->images()->create([
                'path' => $path,
                'is_couverture' => true,
            ]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('blogs', 'public');
                $blog->images()->create([
                    'path' => $path,
                    'is_couverture' => false,
                ]);
            }
        }

        return response()->json($blog->load('images'), 201);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'sometimes|string',
            'contenu' => 'sometimes|string',
            'categorie' => 'sometimes|string',
            'couverture' => 'nullable|image|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
        ]);

        $blog->update($validated);

        if ($request->hasFile('couverture')) {
            // Unset previous cover
            $blog->images()->where('is_couverture', true)->update(['is_couverture' => false]);
            
            $path = $request->file('couverture')->store('blogs', 'public');
            $blog->images()->create([
                'path' => $path,
                'is_couverture' => true,
            ]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('blogs', 'public');
                $blog->images()->create([
                    'path' => $path,
                    'is_couverture' => false,
                ]);
            }
        }

        return response()->json($blog->load('images'));
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        
        // Delete physical files
        foreach ($blog->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        
        $blog->delete();
        return response()->json(['message' => 'Supprimé avec succès']);
    }
}
