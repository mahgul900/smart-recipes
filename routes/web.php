<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AlternativeReviewController;
use App\Http\Controllers\AlternativeController;

// Homepage
Route::get('/', [RecipeController::class, 'index']);

// Recipe list (public)
Route::get('/recipes', [RecipeController::class, 'list'])->name('recipes.list');

// Ingredient Alternatives Search (public)
Route::get('/alternatives/search', [AlternativeController::class, 'search'])->name('alternatives.search');
Route::get('/alternatives/{ingredient}', [AlternativeController::class, 'show'])->name('alternatives.show');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ /recipes/create MUST be defined BEFORE the /{recipe} wildcard below
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

    // Recipe Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Alternative Reviews
    Route::post('/alternative-reviews', [AlternativeReviewController::class, 'store'])->name('alternatives.review');

    // User activity pages
    Route::get('/my-recipes', [RecipeController::class, 'myRecipes'])->name('recipes.my');
    Route::get('/my-alternative-reviews', [AlternativeReviewController::class, 'myReviews'])->name('alternatives.myreviews');
    Route::get('/my-recipe-reviews', [ReviewController::class, 'myReviews'])->name('reviews.my');
});

// ✅ Wildcard route LAST — after all static /recipes/* routes above
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

// Auth routes
require __DIR__.'/auth.php';
