<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternativeReview;
use Illuminate\Support\Facades\Auth;

class AlternativeReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ingredient'  => 'required|string|max:255',
            'alternative' => 'required|string|max:255',
            'stars'       => 'required|integer|min:1|max:5',
            'comment'     => 'nullable|string|max:1000',
        ]);

        // Prevent duplicate review by same user
        $exists = AlternativeReview::where('user_id', Auth::id())
            ->where('ingredient', strtolower(trim($request->ingredient)))
            ->where('alternative', $request->alternative)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already reviewed this alternative.');
        }

        AlternativeReview::create([
            'user_id'     => Auth::id(),
            'ingredient'  => strtolower(trim($request->ingredient)),
            'alternative' => $request->alternative,
            'stars'       => $request->stars,
            'comment'     => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }

    public function myReviews()
    {
        // No 'ingredient' relation — AlternativeReview stores ingredient as a plain string column
        $reviews = AlternativeReview::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('reviews.alternatives', compact('reviews'));
    }
}
