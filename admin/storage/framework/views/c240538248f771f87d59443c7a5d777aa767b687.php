<?php
if($userdetails->user_type == 'Buyer') {
$atitle = "buyer";
} else {
$atitle = "seller";
}
?>


<?php $__env->startSection('title', 'Withdraw History'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Coin Withdraw History</h1>
    </header>
    <?php if(session('status')): ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

    </div>
    <?php endif; ?>
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
                                <a class="nav-link" href="<?php echo e(url('/admin/userdeposit/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin Deposit</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo e(url('/admin/user_withdraw/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin Withdraw</a>
                            </li>

                        </ul>

                        </br>
                    </div>

                    <div class="table-responsive search_result">
                        <table class="table" id="dows">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Date & Time</th>
                                    <th>Coin Name</th>
                                    <th>Txn ID</th>
                                    <th>Sender</th>
                                    <th>Recipient</th>
                                    <th>Amount</th>
                                    <th>Admin Fee</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($transaction) > 0): ?>
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
                                <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e(date('Y/m/d h:i:s', strtotime($transactions->created_at))); ?></td>
                                    <td><?php echo e($transactions->coin_name); ?></td>
                                    <td><?php echo e($transactions->transaction_id); ?></td>
                                    <td><?php echo e($transactions->sender); ?></td>
                                    <td><?php echo e($transactions->reciever); ?></td>
                                    <td><?php echo e(number_format($transactions->amount, 8, '.', '')); ?></td>
                                    <td><?php echo e(number_format($transactions->admin_fee, 8, '.', '')); ?></td>
                                    <td>
                                        <?php if($transactions->status == 0): ?>
                                        <a class="btn btn-success btn-xs" href="<?php echo e(url('/admin/crypto_withdraw_edit/'.\Crypt::encrypt($transactions->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a>
                                        <?php elseif($transactions->status == 2): ?> Cancelled
                                        <?php elseif($transactions->status == 1): ?>
                                        Success
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="10"> No record found!</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="pagination-tt clearfix">
                                <?php if($transaction->count()): ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/user/crypto_withdraw.blade.php ENDPATH**/ ?>