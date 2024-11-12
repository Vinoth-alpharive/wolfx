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

                    <div class="tab-container">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(url('/admin/users_edit/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">User Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo e(url('/admin/transactionall/'.Crypt::encrypt($userdetails->id).'/BTC')); ?>" role="tab">Transactions</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/users_referral/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">Referral</a>
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

                    <div class="row">

                        <div class="col-md-6 col-sm-6 col-xs-12 tg-select-left cryptoleftb">
                            <select onchange="location = this.value;" class="form-control custom-s-left">

                                <?php if(isset($Commission)): ?>

                                <?php $__currentLoopData = $Commission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($coin == $value->source){ echo 'selected' ;} ?> value="<?php echo e(url('admin/transactionall/'.$id.'/'.$value->source)); ?>"><?php echo e($value->source); ?></option>


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </select>
                        </div>
                    </div>

                    <div class="table-responsive search_result">



                        <table class="table" id="dows">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Date & Time</th>
                                    <th>Type</th>
                                    <th>Credit balance</th>
                                    <th>Debit balance</th>
                                    <th>Wallet Balance</th>
                                    <th>Exits balance</th>
                                    <th>Updatefrom</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($results->count()): ?>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $histroy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e(date('Y-m-d h:i:s', strtotime($histroy->created_at))); ?></td>
                                    <td><?php echo e($histroy->type ? $histroy->type : '-'); ?></td>
                                    <td><?php echo e($histroy->credit ? $histroy->credit : '-'); ?></td>
                                    <td><?php echo e($histroy->debit  ? $histroy->debit  : '-'); ?></td>
                                    <td><?php echo e($histroy->balance ? $histroy->balance : '-'); ?></td>
                                    <td><?php echo e($histroy->oldbalance ? $histroy->oldbalance : '-'); ?></td>
                                    <td><?php echo e($histroy->update_from ? $histroy->update_from : '-'); ?></td>

                                    <td><?php echo e($histroy->remark  ? $histroy->remark :'-'); ?></td>


                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <td colspan="20"> <?php echo e('No record found! '); ?></td>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="pagination-tt clearfix">
                            <?php if($results->count()): ?>
                            <?php echo e($results->links()); ?>

                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/user/user_transactions.blade.php ENDPATH**/ ?>