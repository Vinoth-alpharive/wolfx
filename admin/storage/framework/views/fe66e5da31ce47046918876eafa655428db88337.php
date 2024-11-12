<?php
$atitle ="dashboard";
?>

<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>dashboard</h1>
    </header>
    <div class="row quick-stats listview2">
        <?php if(in_array("buyers", explode(',',$AdminProfiledetails->dashboard))): ?>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

        <a style="font-size: 20px;" href="<?php echo e(url('/admin/buyer')); ?>">

            <div class="quick-stats__item">

                <div class="quick-stats__info col-md-8">
                    <h2><?php echo e($details['buyer']); ?></h2>
                     <small style="font-size: 20px; color:#fff">Buyer's</small> 
                </div>
                <div class="col-md-4 text-right">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            </a>
        </div>
        <?php endif; ?>
        <?php if(in_array("sellers", explode(',',$AdminProfiledetails->dashboard))): ?>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <a style="font-size: 20px;" href="<?php echo e(url('admin/seller')); ?>"> 
            <div class="quick-stats__item">
                <div class="quick-stats__info col-md-8">
                    <h2><?php echo e($details['seller']); ?></h2>
                   <small style="font-size: 20px; color:#fff">Seller's</small> 
                </div>
                <div class="col-md-4 text-right">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            </a>
        </div>
        <?php endif; ?>
        

        

    </div>

    <div class="row">
        <div class="col-md-6">
        
            <div class="card">
                <?php if(in_array("coinrequest", explode(',',$AdminProfiledetails->dashboard))): ?>
                <div class="card-body">
                    <h4 class="card-title">Recent Coin Withdraw Request (Pending)</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>User Name</th>
                                    <th>Coin/Token</th>
                                    <th>Amount</th>
                                    <th>Withdraw Fee</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($details['withdraw_request'])): ?>
                                <?php $__currentLoopData = $details['withdraw_request']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw_requests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(date('m-d-Y H:i:s', strtotime($withdraw_requests->created_at))); ?></td>
                                    <td><?php echo e(username($withdraw_requests->uid)); ?></td>
                                    <td><?php echo e($withdraw_requests->coin_name); ?></td>
                                    <td><?php echo e(display_format($withdraw_requests->amount, 8, '.', '')); ?></td>
                                    <td><?php echo e(display_format($withdraw_requests->admin_fee, 8, '.', '')); ?></td>
                                    <td>Awaiting Confirmation </td>
                                    <td><a class="btn btn-success btn-xs" href="<?php echo e(url('/admin/crypto_withdraw_edit'.'/'.Crypt::encrypt($withdraw_requests->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a> </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="6"> No Record Found!</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if(in_array("userdetails", explode(',',$AdminProfiledetails->dashboard))): ?>
        <div class="col-md-6">
            <div class="card widget-past-days">
                <div class="card-body">
                    <h4 class="card-title">User Details</h4>
                </div>
                <div class="listview listview--bordered listview1">
                    <div class="listview__item">
                        <div class="widget-past-days__info col-md-8"> <a href="<?php echo e(url('admin/users')); ?>"> <small>Total Users</small>
                                <h3><?php echo e($details['totalusers']); ?></h3>
                            </a>
                        </div>
                        <div class="col-md-4 text-right">
                            <h1><i class="zmdi zmdi-accounts-alt"></i></h1>
                        </div>
                    </div>
                    
        </div>
    </div>
    <?php endif; ?>

    
    </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/dashboard.blade.php ENDPATH**/ ?>