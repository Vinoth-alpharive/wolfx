<?php
$atitle ="withdraw";
?>

<?php $__env->startSection('title', 'Withdraw History'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1>View <?php echo e($withdraw->coin_name); ?> Withdraw History</h1>
	</header>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="<?php echo e(url('admin/withdraw/'.$withdraw->coin_name)); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to withdraw history</a>
					<br /><br />
					<?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong>
                        </div>
                    <?php endif; ?>
				     <form method="post" id="currency_form" action="<?php echo e(url('admin/update_cryptowithdraw')); ?>" autocomplete="off">
				     <input type="hidden" name="id" value="<?php echo e($withdraw->id); ?>">
						<?php echo e(csrf_field()); ?>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>User Name</label>
								</div>
							</div>

							<input type="hidden" name="currency" value="<?php echo e($withdraw->coin_name); ?>" >


							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="recipient" class="form-control" value="<?php echo e($withdraw->user->first_name.' '.$withdraw->user->last_name); ?>" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Transaction id</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="txid" class="form-control" value="<?php echo e($withdraw->transaction_id); ?>" readonly /><i class="form-group__bar"  /></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Withdraw type</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="txid" class="form-control" value="<?php echo e($withdraw->withdrawtype ? $withdraw->withdrawtype : '-'); ?>" readonly /><i class="form-group__bar"  /></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Sender Address</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="recipient" class="form-control" value="<?php echo e($withdraw->sender); ?>" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
			
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Recipient Address</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="recipient" class="form-control" value="<?php echo e($withdraw->reciever); ?>" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Request Amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="sendamount" class="form-control" value="<?php echo e($withdraw->amount); ?>" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>USD Amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="usdamount" class="form-control" value="<?php echo e($withdraw->usdamount ? $withdraw->usdamount : '-'); ?>" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Admin Fee</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="adminfee" class="form-control" value="<?php echo e(display_format($withdraw->admin_fee,8)); ?>" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Send Amount</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="request_amount" class="form-control" value="<?php echo e(display_format($withdraw->request_amount,8)); ?>" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Remark</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="remark" class="form-control" value="<?php echo e($withdraw->remark ? $withdraw->remark : '-'); ?>" readonly /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Status</label>
								</div>
							</div>
							<?php if($withdraw->status == 0): ?>
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" name="status">
									    <option value="0">Waiting for approval</option>
										<option value="1">Approved</option>
										<option value="2">Rejected</option>
									</select>
								</div>
							</div>
							<?php elseif($withdraw->status == 1): ?>
							<div class="col-md-4">
								<div class="form-group">
										Approved
								</div>
							</div>
							<?php else: ?>
							<div class="col-md-4">
								<div class="form-group">
										Rejected
								</div>
							</div>
							<?php endif; ?>
							<div class="col-md-12">
							<p class="text text-danger">NOTE : Once you update the status as "Approved / Rejected", you can't update status again!</p>
						</div>
						</div>
						<?php if($withdraw->status == 0): ?>
							<div class="form-group">
								<button type="submit" name="edit" id="btn_update" class="btn btn-light"><i class=""></i> Update</button>
							</div>
						<?php endif; ?>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/userwithdraw/cryptowithdraw_edit.blade.php ENDPATH**/ ?>