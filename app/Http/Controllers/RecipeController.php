<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeImage;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index()
    {
        $topRecipes = Recipe::with('user', 'reviews')->get()->sortByDesc(function ($recipe) {
            return $recipe->reviews->avg('stars');
        })->take(3);

        return view('welcome', compact('topRecipes'));
    }

    public function list(Request $request)
    {
        $query = Recipe::with('user', 'reviews.user', 'images');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $recipes = $query->withAvg('reviews', 'stars')->orderByDesc('reviews_avg_stars')->paginate(6);

        return view('recipes.list', compact('recipes'));
    }

    public function show(Recipe $recipe)
    {
        $recipe->load('user', 'images', 'reviews.user');
        return view('recipes.show', compact('recipe'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'ingredients' => 'required|string',
            'steps'      => 'required|string',
            'images.*'   => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        $recipe = Recipe::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'ingredients' => $request->ingredients,
            'steps'       => $request->steps,
        ]);

        // Image upload — store original, generate thumbnail using GD
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file->isValid()) {
                    continue;
                }

                // Read raw bytes BEFORE storing (store() moves/closes the tmp file)
                $imageBytes = file_get_contents($file->getRealPath());
                $mime       = $file->getMimeType();

                // Store the original
                $originalPath = $file->store('recipes', 'public');

                // Generate thumbnail with native GD (no Intervention needed)
                $thumbFilename = 'thumb_' . basename($originalPath);
                $thumbPath     = 'recipes/' . $thumbFilename;

                try {
                    $src = imagecreatefromstring($imageBytes);
                    if ($src !== false) {
                        $origW = imagesx($src);
                        $origH = imagesy($src);
                        $thumbW = 300;
                        $thumbH = (int) round(($origH / $origW) * $thumbW);

                        $thumb = imagecreatetruecolor($thumbW, $thumbH);
                        imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumbW, $thumbH, $origW, $origH);

                        ob_start();
                        imagejpeg($thumb, null, 85);
                        $thumbData = ob_get_clean();

                        Storage::disk('public')->put($thumbPath, $thumbData);

                        imagedestroy($src);
                        imagedestroy($thumb);
                    } else {
                        // Fallback: use original as thumbnail
                        $thumbPath = $originalPath;
                    }
                } catch (\Throwable $e) {
                    // Fallback: use original as thumbnail
                    $thumbPath = $originalPath;
                }

                RecipeImage::create([
                    'recipe_id' => $recipe->id,
                    'path'      => $thumbPath,
                ]);
            }
        }

        return redirect()->route('recipes.list')->with('success', 'Recipe submitted successfully!');
    }

    public function edit(Recipe $recipe)
    {
        if (auth()->id() !== $recipe->user_id && !auth()->user()->is_admin) {
            abort(403);
        }
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if (auth()->id() !== $recipe->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'ingredients' => 'required|string',
            'steps'       => 'required|string',
        ]);

        $recipe->update($request->only('title', 'ingredients', 'steps'));

        return redirect()->route('recipes.list')->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Recipe $recipe)
    {
        if (auth()->id() !== $recipe->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        // Delete associated images from storage
        foreach ($recipe->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $recipe->delete();

        return redirect()->route('recipes.list')->with('success', 'Recipe deleted successfully!');
    }

    public function myRecipes()
    {
        $recipes = Recipe::with('reviews', 'images')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(6);

        return view('recipes.my', compact('recipes'));
    }
}
