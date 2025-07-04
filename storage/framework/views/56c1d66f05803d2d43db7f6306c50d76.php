<?php $__env->startSection('title'); ?>
    <?php echo e($category->name); ?> — <?php echo app('translator')->get('categories.view_products'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> <?php echo app('translator')->get('site.home'); ?> <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> <?php echo app('translator')->get('categories.categories'); ?> <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php echo e($category->name); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                
                <div class="card-body border-bottom d-flex justify-content-between">
                    <div>
                        <a href="<?php echo e(route('ad.games.create', ['category_id' => $category->id])); ?>"
                            class="btn btn-soft-primary">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('Add'); ?>
                        </a>
                    </div>
                    <div>
                        <a href="<?php echo e(route('ad.categories.index')); ?>" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> <?php echo app('translator')->get('back'); ?>
                        </a>
                    </div>
                </div>

                
                <div class="card-body">
                    <?php if($games->count()): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo app('translator')->get('games.title'); ?></th>
                                        <th><?php echo app('translator')->get('games.is_show'); ?></th>
                                        <th><?php echo app('translator')->get('Created_at'); ?></th>
                                        <th><?php echo app('translator')->get('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($i + 1); ?></td>
                                            <td><?php echo e($game->title); ?></td>
                                            <td><?php echo e($game->is_show_string); ?></td>
                                            <td><?php echo e($game->created_at->diffForHumans()); ?></td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="<?php echo app('translator')->get('translation.view'); ?>">
                                                        <a href="<?php echo e(route('front.game.show', $game['slug'])); ?>"
                                                            class="btn btn-sm btn-soft-primary"><i
                                                                class="mdi mdi-eye-outline"></i></a>
                                                    </li>


                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="<?php echo app('translator')->get('translation.edit'); ?>">
                                                        <a href="<?php echo e(route('ad.games.edit', $game['id'])); ?>"
                                                            class="btn btn-sm btn-soft-primary">
                                                            <i class="mdi mdi-pencil-outline"></i>

                                                        </a>
                                                    </li>




                                                    <button type="button" class="btn btn-sm btn-soft-danger" data-bs-toggle="modal"
                                                        title="<?php echo app('translator')->get('translation.delete'); ?>"
                                                        data-bs-target="#gameDelete_<?php echo e($game['id']); ?>">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>

                                                    <?php if($game->have_packages == 1): ?>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="<?php echo app('translator')->get('translation.ViewPackage'); ?>">
                                                            <a href="<?php echo e(route('ad.games.packages', $game->id)); ?>"
                                                                class="btn btn-sm btn-soft-success"><i
                                                                    class="mdi mdi-eye-outline"></i></a>
                                                        </li>


                                                    <?php endif; ?>




                                                </ul>
                                            </td>
                                        </tr>
                                        <!-- model edit-->
                                        <div class="modal fade" id="gameDelete_<?php echo e($game['id']); ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            <?php echo app('translator')->get('translation.delete'); ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?php echo e(route('ad.games.destroy', $game['id'])); ?>" method="POST">

                                                        <div class="modal-body">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <p> <?php echo app('translator')->get('translation.titleDel'); ?> <span><?php echo e($game['slug']); ?></span> </p>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-danger"><?php echo app('translator')->get('translation.delete'); ?></button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal"><?php echo app('translator')->get('translation.close'); ?></button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="float-right">
                            <?php echo $games->links(); ?>

                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <?php echo app('translator')->get('games.no_found'); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/categories/games.blade.php ENDPATH**/ ?>