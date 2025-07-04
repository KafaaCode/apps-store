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
                    <a href="<?php echo e(route('ad.categories.index')); ?>" class="btn btn-soft-primary">
                        <?php echo app('translator')->get('Back'); ?>
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('ad.categories.store')); ?>"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('categories.name'); ?><span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                           class="form-control"
                                           value="<?php echo e(old('name')); ?>"
                                           placeholder="<?php echo app('translator')->get('categories.name'); ?>">
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('categories.image'); ?><span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control">
                                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('categories.active'); ?><span class="text-danger">*</span></label>
                                    <select name="active" class="form-control">
                                        <option value="1" <?php echo e(old('active')==1?'selected':''); ?>>
                                            <?php echo app('translator')->get('Active'); ?>
                                        </option>
                                        <option value="0" <?php echo e(old('active')==0?'selected':''); ?>>
                                            <?php echo app('translator')->get('Inactive'); ?>
                                        </option>
                                    </select>
                                    <?php $__errorArgs = ['active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> <?php echo app('translator')->get('Add'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u187789736/domains/asmar-card.com/public_html/resources/views/admin/categories/create.blade.php ENDPATH**/ ?>