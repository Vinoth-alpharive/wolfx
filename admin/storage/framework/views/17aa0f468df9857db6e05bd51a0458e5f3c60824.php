<?php
if($userdetails->user_type == 'Buyer') {
$atitle = "buyer";
} else {
$atitle = "seller";
}
?>


<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>View User Details</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <?php if($userdetails->user_type == 'Buyer'): ?>
                    <a href="<?php echo e(url('admin/buyer')); ?>"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    <?php else: ?>
                    <a href="<?php echo e(url('admin/seller')); ?>"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    <?php endif; ?>

                    <br /><br />
                    <?php if(session('updated_status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('updated_status')); ?>

                    </div>
                    <?php endif; ?>

                    <?php if(session('updated_error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('updated_error')); ?>

                    </div>
                    <?php endif; ?>

                    <div class="tab-container">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(url('/admin/users_edit/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">User Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/transactionall/'.Crypt::encrypt($userdetails->id).'/BTC')); ?>" role="tab">Transactions</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo e(url('/admin/users_referral/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Referral</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/users_wallet/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Wallet</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/userdeposit/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin Deposit</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/user_withdraw/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin Withdraw</a>
                            </li>

                        </ul>

                        </br>
                    </div>

                    <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                        <table class="table" id="dows">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone no</th>
                                    <th>Referral id</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i =1;

                                $limit=15;

                                if(isset($_GET['page'])){
                                $page = $_GET['page'];
                                $i = (($limit * $page) - $limit)+1;
                                }else{
                                $i =1;
                                }
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $userref; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->phone_no); ?></td>
                                    <td><?php echo e($user->referral_id); ?></td>
                                    <td><?php echo e($user->created_at); ?></td>

                                </tr>
                                <?php
                                $i++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="10">
                                        <div class="alert alert-info">Yet no user available</div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/user/user_referral.blade.php ENDPATH**/ ?>