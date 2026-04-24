<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Recipes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #fcf7f0;
            color: #3e2f21;
        }

        .navbar {
            background-color: #ffe8cc;
        }

        .navbar a, .nav-link, .navbar-brand {
            color: #3e2f21 !important;
            font-weight: 600;
        }

        .navbar a:hover {
            color: #2c1e13 !important;
        }

        .btn-accent {
            background-color: #3e2f21;
            color: white;
            border: none;
        }

        .btn-accent:hover {
            background-color: #2c1e13;
        }

        .hero {
            background: url('/images/healthy-food-banner.jpg') no-repeat center center;
            background-size: cover;
            padding: 120px 30px;
            border-radius: 20px;
            color: white;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.4);
        }

        .welcome {
            background-color: #f2e5d5;
            padding: 60px 30px;
            text-align: center;
        }

        .footer {
            background-color: #3e2f21;
            color: #fff;
            padding: 20px 0;
        }

        .footer a {
            color: #fff;
            margin: 0 10px;
        }

        .feature-section img {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }

        .feature-section h3 {
            margin-top: 15px;
            font-size: 1.4rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Smart Recipes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('recipes.list') }}">All Recipes</a></li>

                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('recipes.create') }}">Submit Recipe</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    @if (Request::is('/'))
    <div class="container mt-5">
        <div class="hero">
            <h1>Smart Cooking Starts Here</h1>
            <p class="lead mt-3">Wholesome recipes and food substitutes for every lifestyle.</p>
            <a href="{{ route('recipes.create') }}" class="btn btn-accent btn-lg mt-4">Share a Recipe</a>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="welcome mt-5">
        <h2 class="mb-3">Welcome to Smart Recipes!</h2>
        <p class="mx-auto" style="max-width: 720px;">
            We believe cooking should be flexible, fun, and nourishing. Whether you’re looking for quick meals, vegan swaps, or allergy-friendly options, Smart Recipes helps you discover and share solutions tailored to your needs.
        </p>
    </div>

    <!-- Feature Highlights -->
    <div class="container text-center my-5 feature-section">
        <div class="row g-4">
            <div class="col-md-4">
                <img src="/images/meal-prep.jpg" class="img-fluid" alt="Meal Prep">
                <h3>Easy Meal Prep</h3>
                <p>Batch cook smarter with efficient, nutritious plans.</p>
            </div>
            <div class="col-md-4">
                <img src="/images/food-swaps.jpg" class="img-fluid" alt="Food Swaps">
                <h3>Smart Food Swaps</h3>
                <p>Discover healthy and allergen-friendly ingredient alternatives.</p>
            </div>
            <div class="col-md-4">
                <img src="/images/family-dinner.jpg" class="img-fluid" alt="Family Dinner">
                <h3>Family-Friendly Recipes</h3>
                <p>Meals even the pickiest eaters will love.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer text-center mt-5">
        <p>&copy; {{ date('Y') }} Smart Recipes. All rights reserved.</p>
        <div>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
