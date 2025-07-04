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
                    <form method="POST" action="<?php echo e(route('ad.categories.update', $category)); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('categories.name'); ?><span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="<?php echo e(old('name', $category->name)); ?>" placeholder="<?php echo app('translator')->get('categories.name'); ?>">
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
                                    <label><?php echo app('translator')->get('banks.image'); ?></label>
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
                                <?php if(isset($bank->image)): ?>
                                    <img src="<?php echo e(asset('uploads/banks/' . $bank->image)); ?>" alt="bank image" width="100">
                                <?php endif; ?>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('categories.active'); ?><span class="text-danger">*</span></label>
                                    <select name="active" class="form-control">
                                        <option value="1" <?php echo e(old('active', $category->active) == 1 ? 'selected' : ''); ?>>
                                            <?php echo app('translator')->get('Active'); ?>
                                        </option>
                                        <option value="0" <?php echo e(old('active', $category->active) == 0 ? 'selected' : ''); ?>>
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
                                <i class="fa fa-save"></i> <?php echo app('translator')->get('Edit'); ?>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>