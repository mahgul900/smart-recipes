<?php $__env->startSection('content'); ?>

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

        .btn:hover {
            background-color: #3e2f21;
            color: white;
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
        .h3 {
            margin-top: 15px;
            font-size: 1.3rem;
            font-weight: bold;
        }
        .h5, h5{
            font-size: 1.3rem;
            font-weight: 600;
            color: black;
        }
        .card-img-top{
            height: 500px;
            object-fit: cover;
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
        .card{
            background-color: white;
        }
    </style>

<div class="container py-5" style="background-color: #fef9f4; min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header" style="background-color: #5c3d2e; color: white; border-radius: 12px 12px 0 0;">
                    <h4>🍽️ Welcome, <?php echo e(Auth::user()->name); ?>!</h4>
                </div>

                <div class="card-body">
                    <p class="lead mb-4 fs-3" style="color:black;">Here's what you can do:</p>

                    <div class="row text-center">
                        <div class="col-md-4 mb-4">
                            <a href="<?php echo e(route('recipes.create')); ?>" class="btn btn-accent w-100 rounded-[600] py-3">
                                📝 Submit a Recipe
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="<?php echo e(route('recipes.list')); ?>" class="btn btn-outline-accent w-100 rounded-[600] py-3">
                                📖 View All Recipes
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-outline-secondary w-100 rounded-[600] py-3">
                                👤 Edit Profile
                            </a>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Alternate Ingredient Search -->
                <div class="container my-8">
                    <div class="alternative-search">
                        <h4 class="text-center mb-3" style="font-weight: 700; color: black;">Find Ingredient Alternatives</h4>
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

                    <!-- <hr class="my-4"> -->

                    <!-- <h5 class="mb-3" style="color:black;">📌 Your Activity</h5>
                    <ul class="list-group">
                    <a href="<?php echo e(route('recipes.my')); ?>" class="list-group-item list-group-item-action">
                      ⭐ Recipes you’ve submitted
                </a>
                 <a href="<?php echo e(route('alternatives.myreviews')); ?>" class="list-group-item list-group-item-action">
                    🧂 Ingredient alternatives you’ve reviewed
                </a>
                 <a href="<?php echo e(route('reviews.my')); ?>" class="list-group-item list-group-item-action">
                    💬 Recipe comments or reviews
               </a>
                    </ul> -->
           

                    <div class="mt-4 text-end">
                        <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-secondary rounded-[60px]">⬅ Back to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mah Gul\Downloads\smart-recipes-fixed\resources\views/dashboard.blade.php ENDPATH**/ ?>