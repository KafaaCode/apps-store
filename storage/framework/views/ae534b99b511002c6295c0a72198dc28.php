

<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Dashboards'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?>
<?php echo app('translator')->get('site.home'); ?>
<?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>
<?php echo app('translator')->get('orders.orders'); ?>
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                <form method="GET" action="<?php echo e(route('ad.orders.index')); ?>" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <label><?php echo app('translator')->get('translation.invoice_no'); ?></label>
                            <input type="text" name="invoice_no" class="form-control"
                                value="<?php echo e(request('invoice_no')); ?>" placeholder="<?php echo app('translator')->get('بحث'); ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-search"></i> <?php echo app('translator')->get('search'); ?>
                            </button>
                        </div>
                    </div>
                </form>

                <?php if(@isset($orders) && !@empty($orders) && count($orders) > 0): ?>
                <div class="row">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('translation.invoice_no'); ?></th>
                                    <!-- <th scope="col"><?php echo app('translator')->get('orders.user'); ?></th> -->
                                    <th><?php echo app('translator')->get('translation.playerid'); ?></th>
                                    <th><?php echo app('translator')->get('translation.playername'); ?></th>
                                    <th><?php echo app('translator')->get('translation.status'); ?></th>
                                    <th><?php echo app('translator')->get('translation.name'); ?></th>
                                    <th><?php echo app('translator')->get('translation.qyt'); ?></th>
                                    <th><?php echo app('translator')->get('translation.base_total'); ?></th>
                                    <!-- <th><?php echo app('translator')->get('translation.profit_percentage'); ?></th>
                                    <th><?php echo app('translator')->get('translation.profit'); ?></th> -->
                                    <th><?php echo app('translator')->get('translation.final_total'); ?></th>
                                    <th><?php echo app('translator')->get('translation.note'); ?></th>
                                    <th><?php echo app('translator')->get('translation.date_at'); ?></th>
                                    <th><?php echo app('translator')->get('translation.action'); ?></th>

                                </tr>
                            </thead>


                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php ($game = $order->game); ?>
                                                <tr>
                                                    <td>#<?php echo e($order->invoice_no); ?></td>
                                                    <!-- <th scope="row"><?php echo e($order->user?->name); ?></th> -->
                                                    <td><?php echo e($order->player_id); ?></td>
                                                    <td><?php echo e($order->player_name); ?></td>
                                                    <td>
                                                        <span class="alert_<?php echo e($order->status); ?>">
                                                            <?php echo e(__('translation.' . $order->status)); ?>

                                                        </span>
                                                        <?php if($order->status == 'canceled'): ?>
                                                            <br>
                                                            <br>
                                                            <span class="w-100 text-center ">
                                                                <?php echo e($order->reason); ?>

                                                            </span>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td><?php echo e($game?->title); ?></td>
                                                    <td> <?php if($order->package): ?><?php echo e($order->qty); ?> × <?php echo e($order->package->quantity); ?>

                                                    <?php echo e($game->name_currency); ?> <?php else: ?> <?php echo e($order->qty); ?> <?php echo e($game->name_currency); ?> <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($order->base_total); ?></td>
                                                    <!-- <td><?php echo e($order->profit_percentage); ?>%</td>
                                                    <td><?php echo e($order->profit); ?></td> -->
                                                    <td><?php echo e($order->final_total); ?></td>
                                                    <td><?php echo e($order->details); ?></td>
                                                    <th scope="row">
                                                        <?php if($order): ?>
                                                            <?php echo e($order->created_at->diffForHumans()); ?> <br>
                                                            <?php echo e($order->created_at->format('Y-m-d')); ?>

                                                            (<?php echo e($order->created_at->format('h:i')); ?>)
                                                            <?php echo e(($order->created_at->format('A') == 'AM' ? __('am') : __('pm'))); ?> <br>
                                                        <?php else: ?>
                                                            <?php echo e(__('no_update')); ?>

                                                        <?php endif; ?>
                                                    </th>
                                                    <td>
                                                        <?php echo $__env->make('admin.orders.action', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </td>
                                                </tr>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="14">
                                                        <div class="float-right">
                                                        </div>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="d-flex justify-content-end mt-4">
                                            <?php echo $orders->appends(request()->all())->links(); ?>

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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>