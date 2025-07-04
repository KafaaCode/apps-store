
<?php $__env->startSection('title', 'اشتراكات VIP'); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> الإدارة <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> اشتراكات VIP <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="card">
        <div class="card-body table-responsive">
            <h4 class="mb-3">قائمة الاشتراكات</h4>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم المستخدم</th>
                        <th>البريد الإلكتروني</th>
                        <th>مدة الاشتراك</th>
                        <th>السعر</th>
                        <th>تاريخ البدء</th>
                        <th>تاريخ الانتهاء</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $vips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($vip->user?->name ?? '-'); ?></td>
                            <td><?php echo e($vip->user?->email ?? '-'); ?></td>
                            <td><?php echo e($vip->duration_days); ?> يوم</td>
                            <td><?php echo e(number_format($vip->price, 2)); ?> $</td>
                            <td><?php echo e(\Carbon\Carbon::parse($vip->start_at)->format('Y-m-d')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($vip->end_at)->format('Y-m-d')); ?></td>
                            <td>
                                <?php if($vip->is_active): ?>
                                    <span class="badge bg-success">نشط</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">منتهي</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">لا يوجد اشتراكات حالياً.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($vips->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/vip/userPackages.blade.php ENDPATH**/ ?>