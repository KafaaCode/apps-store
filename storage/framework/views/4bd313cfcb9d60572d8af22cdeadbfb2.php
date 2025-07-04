
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Dashboards <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> Dashboard <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-center gap-3">
                    <i class="fas fa-university fa-3x text-primary"></i>
                    <div>
                        <h5 class="card-title mb-2">البنوك</h5>
                        <h2 class="text-primary"><?php echo e($stats['banks']); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-success border-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-center gap-3">
                    <i class="fas fa-list-alt fa-3x text-success"></i>
                    <div>
                        <h5 class="card-title mb-2">الأقسام</h5>
                        <h2 class="text-success"><?php echo e($stats['categories']); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-warning border-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-center gap-3">
                    <i class="fas fa-gamepad fa-3x text-warning"></i>
                    <div>
                        <h5 class="card-title mb-2">الألعاب</h5>
                        <h2 class="text-warning"><?php echo e($stats['games']); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-danger border-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-center gap-3">
                    <i class="fas fa-shopping-cart fa-3x text-danger"></i>
                    <div>
                        <h5 class="card-title mb-2">الطلبات</h5>
                        <h2 class="text-danger"><?php echo e($stats['orders']); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-info border-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-center gap-3">
                    <i class="fas fa-truck fa-3x text-info"></i>
                    <div>
                        <h5 class="card-title mb-2">المزودين</h5>
                        <h2 class="text-info"><?php echo e($stats['providers']); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-dark border-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-center gap-3">
                    <i class="fas fa-users fa-3x text-dark"></i>
                    <div>
                        <h5 class="card-title mb-2">المستخدمين</h5>
                        <h2 class="text-dark"><?php echo e($stats['users']); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?php echo e(route('ad.vip.packages')); ?>" class="text-decoration-none">
                <div class="card border-start border-danger border-3 shadow">
                    <div class="card-body d-flex align-items-center justify-content-center gap-3">
                        <i class="fas fa-crown fa-3x text-danger"></i>
                        <div>
                            <h5 class="card-title mb-2">اشتراكات VIP</h5>
                            <h2 class="text-danger"><?php echo e($stats['vip_subscriptions']); ?></h2>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-center gap-3">
                    <i class="fas fa-wallet fa-3x text-primary"></i>
                    <div>
                        <h5 class="card-title mb-2">إجمالي رصيد المستخدمين</h5>
                        <h2 class="text-primary"><?php echo e(number_format($stats['total_user_balance'], 2)); ?>

                            $</h2>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-secondary border-3 shadow">
                <div class="card-body d-flex align-items-center justify-content-center gap-3">
                    <i class="fas fa-user-shield fa-3x text-secondary"></i>
                    <div>
                        <h5 class="card-title mb-2">المدراء</h5>
                        <h2 class="text-secondary"><?php echo e($stats['admins']); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">تطور الطلبات خلال 7 أيام</h5>
            <div id="ordersChart" style="height: 350px;"></div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/build/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/dashboard.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/build/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: { show: false }
                },
                series: [{
                    name: 'عدد الطلبات',
                    data: <?php echo json_encode($chartData, 15, 512) ?>
                }],
                xaxis: {
                    categories: <?php echo json_encode($chartLabels, 15, 512) ?>,
                    labels: { style: { fontSize: '14px' } }
                },
                colors: ['#556ee6'],
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 5
                },
                tooltip: {
                    x: {
                        format: 'yyyy-MM-dd'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#ordersChart"), options);
            chart.render();
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Personal\Freelancer\Asmar Market\public_html_downlaod\resources\views/admin/index.blade.php ENDPATH**/ ?>