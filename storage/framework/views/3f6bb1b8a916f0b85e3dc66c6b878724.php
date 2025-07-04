<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Dashboards'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?>
    <?php echo app('translator')->get('site.home'); ?>
    <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?>
    <?php echo app('translator')->get('settings.settings'); ?>
    <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('ad.settings.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label"> <?php echo app('translator')->get('translation.icon'); ?></label>
                                    <input type="file" class="form-control" name="image">
                                    <?php if($advertisement && $advertisement->getFirstMediaUrl('image')): ?>
                                        <div class="img-old mt-2">
                                            <img src="<?php echo e($advertisement->getFirstMediaUrl('image')); ?>" width="120">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><?php echo app('translator')->get('translation.description'); ?></label>
                                    <textarea class="form-control" name="description"
                                        rows="3"><?php echo e(old('description', $advertisement->description ?? '')); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><?php echo app('translator')->get('translation.status'); ?></label>
                                    <select name="actve" class="form-control">
                                        <option value="1" <?php echo e((isset($advertisement) && $advertisement->actve) ? 'selected' : ''); ?>><?php echo app('translator')->get('translation.active'); ?></option>
                                        <option value="0" <?php echo e((isset($advertisement) && !$advertisement->actve) ? 'selected' : ''); ?>><?php echo app('translator')->get('translation.inactive'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                    <?php echo app('translator')->get('Edit'); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/settings/advertisements.blade.php ENDPATH**/ ?>