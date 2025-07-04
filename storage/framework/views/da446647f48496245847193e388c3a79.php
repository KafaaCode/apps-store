

<?php $__env->startSection('title', 'إدارة باقات VIP'); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> الإدارة <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> باقات VIP <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<div class="d-flex justify-content-end mb-3">
    <a href="<?php echo e(route('ad.vip-packages.create')); ?>" class="btn btn-primary">➕ إضافة باقة جديدة</a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>السعر</th>
                    <th>عدد الأيام</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($package->title); ?></td>
                    <td><?php echo e($package->price); ?> ل.س</td>
                    <td><?php echo e($package->duration_days); ?> يوم</td>
                    <td>
                        <a href="<?php echo e(route('ad.vip-packages.edit', $package->id)); ?>" class="btn btn-warning btn-sm">✏️ تعديل</a>
                        <form action="<?php echo e(route('ad.vip-packages.destroy', $package->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm">🗑 حذف</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($packages->isEmpty()): ?>
                    <tr>
                        <td colspan="5" class="text-center">لا توجد باقات حالياً.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/vip_packages/index.blade.php ENDPATH**/ ?>