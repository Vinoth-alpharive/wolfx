<?php
$atitle ="deposit";
?>

<?php $__env->startSection('title', '<?php echo e($coin); ?> List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1><?php echo e($coin); ?> Deposit History</h1>
	</header>
	<div class="card">
		<div class="card-body">


			  <?php if($message = Session::get('updated_status')): ?>
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong><?php echo e($message); ?></strong>
            </div>
            <?php endif; ?>

            
		    <form action="<?php echo e(url('/admin/deposit/search')); ?>" method="get" autocomplete="off">
				<?php echo e(csrf_field()); ?>

				<div class="row">
					<div class="col-md-7 d-flex">                
						<input type="text" name="searchitem" class="form-control" placeholder="Search for User Name or Email" value= "<?php echo e($q ? $q : ''); ?>" />
						<input type="hidden" name="coin" class="form-control"  value= "<?php echo e($coin); ?>" />
						<input  type="date" name="start_date"  class="form-control"  />
						<input type="date" name="end_date"  class="form-control" />
					</div>
					<div class="col-md-3">
						<input type="submit" class="btn btn-success user_date" value="Search" />
						<a class="btn btn-warning btn-xs" href="<?php echo e(url('admin/deposits/'.$coin)); ?>"> Reset </a> 
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
							<th>Asset</th>
							<th>TXN ID</th>
							<th>Recipient</th>
							<th>Amount</th>
							 <?php if(in_array("write", explode(',',$AdminProfiledetails->deposithistory))): ?> 
							<th colspan="2">Action</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>					
					<?php if($depositList->count()): ?>
					<?php 
			            $i =1;

			            $limit=20;

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
							<td><?php echo e(date('d-m-Y H:i:s', strtotime($histroy->created_at ?? ''))); ?></td>
							<td><a href="<?php echo e(url('admin/users_edit/'.Crypt::encrypt($histroy->uid ?? ''))); ?> "><?php echo e($histroy->user['username'] ?? ''); ?></a></td>
							<td><a href="<?php echo e(url('admin/users_edit/'.Crypt::encrypt($histroy->uid)) ?? ''); ?> "><?php echo e($histroy->user['email'] ?? ''); ?></a></td>
							<td><?php echo e($histroy->currency ?? ''); ?></td>
							<td><?php echo e($histroy->txid ?? ''); ?></td>
							<td><?php echo e($histroy->to_addr ?? ''); ?></td>
							<td><?php echo e(display_format($histroy->amount ?? '',8)); ?></td>
							<?php if(in_array("write", explode(',',$AdminProfiledetails->deposithistory ?? ''))): ?> 
							<td>
							<?php if($histroy->status==0): ?>
							<a class="btn btn-success btn-xs" href="<?php echo e(url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a>
							<?php elseif($histroy->status==2): ?>
								<a class="btn btn-success btn-xs" href="<?php echo e(url('admin/cryptodeposit/'.Crypt::encrypt($histroy->id))); ?>"><i class="zmdi zmdi-edit"></i> View </a>
							<?php elseif($histroy->status==3): ?>
								Cancelled
								<?php else: ?>
								-
							<?php endif; ?> 
							</td>
							<?php endif; ?>
						</tr> 
						<?php
						    $i++;
						?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?> 
					<td colspan="15">	<?php echo e('No record found! '); ?></td>
				<?php endif; ?>
					</tbody>
				</table>
				
				<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="pagination-tt clearfix">
                    <?php if($depositList->count()): ?>
				    <?php echo e($depositList->links()); ?>

				<?php endif; ?>
                </div>
              </div>
				
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/userdeposit/crypto_deposit.blade.php ENDPATH**/ ?>