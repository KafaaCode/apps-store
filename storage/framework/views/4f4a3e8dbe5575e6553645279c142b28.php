

<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .col-md-2 {
            margin: auto;
        }

        .hr-add {
            border: 0.5px solid #c9c9c9;
            margin: 6px 5%;
            width: 80%;
        }

        .row.card-header {
            background-color: #00000008;
            margin: 0 !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(isset($_GET['action']) == 'addGame'): ?>
        <!-- end row -->
        <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        <?php echo app('translator')->get('site.home'); ?>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        <?php echo app('translator')->get('translation.Add'); ?> <?php echo app('translator')->get('translation.Games'); ?>
        <?php $__env->endSlot(); ?>
        <?php echo $__env->renderComponent(); ?>
        <?php echo $__env->make('admin.vip.addGame', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php elseif(!isset($_GET['action'])): ?>
        <!-- end row -->
        <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        <?php echo app('translator')->get('site.home'); ?>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        <?php echo app('translator')->get('levels.Games'); ?>
        <?php $__env->endSlot(); ?>
        <?php echo $__env->renderComponent(); ?>
        <?php $__env->startPush('styles'); ?>
            <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <?php $__env->stopPush(); ?>

        <?php $__env->startPush('scripts'); ?>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#gamesTable').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json"
                        },
                        "order": [[0, "asc"]],
                        "responsive": true
                    });
                });
            </script>
        <?php $__env->stopPush(); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body border-bottom">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 card-title flex-grow-1"><?php echo app('translator')->get('translation.Games'); ?></h5>
                            <div class="flex-shrink-0 me-3">
                                <a href="<?php echo e(route('ad.vip-packages.index')); ?>" class="btn btn-primary">
                                    عرض الباقات
                                </a>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="<?php echo e(route('ad.vip.addGame')); ?>" class="btn btn-soft-primary">
                                    <?php echo app('translator')->get('translation.Add'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="gamesTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('translation.id'); ?></th>
                                        <th><?php echo app('translator')->get('translation.icon'); ?></th>
                                        <th><?php echo app('translator')->get('translation.slug'); ?></th>
                                        <th><?php echo app('translator')->get('translation.title'); ?></th>
                                        <th><?php echo app('translator')->get('translation.keywords'); ?></th>
                                        <th><?php echo app('translator')->get('translation.name_currency'); ?></th>
                                        <th><?php echo app('translator')->get('translation.need_name_player'); ?></th>
                                        <th><?php echo app('translator')->get('translation.need_id_player'); ?></th>
                                        <th><?php echo app('translator')->get('translation.price_qty'); ?></th>
                                        <th><?php echo app('translator')->get('translation.is_active'); ?></th>
                                        <th><?php echo app('translator')->get('translation.is_show'); ?></th>
                                        <th><?php echo app('translator')->get('translation.have_packages'); ?></th>
                                        <th><?php echo app('translator')->get('translation.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$i); ?></td>
                                            <th scope="row">
                                                <?php if($game->image): ?>
                                                    <img src="<?php echo e(asset('uploads/games/' . $game->image)); ?>" alt="game image" width="50">
                                                <?php else: ?>
                                                    —
                                                <?php endif; ?>
                                            </th>
                                            <td><?php echo e($game->slug); ?></td>
                                            <td><?php echo e($game->title); ?></td>
                                            <td><?php echo e($game->keywords); ?></td>
                                            <td><?php echo e($game->name_currency); ?></td>
                                            <td><?php echo e($game->name_player_string); ?></td>
                                            <td><?php echo e($game->id_player_string); ?></td>
                                            <td><?php echo e(number_format($game->price_qty, 2)); ?></td>
                                            <td><?php echo e($game->active_string); ?></td>
                                            <td><?php echo e($game->is_show_string); ?></td>
                                            <td><?php echo e($game->have_packages_string); ?></td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li>
                                                        <a href="<?php echo e(route('front.game.show', $game->slug)); ?>"
                                                            class="btn btn-sm btn-soft-primary" title="<?php echo app('translator')->get('translation.view'); ?>">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(route('ad.games.edit', $game->id)); ?>"
                                                            class="btn btn-sm btn-soft-primary" title="<?php echo app('translator')->get('translation.edit'); ?>">
                                                            <i class="mdi mdi-pencil-outline"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="btn btn-sm btn-soft-danger"
                                                            data-bs-toggle="modal" data-bs-target="#gameDelete_<?php echo e($game->id); ?>"
                                                            title="<?php echo app('translator')->get('translation.delete'); ?>">
                                                            <i class="mdi mdi-delete-outline"></i>
                                                        </button>
                                                    </li>
                                                    <?php if($game->have_packages == 1): ?>
                                                        <li>
                                                            <a href="<?php echo e(route('ad.games.packages', $game->id)); ?>"
                                                                class="btn btn-sm btn-soft-success"
                                                                title="<?php echo app('translator')->get('translation.ViewPackage'); ?>">
                                                                <i class="mdi mdi-eye-outline"></i>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </td>
                                        </tr>

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="gameDelete_<?php echo e($game->id); ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo app('translator')->get('translation.delete'); ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?php echo e(route('ad.games.destroy', $game->id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('delete'); ?>
                                                        <div class="modal-body">
                                                            <p><?php echo app('translator')->get('translation.titleDel'); ?> <strong><?php echo e($game->slug); ?></strong></p>
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
                            <div class="d-flex justify-content-end mt-4">
                                <?php echo $games->appends(request()->all())->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- apexcharts -->
    <script src="<?php echo e(URL::asset('/build/libs/apexcharts/apexcharts.min.js')); ?>"></script>

    <!-- dashboard init -->
    <script src="<?php echo e(URL::asset('build/js/pages/dashboard.init.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/vip/index.blade.php ENDPATH**/ ?>