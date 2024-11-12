<?php
if($userdetails->user_type == 'Buyer') {
$atitle = "buyer";
} else {
$atitle = "seller";
}
?>


<?php $__env->startSection('title', ' Users Wallet'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>User Wallet</h1>
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

                    </br>

                    <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>


                    <?php if(session('error')): ?>
                    <div class="alert alert-warning">
                        <?php echo e(session('error')); ?>

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
                                <a class="nav-link active" href="<?php echo e(url('/admin/users_wallet/'.Crypt::encrypt($userdetails->id))); ?>" role="tab">Wallet</a>
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
                    </br>
                    <form action="<?php echo e(url('/admin/Balance_update')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php $__currentLoopData = $coins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($coin->type != 'fiat'): ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo e($coin->source); ?> Address</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <?php if(isset($balance[$coin->source]['address']) && $balance[$coin->source]['address'] !=""): ?>
                                    <input type="text" name="from_address" class="form-control" value="<?php echo e($balance[$coin->source]['address']); ?>" readonly><i class="form-group__bar"></i>
                                    <?php else: ?>
                                    <input type="text" name="from_address" class="form-control" value="No Address" readonly><i class="form-group__bar"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo e($coin->source); ?> Available Balance</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <?php if(isset($balance[$coin->source]['balance']) && $balance[$coin->source]['balance'] > 0): ?>

                                    <?php if($coin->source == 'NGN'): ?>
                                    <input type="number" name="balance_<?php echo e($coin->source); ?>" class="form-control" value="<?php echo e(display_format($balance[$coin->source]['balance'],0)); ?>" step="0.00001" min="0" max="100000000" readonly><i class="form-group__bar"></i>
                                    <?php else: ?>
                                    <input type="number" name="balance_<?php echo e($coin->source); ?>" class="form-control" value="<?php echo e($balance[$coin->source]['balance']); ?>" step="0.00001" min="0" max="100000000" readonly><i class="form-group__bar"></i>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <input type="number" name="balance_<?php echo e($coin->source); ?>" class="form-control" value="0" step="0.00001" min="0" max="100000000" readonly><i class="form-group__bar"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </form>
                    <h4>Balance update:</h4>
                    <form action="<?php echo e(url('/admin/Balance_update')); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>


                        </br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coin/Currency</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">

                                    <select class="form-control" name="coin">
                                        <option value="">Select coin/currency</option>
                                        <?php $__currentLoopData = $Commission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->source); ?>"><?php echo e($value->source); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('coin')): ?>
                                    <span class="help-block error-msg">
                                        <strong><?php echo e($errors->first('coin')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">

                                    <input type="number" name="amount" class="form-control" value="" step="0.00001" min="0" max="100000000"><i class="form-group__bar"></i>

                                    <input type="hidden" name="uid" value="<?php echo e($userdetails->id); ?>">



                                    <?php if($errors->has('amount')): ?>
                                    <span class="help-block error-msg">
                                        <strong><?php echo e($errors->first('amount')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Remark</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">

                                    <input type="text" name="remark" class="form-control"><i class="form-group__bar"></i>

                                    <?php if($errors->has('remark')): ?>
                                    <span class="help-block error-msg">
                                        <strong><?php echo e($errors->first('remark')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-success btn-xs" type="submit" name="submit" value="Update">

                    </form>
                </div>




            </div>

        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/user/wallet.blade.php ENDPATH**/ ?>