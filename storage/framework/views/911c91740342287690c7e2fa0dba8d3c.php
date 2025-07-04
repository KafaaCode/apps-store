<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.index'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

    <body data-sidebar="dark" data-layout-scrollable="true">
<?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>
        
        <?php if($advertisement && $advertisement->active && $advertisement->getFirstMediaUrl('image')): ?>
            <div class="text-center mb-4">
                
                <div class="advertisement-container"
                    style="position: relative; display: inline-block; width: 100%; max-width: 600px;">
                    <img src="<?php echo e($advertisement->getFirstMediaUrl('image')); ?>" alt="Advertisement" class="img-fluid rounded"
                        style="width: 100%; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

                    
                    <?php if($advertisement->description): ?>
                        <div class="advertisement-text"
                            style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); background: rgba(0, 0, 0, 0.6); color: white; padding: 10px; font-size: 1.2rem; border-radius: 5px;">
                            <?php echo e($advertisement->description); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        
        <div class="app-search d-lg-block mb-4 animate__animated animate__fadeInDown">
            <div class="position-relative">
                <input type="text" class="form-control" id="searchInput" placeholder="<?php echo app('translator')->get('translation.Search'); ?>">
                <span class="bx bx-search-alt"></span>
            </div>
        </div>

        
        <div class="row">
            <div class="form-group products">
                <div class="form-row">
                    <div class="w-100">
                        <ul class="products_list" id="products_list">
                            <?php if(isset($categories)): ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="col-4 pr-0 pl-0">
                                        <a href="<?php echo e(route('front.game.category', $category->id)); ?>"
                                            class="product_group <?php if(!$category->active || $category->games->count() == 0): ?> disabled <?php endif; ?>"
                                            data-group="soulchill">
                                            <div class="name_wrp" style="background-image:url(<?php echo e($category->getFirstMediaUrl('image')); ?>);">
                                                <div class="icon">
                                                    <img src="<?php echo e($category->getFirstMediaUrl('image')); ?>" alt="<?php echo e($category->name); ?>" width="90">
                                                </div>
                                            </div>
                                            <span class="d-block mt-2 mb-2"><?php echo e($category->name); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('script'); ?>
        
        <script>
            $(document).ready(function () {
                // الحركة عند الكتابة
                $('#searchInput').on('input', function () {
                    $(this).addClass('animate__animated animate__pulse');
                    setTimeout(() => {
                        $(this).removeClass('animate__animated animate__pulse');
                    }, 500);
                });

                // فحص النص المدخل في البحث لعرض أو إخفاء التصنيفات
                $('#searchInput').on('keyup', function () {
                    var value = $(this).val().toLowerCase();
                    $('#products_list li').filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u187789736/domains/zain-market.com/public_html/resources/views/front/index.blade.php ENDPATH**/ ?>