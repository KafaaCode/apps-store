<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Dashboards'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> <?php echo app('translator')->get('site.home'); ?> <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php echo app('translator')->get('categories.categories'); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <a href="<?php echo e(route('ad.categories.create')); ?>" class="btn btn-soft-primary">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('Add'); ?>
                    </a>
                </div>

                <div class="card-body">
                    <?php if(isset($categories) && $categories->count()): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo app('translator')->get('categories.name'); ?></th>
                                        <th><?php echo app('translator')->get('categories.image'); ?></th>
                                        <th><?php echo app('translator')->get('categories.active'); ?></th>
                                        <th><?php echo app('translator')->get('Created_at'); ?></th>
                                        <th><?php echo app('translator')->get('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($i + 1); ?></td>
                                            <td><?php echo e($cat->name); ?></td>
                                            <td>
                                                <img src="<?php echo e($cat->image); ?>" alt="<?php echo e($cat->name); ?>" width="60">
                                            </td>
                                            <td><?php echo e($cat->active ? __('Active') : __('Inactive')); ?></td>
                                            <td><?php echo e($cat->created_at->diffForHumans()); ?></td>
                                            <td>
                                                <?php echo $__env->make('admin.categories.action', ['category' => $cat], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <div class="float-right">
                                <?php echo $categories->links(); ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <?php echo e(__('data_no_found')); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u187789736/domains/zain-market.com/public_html/resources/views/admin/categories/index.blade.php ENDPATH**/ ?>