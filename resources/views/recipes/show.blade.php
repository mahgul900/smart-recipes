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
        .navbar a, .nav-link {
            color: white !important;
            font-weight: 600;
        }
        .navbar-brand{
            color: white !important;
            font-weight: 700;
            font-size: 28px;
            text-transform: uppercase !important;
        }

        .navbar a:hover {
            color:rgb(205, 208, 208) !important;
        }
        .btn {
            background-color: #5c3d2e;
            color: white;
            border: none;
        }
        .btn1 {
            background-color: red;
            color: white;
            border: none;
            border-radius: 7px;
        }

        .btn:hover {
            background-color: #3e2f21;
            color: white;
        }
        .btn1:hover {
            background-color:rgb(181, 51, 51);
            color: white;
        }

        .footer {
            background-color: #3e2f21;
            color: #fff;
            padding: 20px 0;
        }

        .h2, h2 {
        font-size: 2.3rem;
        font-weight: 700;
        }

        .footer a {
            color: #fff;
            margin: 0 10px;
        }
        .h3 {
            margin-top: 15px;
            font-size: 1.3rem;
            font-weight: bold;
        }
        .h4{
            margin-top: 15px;
            font-size: 1.3rem;
            font-weight: bold;
        }
        .card-header{
            background-color: #5c3d2e;
            color: white;
        }
        .h5, h5{
            font-size: 1.3rem;
            font-weight: 600;
            color: black;
        }
        .dropdown-menu, li, a{
            color: black;
        }
        .navbar-toggler{
            background-color: white;
        }
        .dropdown-toggle{
            text-transform: uppercase !important;
        }
        
        .form-label{
            font-size:18px;
            font-weight: 600;
            color: black;
        }
        .form-control {
            background-color: #fff;
            border: 1px solid #5c3d2e;
            padding: 0.55rem 1rem;
        }
        textarea{
            background-color: #fdf6ef;
            border: 1px solid #dac4a2;
            color: black;
            resize: none;
            border-radius: 8px;
            padding: 10px 14px;
            width: 100%;
            height: 200px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .dropdown-item{
            color: white;
            font-weight:bold;
        }
        .dropdown-item:hover{
            color:rgb(205, 208, 208) !important;
            font-weight:bold;
        }
        
        .dropdown-menu{
            background-color:#5c3d2e;
        }
    </style>

<div class="container mt-4">
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="mb-0">{{ $recipe->title }}</h4>
          @if($recipe->user->is_admin)
            <span class="badge bg-warning text-dark">Admin</span>
          @endif
        </div>

        @if ($recipe->images && $recipe->images->count())
          <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach ($recipe->images as $index => $image)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
  <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Recipe Image" style="height: 320px; object-fit: cover;">
</div>
              @endforeach
            </div>
            @if ($recipe->images->count() > 1)
              <button class="carousel-control-prev" type="button" data-bs-target="#recipeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#recipeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
              </button>
            @endif
          </div>
        @endif

        <div class="card-body">
          <p><strong>Submitted by:</strong> {{ $recipe->user->name }}</p>

          <p><strong>Ingredients:</strong></p>
          <p>{{ $recipe->ingredients }}</p>

          <p><strong>Steps:</strong></p>
          <p>{{ $recipe->steps }}</p>

          <p><strong>Average Rating:</strong>
            {!! str_repeat('⭐', round($recipe->reviews->avg('stars'))) !!}
            ({{ number_format($recipe->reviews->avg('stars'), 1) }})
          </p>

          @auth
            <h5 class="mt-4">Leave a Review</h5>
            <form action="{{ route('reviews.store') }}" method="POST">
              @csrf
              <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">

              <div class="mb-2">
                <label for="stars" class="form-label">Rating:</label><br>
                @for ($i = 1; $i <= 5; $i++)
                  <input type="radio" name="stars" value="{{ $i }}" id="star{{ $i }}">
                  <label for="star{{ $i }}">⭐</label>
                @endfor
              </div>

              <div class="mb-3">
                <label for="review" class="form-label">Your Review</label>
                <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
              </div>

              <button type="submit" class="btn btn-success">Submit Review</button>
            </form>
          @endauth

          @if ($recipe->reviews->count())
            <hr>
            <h5>Reviews</h5>
            @foreach ($recipe->reviews as $review)
              <div class="border p-3 rounded mb-3 bg-light">
                <p class="mb-1"><strong>{{ $review->user->name }}</strong></p>
                <p class="mb-1">Rating: {!! str_repeat('⭐', $review->stars) !!}</p>
                <p>{{ $review->comment }}</p>

                @auth
                  @if (Auth::id() === $review->user_id)
                    <a href="{{ route('reviews.edit', $review) }}" class="btn btn-outline-primary me-2 rounded-[60px] px-4 py-2">Edit</a>

                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button class="btn1 btn-outline-danger mt-2 rounded-[60px] px-3 py-2" onclick="return confirm('Are you sure you want to delete this review?')">Delete</button>
                    </form>
                  @endif
                @endauth
              </div>
            @endforeach
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
