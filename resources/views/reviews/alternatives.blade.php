@extends('layouts.app')

@section('content')
<style>
body {
    font-family: 'Quicksand', sans-serif;
    background-color: #fef9f4;
    color: #3e2f21;
}
.navbar {
    background-color: #5c3d2e;
    position: sticky;
    top: 0;
    z-index: 1030;
}
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
.badge-stars { background-color: #f59e0b; color: white; padding: 3px 10px; border-radius: 999px; font-size: 0.85rem; }
.review-card { background: white; border: 1px solid #dac4a2; border-radius: 12px; padding: 1.2rem; margin-bottom: 1rem; }
.ingredient-label { font-weight: 700; font-size: 1.05rem; color: #5c3d2e; }
.alt-label { color: #555; font-size: 0.95rem; }
</style>

<div class="container py-5">
    <h2 class="fw-bold mb-4">⭐ My Alternative Reviews</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reviews->isEmpty())
        <div class="text-muted">You haven't reviewed any ingredient alternatives yet.</div>
        <a href="{{ route('alternatives.search') }}" class="btn mt-3" style="background:#5c3d2e;color:white;">
            🔍 Search Ingredient Alternatives
        </a>
    @else
        @foreach($reviews as $review)
            <div class="review-card">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <div>
                        <span class="ingredient-label">{{ ucfirst($review->ingredient) }}</span>
                        <span class="text-muted mx-2">→</span>
                        <span class="alt-label">{{ $review->alternative }}</span>
                    </div>
                    <span class="badge-stars">{{ $review->stars }} ★</span>
                </div>
                @if($review->comment)
                    <p class="mt-2 mb-0 text-muted fst-italic">"{{ $review->comment }}"</p>
                @endif
                <small class="text-muted d-block mt-1">{{ $review->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    @endif
</div>
@endsection
