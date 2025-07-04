
<?php $__env->startSection('title', 'إضافة باقة VIP'); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> الإدارة <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> إضافة باقة <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<form action="<?php echo e(route('ad.vip-packages.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">عنوان الباقة</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">السعر (ل.س)</label>
        <input type="number" name="price" step="0.01" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">عدد الأيام</label>
        <input type="number" name="duration_days" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">💾 حفظ</button>
    <a href="<?php echo e(route('ad.vip-packages.index')); ?>" class="btn btn-secondary">إلغاء</a>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/vip_packages/create.blade.php ENDPATH**/ ?>