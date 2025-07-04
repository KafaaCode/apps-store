

<?php $__env->startSection('title', __('Financial Transactions')); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')); ?>"
        rel="stylesheet" />
    <link href="<?php echo e(URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')); ?>"
        rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> <?php echo app('translator')->get('site.home'); ?> <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php echo app('translator')->get('Financial Transactions'); ?> <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <a href="<?php echo e(route('ad.finance.index', ['type' => 'in'])); ?>"
                    class="btn btn-success <?php echo e($type == 'in' ? 'active' : ''); ?>">الوارد</a>
                <a href="<?php echo e(route('ad.finance.index', ['type' => 'out'])); ?>"
                    class="btn btn-danger <?php echo e($type == 'out' ? 'active' : ''); ?>">الصادر</a>
            </div>

            <form method="GET" action="<?php echo e(route('ad.finance.index')); ?>" class="form-inline">
                <input type="hidden" name="type" value="<?php echo e($type); ?>" />
                <div class="form-group mx-1">
                    <input type="date" name="from_date" class="form-control" placeholder="From" value="<?php echo e($fromDate); ?>">
                </div>
                <div class="form-group mx-1">
                    <input type="date" name="to_date" class="form-control" placeholder="To" value="<?php echo e($toDate); ?>">
                </div>
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Filter'); ?></button>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="alert alert-success">
                <strong>مجموع الوارد</strong> <?php echo e(number_format($totalIn, 2)); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-danger">
                <strong>مجموع الصادر</strong> <?php echo e(number_format($totalOut, 2)); ?>

            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <?php if($items->count() > 0): ?>
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('ID'); ?></th>
                                <th><?php echo app('translator')->get('User'); ?></th>
                                <?php if($type == 'in'): ?>
                                    <th><?php echo app('translator')->get('Invoice No'); ?></th>
                                    <th><?php echo app('translator')->get('Player Name'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Quantity'); ?></th>
                                <?php else: ?>
                                    <th><?php echo app('translator')->get('Invoice No'); ?></th>
                                    <th><?php echo app('translator')->get('Account Number'); ?></th>
                                    <th><?php echo app('translator')->get('Account Name'); ?></th>
                                <?php endif; ?>
                                <th><?php echo app('translator')->get('Final Total'); ?></th>
                                <th><?php echo app('translator')->get('Date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->id); ?></td>
                                    <td><?php echo e($item->user?->name ?? '-'); ?></td>

                                    <?php if($type == 'in'): ?>
                                        <td>#<?php echo e($item->invoice_no); ?></td>
                                        <td><?php echo e($item->player_id); ?></td>
                                        <td><?php echo e($item->player_name); ?></td>
                                        <td>
                                            <span class="badge 
                                                                    <?php if($item->status == 'approved'): ?> bg-success
                                                                    <?php elseif($item->status == 'pending'): ?> bg-warning
                                                                    <?php else: ?> bg-danger <?php endif; ?>">
                                                <?php echo e(ucfirst($item->status)); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($item->qty); ?></td>
                                    <?php else: ?>
                                        <td>#<?php echo e($item->invoice_no); ?></td>
                                        <td><?php echo e($item->account_number); ?></td>
                                        <td><?php echo e($item->account_name); ?></td>
                                    <?php endif; ?>

                                    <td><?php echo e(number_format($item->final_total, 2)); ?></td>
                                    <td><?php echo e($item->created_at->format('Y-m-d H:i')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="<?php echo e($type == 'in' ? 7 : 6); ?>" class="text-end"><?php echo app('translator')->get('Total'); ?>:</th>
                                <th><?php echo e(number_format($total, 2)); ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mt-3">
                        <?php echo e($items->appends(request()->except('page'))->links()); ?>

                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning"><?php echo app('translator')->get('No data found'); ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('build/libs/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/jszip/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/pdfmake/build/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/pdfmake/build/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('build/js/pages/datatables.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u187789736/domains/asmar-card.com/public_html/resources/views/admin/IncomingOutgoing/index.blade.php ENDPATH**/ ?>