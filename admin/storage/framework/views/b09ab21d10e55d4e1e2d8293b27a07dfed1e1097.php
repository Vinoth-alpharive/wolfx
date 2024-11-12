<?php
$atitle ="commission";
?>

<?php $__env->startSection('title', 'Commission Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Commission Settings</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?php echo e(url('admin/commission')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to Commission</a>
                    <br /><br />
                    <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(session('statuserror')): ?>
                    <div class="alert alert-danger	" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Failure!</strong> <?php echo e(session('statuserror')); ?>

                    </div>
                    <?php endif; ?>
                    <form method="post" action="<?php echo e(url('admin/commissionupdate')); ?>" autocomplete="off">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($commission->id); ?>" name="id">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coin / Token</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="currency" class="form-control" value="<?php echo e($commission->source != NULL ? $commission->source : '0'); ?>" readonly /><i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Withdraw Commission (%)</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="withdraw" class="form-control" step="0.01" min="0" max="10000000" value="<?php echo e($commission->withdraw != NULL ? display_format($commission->withdraw,8) : '0'); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('withdraw')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('withdraw')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Withdraw Commission Type</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="com_type" class="form-control">


                                        <option <?php if ($commission->com_type == "Percentage") echo "selected"; ?> value="Percentage">Percentage</option>
                                        <option <?php if ($commission->com_type == "Fixed") echo "selected"; ?> value="Fixed">Fixed</option>
                                    </select>
                                    <?php if($errors->has('com_type')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('com_type')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Minimum deposit amount</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="min_deposit" step="0.00001" min="0" max="10000000" class="form-control" value="<?php echo e($commission->min_deposit != NULL ? display_format($commission->min_deposit,8) : 0); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('min_deposit')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('min_deposit')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Minimum withdraw amount</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="min_withdraw" step="0.00001" min="0" max="10000000" class="form-control" value="<?php echo e($commission->min_withdraw != NULL ? display_format($commission->min_withdraw,8) : 0); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('min_withdraw')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('min_withdraw')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>withdraw Perday Limit</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="perday_withdraw" step="0.00001" min="0" max="10000000" class="form-control" value="<?php echo e($commission->perday_withdraw != NULL ? display_format($commission->perday_withdraw,8) : 0); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('perday_withdraw')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('perday_withdraw')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Decimal Point</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="decimal_point" class="form-control" value="<?php echo e($commission->decimal_point != NULL ? $commission->decimal_point : ''); ?>" /><i class="form-group__bar"></i>

								</div>
							</div>
						</div> -->



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Net fee</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="netfee" step="0.00001" min="0" max="10000000" class="form-control" value="<?php echo e($commission->netfee != NULL ? display_format($commission->netfee,8) : 0); ?>" /><i class="form-group__bar"></i>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Deposit Status</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="is_deposit" class="form-control">
                                        <option value="1" <?php if($commission->is_deposit === 1): ?> selected <?php endif; ?>>Active</option>
                                        <option value="0" <?php if($commission->is_deposit === 0): ?> selected <?php endif; ?>>Deactive</option>

                                    </select>
                                    <?php if($errors->has('is_deposit')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('is_deposit')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Withdraw Status</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="is_withdraw" class="form-control">
                                        <option value="1" <?php if($commission->is_withdraw === 1): ?> selected <?php endif; ?>>Active</option>
                                        <option value="0" <?php if($commission->is_withdraw === 0): ?> selected <?php endif; ?>>Deactive</option>

                                    </select>
                                    <?php if($errors->has('is_withdraw')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('is_withdraw')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/commission/edit.blade.php ENDPATH**/ ?>