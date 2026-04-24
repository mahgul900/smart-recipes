<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Smart Recipes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        .navbar a {
            color: white !important;
            font-weight: 600;
        }
        .nav-link{
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

        .btn-accent {
            background-color: #5c3d2e;
            color: white;
            border: none;
        }

        .btn-accent:hover {
            background-color: #3e2f21;
            color: white;
        }

        .hero {
            background: url('/images/healthy-food-banner.jpg') no-repeat center center;
            background-size: cover;
            padding: 120px 30px;
            border-radius: 20px;
            color: white;
            text-align: center;
            box-shadow: inset 0 0 0 1000px rgba(0,0,0,0.25); /* dark overlay for readability */
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
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

        .h2, h2 {
        font-size: 2.3rem;
        font-weight: 700;
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
            font-size: 1.3rem;
            font-weight: bold;
        }
        .feature-section{
            padding: 80px 0px;
        }

        .top-rated-badge {
            font-size: 1.2rem;
            background-color: #dac4a2;
            color: #3e2f21;
            border-radius: 10px;
            padding: 5px 10px;
            display: inline-block;
        }

        /* Alternative Search Bar styling */
        .alternative-search {
            background-color: #fff6ec;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(92,61,46,0.15);
            max-width: 700px;
            margin: auto;
        }
        .alternative-search input {
            background-color: white !important;
            color: #3e2f21 !important; /* Ensures text is dark for contrast */
        }
        .h5, h5{
            font-size: 1.3rem;
            font-weight: 600;   
        }
        .card-img-top {
    height: 200px;
    object-fit: cover;
}
.card-body {
    padding: 0.85rem;
}
.card-title {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.3rem;
}
.card {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #dac4a2;
    transition: box-shadow 0.2s;
}
.card:hover {
    box-shadow: 0 6px 20px rgba(92,61,46,0.15);
}
        .navbar-toggler{
            background-color: white;
        }
        .dropdown-toggle{
            text-transform: uppercase !important;
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
        .hero{
           background-image: url("/hero_1.jpeg");
           background-size:cover;
        }
.feature-card {
    height: 100%;
}
.feature-img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 10px;
}
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">SMART RECIPES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('recipes.list')); ?>">All Recipes</a></li>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('recipes.create')); ?>">Submit Recipe</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><?php echo e(Auth::user()->name); ?></a>
                            <ul class="dropdown-menu dropdown-menu-end ">
                                <li><a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Profile</a></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if(Request::is('/')): ?>
    <!-- Hero Section -->
    <div class="container mt-5 hero-section">
        <div class="hero">
            <h1>Smart Cooking Starts Here</h1>
            <p class="lead mt-3">Wholesome recipes and food substitutes for every lifestyle.</p>
            <a href="<?php echo e(route('recipes.create')); ?>" class="btn btn-accent rounded-[60px] px-4 btn-lg mt-4 font-semibold">Share a Recipe</a>
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
    <div class="container text-center my-5 feature-section py-[80px]">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                <img src="/meal-prep.png" class="img-fluid feature-img" alt="Meal Prep" />
                <h3>Easy Meal Prep</h3>
                <p>Batch cook smarter with efficient, nutritious plans.</p>
            </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                <img src="/food-swaps.png" class="img-fluid feature-img" alt="Food Swaps" />
                <h3>Smart Food Swaps</h3>
                <p>Discover healthy and allergen-friendly ingredient alternatives.</p>
            </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                <img src="/family-dinner.png" class="img-fluid feature-img" alt="Family Dinner" />
                <h3>Family-Friendly Recipes</h3>
                <p>Meals even the pickiest eaters will love.</p>
            </div>
            </div>
        </div>
    </div>

    <!-- Alternate Ingredient Search -->
    <div class="container my-8">
        <div class="alternative-search">
            <h4 class="text-center mb-3" style="font-weight: 700; color: #3e2f21;">Find Ingredient Alternatives</h4>
            <form action="<?php echo e(route('alternatives.search')); ?>" method="GET" class="row g-2 justify-content-center">
                <div class="col-md-6 col-10">
                    <input
                        type="text"
                        name="query"
                        class="form-control form-control-sm rounded-[8px] px-3 py-2 bg-transparent border-2 border-[#5c3d2e]"
                        placeholder="Enter ingredient name..."
                        required
                    />
                </div>
                <div class="col-md-2 col-4">
                    <button type="submit" class="btn btn-accent btn-sm w-100 py-2 rounded-[8px]">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Top 3 Rated Recipes -->
    <?php if(isset($topRecipes) && count($topRecipes) > 0): ?>
    <div class="container my-5">
        <h4 class="text-center mb-4">
            <span class="top-rated-badge">🏆 Top 3 Rated Recipes</span>
        </h4>
        <div class="row g-4">
            <?php $__currentLoopData = $topRecipes->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img
                            src="<?php echo e(asset('storage/' . ($recipe->images->first()->path ?? 'images/default.jpg'))); ?>"
                            class="card-img-top"
                            alt="Recipe Image"
                        />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($recipe->title); ?></h5>
                            <p class="card-text">Submitted by <?php echo e($recipe->user->name); ?></p>
                            <a href="<?php echo e(route('recipes.show', $recipe->id)); ?>" class="btn btn-accent btn-sm rounded-[60px]">View Recipe</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="container mt-5">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Footer -->
    <footer class="footer text-center mt-5">
        <p>&copy; <?php echo e(date('Y')); ?> Smart Recipes. All rights reserved.</p>
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
<?php /**PATH C:\Users\Mah Gul\Downloads\smart-recipes-fixed\resources\views/welcome.blade.php ENDPATH**/ ?>