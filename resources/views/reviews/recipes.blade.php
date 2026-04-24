@extends('layouts.app')

@section('content')
<style>
body { font-family: 'Quicksand', sans-serif; background-color: #fef9f4; color: #3e2f21; }
.navbar { background-color: #5c3d2e; position: sticky; top: 0; z-index: 1030; }
.navbar a, .nav-link { color: white !important; font-weight: 600; }
.navbar-brand { color: white !important; font-weight: 700; font-size: 28px; text-transform: uppercase !important; }
.navbar a:hover { color: rgb(205, 208, 208) !important; }
.navbar-toggler { background-color: white; }
.dropdown-item { color: white; font-weight: bold; }
.dropdown-item:hover { color: rgb(205, 208, 208) !important; }
.dropdown-menu { background-color: #5c3d2e; }
.dropdown-toggle { text-transform: uppercase !important; }
.footer { background-color: #3e2f21; color: #fff; padding: 20px 0; }
.footer a { color: #fff; margin: 0 10px; }
.review-card { background: white; border: 1px solid #dac4a2; border-radius: 12px; padding: 1.2rem; margin-bottom: 1rem; }
.recipe-title { font-weight: 700; font-size: 1.05rem; color: #5c3d2e; }
.badge-stars { background-color: #f59e0b; color: white; padding: 3px 10px; border-radius: 999px; font-size: 0.85rem; }
.btn-edit { background-color: #5c3d2e; color: white; border: none; border-radius: 6px; font-size: 0.85rem; padding: 4px 12px; }
.btn-edit:hover { background-color: #3e2f21; color: white; }
.btn-del { background-color: #dc3545; color: white; border: none; border-radius: 6px; font-size: 0.85rem; padding: 4px 12px; }
.btn-del:hover { background-color: #b02a37; color: white; }
</style>

<div class="container py-5">
    <h2 class="fw-bold mb-4">📝 My Recipe Reviews</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reviews->isEmpty())
        <p class="text-muted">You haven't reviewed any recipes yet.</p>
        <a href="{{ route('recipes.list') }}" class="btn mt-3" style="background:#5c3d2e;color:white;">
            🍽️ Browse Recipes
        </a>
    @else
        @foreach($reviews as $review)
            <div class="review-card">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <div>
                        <a href="{{ route('recipes.show', $review->recipe_id) }}" class="recipe-title text-decoration-none">
                            {{ $review->recipe->title ?? 'Deleted Recipe' }}
                        </a>
                    </div>
                    <span class="badge-stars">{{ $review->stars }} ★</span>
                </div>
                @if($review->comment)
                    <p class="mt-2 mb-1 text-muted fst-italic">"{{ $review->comment }}"</p>
                @endif
                <div class="d-flex align-items-center gap-2 mt-2">
                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    <a href="{{ route('reviews.edit', $review) }}" class="btn-edit ms-2">Edit</a>
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST"
                          onsubmit="return confirm('Delete this review?')" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-del">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
