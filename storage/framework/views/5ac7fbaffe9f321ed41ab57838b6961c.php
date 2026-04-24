<?php $__env->startSection('content'); ?>
<h1 class="mb-4 fs-2 fw-bold">All Submitted Recipes</h1>

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
  .navbar-toggler{
    background-color: white;
  }
  .btn{
    background-color: #5c3d2e;
    color: white;
    border: none;
  }
  .btn1 {
    background-color: red;
    color: white;
    border: none;
    border-radius: 5px;
  }

  .btn:hover {
    background-color: #3e2f21;
    color: white;
  }
  .btn1:hover {
    background-color:rgb(181, 51, 51);
    color: white;
  }

  .card {
    z-index: 1;
  }
  .card-img-top {
    height: 200px;
    object-fit: cover;
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
.card-body {
    padding: 0.85rem;
}
.h5, h5 {
    font-size: 1.1rem;
    font-weight: 700;
}
.card-text {
    font-size: 0.85rem;
    margin-top: 0.3rem;
    line-height: 1.5;
}
  .h5, h5{
    font-size: 1.5rem;
    font-weight: 600;
  }
  .dropdown-toggle{
    text-transform: uppercase !important;
  }
  .card-body {
    padding: 1rem;
  }
  
  .card-title {
    margin-bottom: 1rem;
  }
  
  .card-subtitle {
    margin-bottom: 1.5rem;
  }
  
  .card-text {
    margin-top: 0.7rem;
    line-height: 1.6;
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



<form method="GET" action="<?php echo e(route('recipes.list')); ?>" class="input-group mb-4">
  <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Search recipes...">
  <button class="btn btn-primary" type="submit">Search</button>
</form>

<?php if(session('success')): ?>
  <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($recipes->count()): ?>
  <div class="row">
    <?php $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
          <?php if($recipe->images && $recipe->images->count()): ?>
            <img src="<?php echo e(asset('storage/' . $recipe->images->first()->path)); ?>" alt="Recipe Image" class="card-img-top recipe-image">
          <?php endif; ?>

          <div class="card-body d-flex flex-column">
            
            <h5 class="card-title">
              <a href="<?php echo e(route('recipes.show', $recipe->id)); ?>" class="text-decoration-none text-dark">
                <?php echo e($recipe->title); ?>

              </a>
            </h5>

            <h6 class="card-subtitle mb-2 text-muted">
              Submitted by: <?php echo e($recipe->user->name); ?>

              <?php if($recipe->user->is_admin): ?>
                <span class="badge bg-warning text-dark ms-2">Admin</span>
              <?php endif; ?>
            </h6>

            <p class="card-text"><strong>Ingredients:</strong> <?php echo e(Str::limit($recipe->ingredients, 80)); ?></p>
            <p class="card-text"><strong>Steps:</strong> <?php echo e(Str::limit($recipe->steps, 80)); ?></p>

            <p class="card-text mt-auto">
              <strong>Rating:</strong>
              <?php echo str_repeat('⭐', round($recipe->reviews->avg('stars'))); ?>

              (<?php echo e(number_format($recipe->reviews->avg('stars'), 1)); ?>)
            </p>

            <?php if(auth()->guard()->check()): ?>
              <?php if(auth()->id() === $recipe->user_id || auth()->user()->is_admin): ?>
                <a href="<?php echo e(route('recipes.edit', $recipe->id)); ?>" class="btn btn-sm btn-outline-primary me-6 mt-4">Edit</a>

                <form action="<?php echo e(route('recipes.destroy', $recipe->id)); ?>" method="POST" class="d-inline delete-confirm mt-2">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="btn1 btn-sm btn-outline-danger">Delete</button>
                </form>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  
  <div class="d-flex justify-content-center">
    <?php echo e($recipes->links('pagination::bootstrap-5')); ?>

  </div>
<?php else: ?>
  <p>No recipes found.</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mah Gul\Downloads\smart-recipes-fixed\resources\views/recipes/list.blade.php ENDPATH**/ ?>