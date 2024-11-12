<?php
$atitle ="withdraw";
?>

<?php $__env->startSection('title', 'Withdraw History'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1><?php echo e($currency); ?> Withdraw History</h1>
	</header>
	<?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong>
        </div>
    <?php endif; ?>
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
			  <?php if($message = Session::get('updated_status')): ?>
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong><?php echo e($message); ?></strong>
            </div>
            <?php endif; ?>            
		    <form action="<?php echo e(url('/admin/withdrawal/search')); ?>" method="get" autocomplete="off">
				<?php echo e(csrf_field()); ?>

				<div class="row">
					<div class="col-md-4">                
						<input type="text" name="searchitem" class="form-control" placeholder="Search for User Name or Email" value= "<?php echo e($q ? $q : ''); ?>" required=""/>
						<input type="hidden" name="coin" class="form-control"  value= "<?php echo e($currency); ?>" />
					</div>
					<div class="col-md-3">
						<input type="submit" class="btn btn-success user_date" value="Search" />
						<a class="btn btn-warning btn-xs" href="<?php echo e(url('admin/withdraw/'.$currency)); ?>"> Reset </a> 
					</div>
					</form>
					
				</div>
			
			<br/>
			<div class="card-body">
		   <div class="table-responsive search_result">
				<table class="table" id="dows">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Date & Time</th>
							<th>Username</th>
							<th>Email</th>
							<th>Txn ID</th>
							<!-- <th>Withdraw type</th> --> 
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
							<td><?php echo e(date('Y/m/d h:i:s', strtotime($transactions->created_at ?? ''))); ?></td>
							<td><a href="<?php echo e(url('admin/users_edit/'.Crypt::encrypt($transactions->uid ?? ''))); ?> "><?php echo e($transactions->user['username'] ?? ''); ?></a></td>
							<td><a href="<?php echo e(url('admin/users_edit/'.Crypt::encrypt($transactions->uid)) ?? ''); ?> "><?php echo e($transactions->user['email'] ?? ''); ?></a></td>
							<td><?php echo e($transactions->transaction_id ?? ''); ?></td>
							<!-- <td><?php echo e($transactions->withdrawtype ? $transactions->withdrawtype : '-'); ?></td> -->
							<td><?php echo e($transactions->sender ?? ''); ?></td>
							<td><?php echo e($transactions->reciever ?? ''); ?></td>
							<td><?php echo e(number_format($transactions->amount ?? '', 8, '.', '')); ?></td>
							<td><?php echo e(number_format($transactions->admin_fee ?? '', 8, '.', '')); ?></td>
							<td> 
							     <a class="btn btn-success btn-xs" href="<?php echo e(url('/admin/crypto_withdraw_edit/'.\Crypt::encrypt($transactions->id ?? ''))); ?>"><i class="zmdi zmdi-edit"></i> View </a> 
							</td> 
						</tr>
						<?php
						    $i++;
						?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
					    <tr><td colspan="10"> No record found!</td></tr>
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
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/userwithdraw/crypto_withdraw.blade.php ENDPATH**/ ?>