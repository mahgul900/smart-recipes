<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $existing = Review::where('user_id', Auth::id())
                          ->where('recipe_id', $request->recipe_id)
                          ->first();

        if ($existing) {
            return back()->withErrors('You have already reviewed this recipe.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'recipe_id' => $request->recipe_id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }
    public function myReviews()
    {
        $reviews = Review::where('user_id', auth()->id())->with('recipe')->get();
        return view('reviews.recipes', compact('reviews'));
    }
    public function edit($id)
{
    $review = Review::findOrFail($id);
    return view('reviews.edit', compact('review'));
}

public function update(Request $request, Review $review)
{
    if ($review->user_id !== Auth::id()) {
        abort(403); // Forbidden
    }

    $request->validate([
        'stars' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    $review->stars = $request->stars;
    $review->comment = $request->comment;
    $review->save();

    return redirect()->route('recipes.show', $review->recipe_id)->with('success', 'Review updated successfully!');
}


}
