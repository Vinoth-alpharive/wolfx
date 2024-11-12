<?php
$atitle ="coinlist";
?>

<?php $__env->startSection('title', 'Coins Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Token Edit Page</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?php echo e(url('admin/coinlist')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to Coins list</a>
                    <br /><br />
                    <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <form method="post" action="<?php echo e(url('admin/coinupdate')); ?>" autocomplete="off" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($commission->id); ?>" name="id">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Source</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="symbol" class="form-control" value="<?php echo e($commission->source != NULL ? $commission->source : '0'); ?>"><i class="form-group__bar"></i>
                                    <?php if($errors->has('symbol')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('symbol')); ?></strong>
                                    </span>
                                    <?php endif; ?>
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
                                    <input type="number" name="withdraw" class="form-control" step="0.01" min="0" max="10000000" value="<?php echo e($commission->withdraw != NULL ? $commission->withdraw : '0'); ?>" /><i class="form-group__bar"></i>
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

                        <!-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Wallet Page Redirect URL</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="walletpair" class="form-control" value="<?php echo e($commission->walletpair != NULL ? $commission->walletpair : ''); ?>" required ><i class="form-group__bar"></i>
									<?php if($errors->has('walletpair')): ?>
					                    <span class="help-block">
					                        <strong><?php echo e($errors->first('walletpair')); ?></strong>
					                    </span>
					                <?php endif; ?>
								</div>
							</div>
						</div> -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" <?php echo e($errors->has('type') ? ' has-error' : ''); ?>>

                                    <select name="type" id="coin_type" class="form-control">
                                        <option value="token" <?php echo e($commission->type == 'token' ? 'selected' : ''); ?>>Token</option>
                                        <option value="bsctoken" <?php echo e($commission->type == 'bsctoken' ? 'selected' : ''); ?>>Bep20 Token</option>
                                        <option value="trxtoken" <?php echo e($commission->type == 'trxtoken' ? 'selected' : ''); ?>>TRC20 Token</option>
                                        <option value="erctoken" <?php echo e($commission->type == 'erctoken' ? 'selected' : ''); ?>>ERC20 Token</option>
                                        <option value="polytoken" <?php echo e($commission->type == 'polytoken' ? 'selected' : ''); ?>>POLY20 Token</option>
                                    </select>
                                    <?php if($errors->has('type')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('type')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="contract" style="display: none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Contract Address</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea name="contractaddress" class="form-control" value="" /><?php echo e($commission->contractaddress != NULL ? $commission->contractaddress : ""); ?></textarea><i class="form-group__bar"></i>
                                    <?php if($errors->has('contractaddress')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('contractaddress')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="abi" style="display: none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Abi array</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea name="abiarray" class="form-control" value="" /><?php echo e($commission->abiarray != NULL ? $commission->abiarray : 0); ?></textarea><i class="form-group__bar"></i>
                                    <?php if($errors->has('abiarray')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('abiarray')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coin name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="coinname" class="form-control" value="<?php echo e($commission->coinname != NULL ? $commission->coinname : '-'); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('coinname')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('coinname')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="netfee" class="form-control" value="0" />
                        <!-- <div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Net fee</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="netfee" step="0.00001" min="0" max="10000000" class="form-control" value="<?php echo e($commission->netfee != NULL ? $commission->netfee : '0'); ?>"/><i class="form-group__bar"></i>
									<?php if($errors->has('netfee')): ?>
					                    <span class="help-block">
					                        <strong><?php echo e($errors->first('netfee')); ?></strong>
					                    </span>
				                	<?php endif; ?>
								</div>
							</div>
						</div>
 -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Point digit</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="digit" min="0" max="100" class="form-control" value="<?php echo e($commission->point_value != NULL ? $commission->point_value : '-'); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('digit')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('digit')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Contract Decimal value</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="decimal_value" min="0" max="100" class="form-control" value="<?php echo e($commission->decimal_value != NULL ? $commission->decimal_value : '-'); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('decimal_value')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('decimal_value')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Minimum deposit</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="number" name="min_deposit" class="form-control" value="<?php echo e($commission->min_deposit != NULL ? $commission->min_deposit : '-'); ?>" /><i class="form-group__bar"></i>
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
                    <label>Minimum withdraw</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="number" name="min_withdraw" class="form-control" value="<?php echo e($commission->min_withdraw != NULL ? $commission->min_withdraw : '-'); ?>" /><i class="form-group__bar"></i>
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
                    <label>Deposit Status</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="is_deposit" class="form-control">
                        <option value="1" <?php echo e($commission->is_deposit == '1' ? 'selected' : ''); ?>>Active</option>
                        <option value="0" <?php echo e($commission->is_deposit == '0' ? 'selected' : ''); ?>>Deactive</option>

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
                        <option value="1" <?php echo e($commission->is_withdraw == '1' ? 'selected' : ''); ?>>Active</option>
                        <option value="0" <?php echo e($commission->is_withdraw == '0' ? 'selected' : ''); ?>>Deactive</option>
                    </select>
                    <?php if($errors->has('is_withdraw')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('is_withdraw')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>







        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8">
                <!-- <div class="loding">Loading...</div> -->
                <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?>">
                    <div class="form-group  has-feedback">
                        <div class="col-xs-12 inputGroupContainer"> <img src="<?php echo e(\Config::get('app.siteurl')); ?>/images/color/<?php echo e($commission['image']); ?>" id="doc1" width="36px" height="36px" class="img-responsive kyc_img_cls" />
                            <label for="file-upload1" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Upload Image </label>
                            <input id="file-upload1" class="kycimg2" onchange="ValidateSize(this)" name="image" type="file" style="display:none;">
                            <label id="file-name1"></label>
                            <br />
                            <br />
                            <?php if($errors->has('image')): ?> <span class="help-block"> <strong><?php echo e($errors->first('image')); ?></strong> </span><br /> <?php endif; ?>
                            <p style="color:#ff2626;font-weight:600;font-size: 15px;">Allowed only png image format 35 X 35</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Active Status</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="1" <?php echo e($commission->shown == '1' ? 'selected' : ''); ?>>Active</option>
                        <option value="0" <?php echo e($commission->shown == '0' ? 'selected' : ''); ?>>Deactive</option>

                    </select>
                    <?php if($errors->has('status')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('status')); ?></strong>
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

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/tradepair/edit.blade.php ENDPATH**/ ?>