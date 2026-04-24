<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternativeReview;
use App\Models\IngredientAlternative;

class AlternativeController extends Controller
{
    /**
     * Search for ingredient alternatives (GET with ?query= param).
     */
    public function search(Request $request)
    {
        $ingredient = strtolower(trim($request->input('query', '')));

        if (empty($ingredient)) {
            return view('alternatives.search_results', [
                'ingredient'         => '',
                'scoredAlternatives' => collect(),
                'seededAlternatives' => collect(),
            ]);
        }

        // User-submitted reviews grouped by alternative
        $scoredAlternatives = AlternativeReview::where('ingredient', $ingredient)
            ->get()
            ->groupBy('alternative')
            ->map(function ($reviews, $altName) {
                return [
                    'name'      => $altName,
                    'avg_stars' => round($reviews->avg('stars'), 1),
                    'count'     => $reviews->count(),
                    'reviews'   => $reviews,
                ];
            })
            ->sortByDesc('avg_stars');

        // Admin-seeded alternatives (shown even if no reviews yet)
        $seededAlternatives = IngredientAlternative::where('ingredient', $ingredient)
    ->leftJoinSub(
        \App\Models\AlternativeReview::selectRaw('alternative, AVG(stars) as avg_stars')
            ->where('ingredient', $ingredient)
            ->groupBy('alternative'),
        'reviews_avg',
        'ingredient_alternatives.alternative', '=', 'reviews_avg.alternative'
    )
    ->orderByDesc('reviews_avg.avg_stars')
    ->select('ingredient_alternatives.*')
    ->get();;

        return view('alternatives.search_results', [
            'ingredient'         => $ingredient,
            'scoredAlternatives' => $scoredAlternatives,
            'seededAlternatives' => $seededAlternatives,
        ]);
    }

    /**
     * Show alternatives for a specific ingredient via URL segment.
     */
    public function show($ingredient)
    {
        $ingredient = strtolower(trim($ingredient));

        $scoredAlternatives = AlternativeReview::where('ingredient', $ingredient)
            ->get()
            ->groupBy('alternative')
            ->map(function ($reviews, $altName) {
                return [
                    'name'      => $altName,
                    'avg_stars' => round($reviews->avg('stars'), 1),
                    'count'     => $reviews->count(),
                    'reviews'   => $reviews,
                ];
            })
            ->sortByDesc('avg_stars');

        $seededAlternatives = IngredientAlternative::where('ingredient', $ingredient)->get();

        return view('alternatives.search_results', [
            'ingredient'         => $ingredient,
            'scoredAlternatives' => $scoredAlternatives,
            'seededAlternatives' => $seededAlternatives,
        ]);
    }
}
