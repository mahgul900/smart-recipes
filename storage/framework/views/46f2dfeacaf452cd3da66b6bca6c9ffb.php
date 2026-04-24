<?php $__env->startSection('content'); ?>
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

.alt-card {
    background: white;
    border: 1px solid #dac4a2;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    margin-bottom: 0.7rem;
    transition: box-shadow 0.2s;
}
.alt-card:hover { box-shadow: 0 3px 12px rgba(92,61,46,0.1); }
.alt-name { font-size: 1.1rem; font-weight: 700; color: #3e2f21; }
.stars-row { color: #f59e0b; font-size: 1rem; }
.badge-count { background: #f3ece3; color: #5c3d2e; font-size: 0.75rem; padding: 2px 8px; border-radius: 999px; font-weight: 600; }
.notes-text { font-size: 0.92rem; color: #5c3d2e; font-style: italic; margin-bottom: 0.4rem; }
.review-comment { font-size: 0.9rem; color: #3e2f21; border-left: 3px solid #dac4a2; padding-left: 8px; margin: 4px 0; }
.section-title { font-size: 1.1rem; font-weight: 700; color: #5c3d2e; border-bottom: 2px solid #dac4a2; padding-bottom: 6px; margin-bottom: 0.8rem; }
.comment-input { font-size: 14px; width: 100%; padding: 0.4rem 0.6rem; border: 1px solid #dac4a2; border-radius: 6px; height: 38px; font-family: 'Quicksand', sans-serif; color: black; resize: none; }
.comment-input:focus { border-color: #5c3d2e; outline: none; box-shadow: 0 0 0 0.15rem rgba(92,61,46,0.15); }
.btn-accent { background-color: #5c3d2e; color: white; border: none; padding: 0.35rem 0.9rem; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.85rem; }
.btn-accent:hover { background-color: #3e2f21; color: white; }
.rate-block { font-size: 0.88rem; font-weight: 700; color: #3e2f21; margin-bottom: 2px; }
select.form-select-sm { border: 1px solid #dac4a2; border-radius: 6px; padding: 4px 8px; font-family: 'Quicksand', sans-serif; font-size: 0.88rem; }
.no-results { background: #fff7f0; border: 1px solid #dac4a2; border-radius: 10px; padding: 1.5rem; text-align: center; color: #7a5c3d; }
.search-box { border: 2px solid #dac4a2; border-radius: 8px; padding: 0.5rem 0.9rem; font-family: 'Quicksand', sans-serif; font-size: 0.95rem; color: #3e2f21; width: 100%; }
.search-box:focus { border-color: #5c3d2e; outline: none; }
</style>

<div class="container py-4" style="max-width: 780px;">

    
    <form method="GET" action="<?php echo e(route('alternatives.search')); ?>" class="mb-4 d-flex gap-2">
        <input type="text" name="query" value="<?php echo e($ingredient); ?>" placeholder="Search an ingredient (e.g. egg, butter, milk)..." class="search-box">
        <button type="submit" class="btn-accent px-3" style="white-space:nowrap;">Search</button>
    </form>

    <?php if(session('success')): ?>
        <div class="alert alert-success py-2"><?php echo e(session('success')); ?></div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger py-2"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <?php if($ingredient): ?>
        <h5 class="fw-bold mb-3">
            Alternatives for: <span style="color:#5c3d2e;"><?php echo e(ucfirst($ingredient)); ?></span>
        </h5>

        
        <?php if($seededAlternatives->isNotEmpty()): ?>
            <div class="section-title">Suggested Alternatives</div>
            <?php $__currentLoopData = $seededAlternatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alt-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 mb-1">
                        <span class="alt-name"><?php echo e($item->alternative); ?></span>
                    </div>
                    <?php if($item->notes): ?>
                        <p class="notes-text"><?php echo e($item->notes); ?></p>
                    <?php endif; ?>

                    <?php if(auth()->guard()->check()): ?>
                        <?php
                            $alreadyReviewed = \App\Models\AlternativeReview::where('user_id', auth()->id())
                                ->where('ingredient', $ingredient)
                                ->where('alternative', $item->alternative)
                                ->exists();
                        ?>
                        <?php if(!$alreadyReviewed): ?>
                            <form method="POST" action="<?php echo e(route('alternatives.review')); ?>" class="mt-2">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="ingredient" value="<?php echo e($ingredient); ?>">
                                <input type="hidden" name="alternative" value="<?php echo e($item->alternative); ?>">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div>
                                        <label class="rate-block">Rate:</label>
                                        <select name="stars" class="form-select form-select-sm">
                                            <?php for($i=1;$i<=5;$i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?> ⭐</option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="rate-block">Comment (optional):</label>
                                        <input type="text" name="comment" class="search-box" style="height:34px; padding: 0.3rem 0.7rem;" placeholder="Share your experience...">
                                    </div>
                                    <div style="padding-top:18px;">
                                        <button type="submit" class="btn-accent">Submit</button>
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <p class="text-success mb-0" style="font-size:0.8rem;">You already reviewed this alternative.</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="mb-0" style="font-size:0.8rem; color:#7a5c3d;"><a href="<?php echo e(route('login')); ?>" style="color:#5c3d2e;">Login</a> to rate this alternative.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        
        <?php if($scoredAlternatives->isNotEmpty()): ?>
            <div class="section-title mt-3">Community Ratings</div>
            <?php $__currentLoopData = $scoredAlternatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alt-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 mb-1">
                        <span class="alt-name"><?php echo e($alt['name']); ?></span>
                        <span class="badge-count"><?php echo e($alt['count']); ?> <?php echo e(Str::plural('review', $alt['count'])); ?></span>
                    </div>
                    <div class="stars-row mb-1">
                        <?php for($i=1;$i<=5;$i++): ?>
                            <span><?php echo e($i <= round($alt['avg_stars']) ? '★' : '☆'); ?></span>
                        <?php endfor; ?>
                        <span class="text-muted ms-1" style="font-size:0.8rem;"><?php echo e($alt['avg_stars']); ?> / 5</span>
                    </div>

                    <?php $__currentLoopData = $alt['reviews']->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($review->comment): ?>
                            <div class="review-comment">"<?php echo e($review->comment); ?>" — <em><?php echo e($review->user->name ?? 'User'); ?></em></div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(auth()->guard()->check()): ?>
                        <?php $alreadyReviewed = $alt['reviews']->firstWhere('user_id', auth()->id()); ?>
                        <?php if(!$alreadyReviewed): ?>
                            <form method="POST" action="<?php echo e(route('alternatives.review')); ?>" class="mt-2">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="ingredient" value="<?php echo e($ingredient); ?>">
                                <input type="hidden" name="alternative" value="<?php echo e($alt['name']); ?>">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div>
                                        <label class="rate-block">Rate:</label>
                                        <select name="stars" class="form-select form-select-sm">
                                            <?php for($i=1;$i<=5;$i++): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?> ★</option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="flex-grow-1">
                                        <label class="rate-block">Comment (optional):</label>
                                        <input type="text" name="comment" class="search-box" style="height:34px; padding: 0.3rem 0.7rem;" placeholder="Share your experience...">
                                    </div>
                                    <div style="padding-top:18px;">
                                        <button type="submit" class="btn-accent">Submit</button>
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <p class="text-success mb-0" style="font-size:0.8rem;">You already reviewed this.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if($seededAlternatives->isEmpty() && $scoredAlternatives->isEmpty()): ?>
            <div class="no-results">
                <p class="mb-1">No alternatives found for <strong><?php echo e(ucfirst($ingredient)); ?></strong>.</p>
                <p class="mb-0 text-muted" style="font-size:0.85rem;">Try: egg, butter, milk, sugar, flour, cream, ghee, yogurt, oil, tomato, onion</p>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="no-results">
            <p class="mb-1">Search for an ingredient above to see its alternatives.</p>
            <p class="text-muted mb-0" style="font-size:0.85rem;">Try: <strong>egg</strong>, <strong>butter</strong>, <strong>milk</strong>, <strong>sugar</strong>, <strong>flour</strong>, <strong>ghee</strong></p>
        </div>
    <?php endif; ?>

    <div class="mt-3">
        <a href="<?php echo e(url('/')); ?>" class="btn-accent px-3 py-2" style="text-decoration:none; border-radius:8px;">Back to Home</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mah Gul\Downloads\smart-recipes-fixed\resources\views/alternatives/search_results.blade.php ENDPATH**/ ?>