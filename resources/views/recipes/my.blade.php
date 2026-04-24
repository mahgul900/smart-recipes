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
.btn { background-color: #5c3d2e; color: white; border: none; }
.btn:hover { background-color: #3e2f21; color: white; }
.btn-danger-custom { background-color: #dc3545; color: white; border: none; border-radius: 6px; }
.btn-danger-custom:hover { background-color: #b02a37; color: white; }
.card { border: 1px solid #dac4a2; border-radius: 12px; overflow: hidden; }
.card-img-top { height: 180px; object-fit: cover; }
.no-img { height: 180px; background-color: #f0e6d3; display: flex; align-items: center; justify-content: center; color: #a0856b; font-size: 2.5rem; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📋 My Recipes</h2>
        <a href="{{ route('recipes.create') }}" class="btn px-4 py-2 rounded shadow">+ Add New Recipe</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($recipes->isEmpty())
        <p class="text-muted">You haven't submitted any recipes yet.</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($recipes as $recipe)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($recipe->images && $recipe->images->count())
                            <img src="{{ asset('storage/' . $recipe->images->first()->path) }}"
                                 alt="{{ $recipe->title }}" class="card-img-top">
                        @else
                            <div class="no-img">🍽️</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $recipe->title }}</h5>
                            <p class="text-muted small mb-1">
                                ⭐ {{ $recipe->reviews->avg('stars') ? number_format($recipe->reviews->avg('stars'), 1) : 'No ratings' }}
                                &nbsp;·&nbsp; {{ $recipe->reviews->count() }} review(s)
                            </p>
                            <p class="text-muted small">{{ $recipe->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="card-footer bg-white d-flex gap-2">
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-sm px-3 rounded">View</a>
                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-sm px-3 rounded" style="background:#a07850;color:white;">Edit</a>
                            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="ms-auto"
                                  onsubmit="return confirm('Delete this recipe?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger-custom px-3">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">{{ $recipes->links() }}</div>
    @endif
</div>
@endsection
