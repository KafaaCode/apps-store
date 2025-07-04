
<a href="<?php echo e(route('ad.categories.games.index', $category->id)); ?>"
   class="btn btn-info btn-sm"
   title="<?php echo app('translator')->get('categories.view_products'); ?>">
    <i class="fa fa-box"></i>
</a>


<a href="<?php echo e(route('ad.categories.edit', $category->id)); ?>"
   class="btn btn-warning btn-sm"
   title="<?php echo app('translator')->get('categories.edit'); ?>">
    <i class="fa fa-edit"></i>
</a>


<button type="button"
        class="btn btn-sm btn-danger"
        data-bs-toggle="modal"
        title="<?php echo app('translator')->get('categories.delete'); ?>"
        data-bs-target="#delete<?php echo e($category->id); ?>">
    <i class="fa fa-trash"></i>
</button>


<div class="modal fade" id="delete<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="deleteLabel<?php echo e($category->id); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel<?php echo e($category->id); ?>"><?php echo app('translator')->get('categories.delete'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo app('translator')->get('categories.cancel'); ?>"></button>
            </div>
            <form action="<?php echo e(route('ad.categories.destroy', $category->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="modal-body">
                    <p><?php echo app('translator')->get('categories.titleDel'); ?> <strong><?php echo e($category->name); ?></strong>؟</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger"><?php echo app('translator')->get('categories.save'); ?></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('categories.cancel'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/categories/action.blade.php ENDPATH**/ ?>