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
        .footer {
            background-color: #3e2f21;
            color: #fff;
            padding: 20px 0;
        }
        .footer a {
            color: #fff;
            margin: 0 10px;
        }
        .h5, h5{
            font-size: 1.3rem;
            font-weight: 600;
            color: black;
            padding-bottom: 8px;
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

<div class="container py-5" style="background-color: #fef9f4; min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 12px; background-color: #fff; border: 1px solid #dac4a2;">
                <div class="card-header" style="background-color: #5c3d2e; border-radius: 12px 12px 0 0; display:flex; align-item:center;">
                    <h4 class="" style="color: white; font-weight: 600">Edit Profile</h4>
                </div>

                <div class="card-body">

                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>⚠️ <?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control rounded-pill" value="<?php echo e(old('name', auth()->user()->name)); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <?php if(auth()->user()->is_admin): ?>
                                <input type="email" name="email" id="email" class="form-control rounded-pill" value="<?php echo e(auth()->user()->email); ?>" disabled>
                            <?php else: ?>
                                <input type="email" name="email" id="email" class="form-control rounded-pill" value="<?php echo e(old('email', auth()->user()->email)); ?>" required>
                            <?php endif; ?>
                        </div>

                        <hr class="my-4">

                        <h5>🔐 Change Password (optional)</h5>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control rounded-pill">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill">
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-accent rounded-[60px] px-4">Update Profile</button>
                            <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-outline-secondary rounded-[60px]">Back to Dashboard</a>
                        </div>
                    </form>

                    <hr class="my-4">

                    <form method="POST" action="<?php echo e(route('profile.destroy')); ?>" onsubmit="return confirm('Are you sure you want to delete your account?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn1 btn-danger rounded-[60px] px-3 py-2">Delete My Account</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mah Gul\Downloads\smart-recipes-fixed\resources\views/profile/edit.blade.php ENDPATH**/ ?>