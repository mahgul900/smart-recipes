<!-- resources/views/reviews/edit.blade.php -->



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
        .footer {
            background-color: #3e2f21;
            color: #fff;
            padding: 20px 0;
        }

        .footer a {
            color: #fff;
            margin: 0 10px;
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
            font-size: 18px;
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
        .h1, h1{
            font-size: 26px;
            font-weight: 600;
            color: black;
            margin-bottom: 25px;
        }
        .btn {
            background-color: #5c3d2e;
            color: white;
            border: none;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #3e2f21;
            color: white;
        }
    </style>

<div class="container">
    <h1>Edit Review</h1>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($error); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('reviews.update', $review->id)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>


        <div class="mb-3">
            <label for="stars" class="form-label">Stars</label>
            <select name="stars" id="stars" class="form-control">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e($review->stars == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="comment" class="form-control"><?php echo e($review->comment); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Review</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mah Gul\Downloads\smart-recipes-fixed\resources\views/reviews/edit.blade.php ENDPATH**/ ?>