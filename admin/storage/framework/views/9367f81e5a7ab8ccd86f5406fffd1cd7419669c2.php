<?php
$atitle ="coinlist";
?>

<?php $__env->startSection('title', 'Add Coin Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1>Add 20 Token</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="<?php echo e(url('admin/coinlist')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to Coin</a>
					<br /><br />
					<?php if(session('status')): ?>
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

					</div>
					<?php endif; ?>
					<form method="post" action="<?php echo e(url('admin/addcoininsert')); ?>" autocomplete="off" enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Source</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="symbol" class="form-control" value="<?php echo e(old('symbol')); ?>"><i class="form-group__bar"></i>
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
									<input type="number" name="withdraw" class="form-control" step="0.01" min="0" max="10000000" value="<?php echo e(old('withdraw')); ?>" /><i class="form-group__bar"></i>
									<?php if($errors->has('withdraw')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('withdraw')); ?></strong>
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
									<input type="text" name="walletpair" placeholder="add with _(eg: BTC_USDT)"class="form-control" value="<?php echo e(old('walletpair')); ?>"  required><i class="form-group__bar"></i>
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
									<label>Withdraw Commission Type</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select name="com_type" class="form-control">
										<option <?php if (old('com_type') == "Percentage") echo "selected"; ?> value="Percentage">Percentage</option>
										<option <?php if (old('com_type') == "Fixed") echo "selected"; ?> value="Fixed">Fixed</option>
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
									<label>Type</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group" <?php echo e($errors->has('type') ? ' has-error' : ''); ?>>

									<select name="type" id="coin_type" class="form-control">
										<option value="">Select type</option>
										<option value="bsctoken" <?php echo e(old('type') == 'bsctoken' ? 'selected' : ''); ?>>Bep20 Token</option>
										<option value="trxtoken" <?php echo e(old('type') == 'trxtoken' ? 'selected' : ''); ?>>TRC20 Token</option>
										<option value="erctoken" <?php echo e(old('type') == 'erctoken' ? 'selected' : ''); ?>>ERC20 Token</option>
										<option value="polytoken" <?php echo e(old('type') == 'polytoken' ? 'selected' : ''); ?>>POLY20 Token</option>
										<option value="token" <?php echo e(old('type') == 'token' ? 'selected' : ''); ?>>ERC 20 Token</option>
									</select>
									<?php if($errors->has('type')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('type')); ?></strong>
									</span>
									<?php endif; ?>
								</div>
							</div>
						</div>

						<div class="row" id="">
							<div class="col-md-3">
								<div class="form-group">
									<label>Contract Address</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" name="contractaddress" class="form-control" value="<?php echo e(old('contractaddress')); ?>" /><i class="form-group__bar"></i>
									<?php if($errors->has('contractaddress')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('contractaddress')); ?></strong>
									</span>
									<?php endif; ?>
								</div>
							</div>
						</div>

						<div class="row" id="">
							<div class="col-md-3">
								<div class="form-group">
									<label>Abi Array</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<textarea name="abiarray" class="form-control" value="" /><?php echo e(old('abiarray')); ?></textarea><i class="form-group__bar"></i>
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
									<label>Coinname</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="coinname" class="form-control" value="<?php echo e(old('coinname')); ?>" /><i class="form-group__bar"></i>
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
									<label>Netfee</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="netfee" step="0.00001" min="0" max="10000000" class="form-control" value="<?php echo e(old('netfee')); ?>"/><i class="form-group__bar"></i>
									<?php if($errors->has('netfee')): ?>
					                    <span class="help-block">
					                        <strong><?php echo e($errors->first('netfee')); ?></strong>
					                    </span>
				                	<?php endif; ?>
								</div>
							</div>
						</div> -->


						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Point digit</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="digit" min="0" max="10" class="form-control" value="<?php echo e(old('digit')); ?>" /><i class="form-group__bar"></i>
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
									<label>Contract Decimal Value</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="number" name="decimal_value" min="0" max="100" class="form-control" value="<?php echo e(old('decimal_value')); ?>" /><i class="form-group__bar"></i>
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
					<input type="number" name="min_deposit" class="form-control" value="<?php echo e(old('min_deposit')); ?>" /><i class="form-group__bar"></i>
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
					<input type="number" name="min_withdraw" class="form-control" value="<?php echo e(old('min_withdraw')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('min_withdraw')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('min_withdraw')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div>

<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Ranking</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="ranking" class="form-control" value="<?php echo e(old('ranking')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('ranking')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('ranking')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->


		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Market Cap</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="market_cap" class="form-control" value="<?php echo e(old('market_cap')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('market_cap')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('market_cap')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->

		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Fully Diluted Market Cap</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="diluted_market_cap" class="form-control" value="<?php echo e(old('diluted_market_cap')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('diluted_market_cap')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('diluted_market_cap')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->


		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Market Dominance</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="market_dominance" class="form-control" value="<?php echo e(old('market_dominance')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('market_dominance')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('market_dominance')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->


		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Circulation Supply</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="circulation_supply" class="form-control" value="<?php echo e(old('circulation_supply')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('circulation_supply')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('circulation_supply')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->


		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Maximum Supply</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="maximum_supply" class="form-control" value="<?php echo e(old('maximum_supply')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('maximum_supply')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('maximum_supply')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->



		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Issue Date</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="date" name="issue_date" class="form-control" value="<?php echo e(old('issue_date')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('issue_date')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('issue_date')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->



		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Issue Price</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="issue_price" class="form-control" value="<?php echo e(old('issue_price')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('issue_price')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('issue_price')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->


		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> All time High</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="all_time_high" class="form-control" value="<?php echo e(old('all_time_high')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('all_time_high')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('all_time_high')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->


		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> All time Low</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="all_time_low" class="form-control" value="<?php echo e(old('all_time_low')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('all_time_low')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('all_time_low')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->


		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Official Website</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="official_website" class="form-control" value="" /><i class="form-group__bar"></i>
					<?php if($errors->has('official_website')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('official_website')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->



		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> White Paper</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="white_paper" class="form-control" value="" /><i class="form-group__bar"></i>
					<?php if($errors->has('white_paper')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('white_paper')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->


		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Block Explorer</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="block_explorer" class="form-control" value="" /><i class="form-group__bar"></i>
					<?php if($errors->has('block_explorer')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('block_explorer')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->




		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Introduction</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="introduction" class="form-control" value="<?php echo e(old('introduction')); ?>" /><i class="form-group__bar"></i>
					<?php if($errors->has('introduction')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('introduction')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->

		<!-- <div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label> Trade Link</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" name="trade_link" class="form-control" value="<?php echo e(old('trade_link')); ?>" placeholder="Eg: BTC_USDT" required/><i class="form-group__bar"></i>
					<?php if($errors->has('trade_link')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('trade_link')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
			</div>
		</div> -->
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Deposit Status</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<select name="is_deposit" class="form-control">
						<option value="1">Active</option>
						<option value="0">Deactive</option>

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
						<option value="1">Active</option>
						<option value="0">Deactive</option>

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
						<div class="col-xs-12 inputGroupContainer"> <img id="doc1" width="128px" height="128px" class="img-responsive kyc_img_cls" />
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
						<option value="1">Active</option>
						<option value="0">Deactive</option>

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
		<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Add Now</button>
	</div>
	</form>
	</div>
	</div>
	</div>
	</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/tradepair/add.blade.php ENDPATH**/ ?>