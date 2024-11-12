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
        <h1>Coin deposit history</h1>
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

                    <div class="tab-container">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/users_edit/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">User Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/transactionall/'.Crypt::encrypt($userdetails->id).'/BTC')); ?>" role="tab">Transactions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/users_referral/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Referral</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/users_wallet/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Wallet</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo e(url('/admin/userdeposit/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin Deposit</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/user_withdraw/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin Withdraw</a>
                            </li>

                        </ul>

                        </br>
                    </div>
                    <div class="table-responsive search_result">

                        <table class="table" id="dows">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Date & Time</th>
                                    <th>Coin Name</th>
                                    <th>Txn ID</th>
                                    <th>Sender</th>
                                    <th>Recipient</th>
                                    <th>Amount</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if($depositList->count()): ?>

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
                                <?php $__currentLoopData = $depositList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $histroy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e(date('Y-m-d h:i:s', strtotime($histroy->created_at))); ?> </td>
                                    <td><?php echo e($histroy->currency); ?></td>
                                    <td><?php echo e($histroy->txid); ?></td>
                                    <td><?php echo e($histroy->from_addr ? $histroy->from_addr : '-'); ?></td>
                                    <td><?php echo e($histroy->to_addr  ? $histroy->to_addr  : '-'); ?></td>
                                    <td><?php echo e($histroy->amount); ?></td>
                                    <td>
                                        <?php if($histroy->status==0): ?>
                                        <a class="btn btn-success btn-xs" href="<?php echo e(url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a>
                                        <?php elseif($histroy->status==2): ?>
                                        Approved
                                        <?php elseif($histroy->status==3): ?>
                                        Cancelled
                                        <?php else: ?>
                                        -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <td colspan="10"> <?php echo e('No record found! '); ?></td>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/user/user_deposit.blade.php ENDPATH**/ ?>