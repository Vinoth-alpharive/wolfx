<?php
$atitle ="commission";
?>

<?php $__env->startSection('title', 'Commission Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Commission Settings</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Currency</th>
                    <th>Name</th>
                    <th>Withdraw</th>
                    <th>Commission Type</th>
                    <th>Net Fee</th>
                    <th>Deposit Status</th>
                    <th>Withdraw Status</th>
                     <th>Swap Status</th>
                     <?php if(in_array("write", explode(',',$AdminProfiledetails->commissionsetting))): ?> 
                    <th>Status</th>
                    <?php endif; ?>
                      
                  </tr>
                </thead>
                <tbody> 
                <?php $__empty_1 = true; $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e($commission->source); ?></td>
                    <td><?php echo e($commission->coinname); ?></td>
                    <td><?php echo e($commission->withdraw); ?></td>
                    <td><?php echo e($commission->com_type); ?></td>
                    <td><?php echo e(number_format($commission->netfee, 8)); ?></td>
                    <td><?php echo e($commission->is_deposit == 1 ? 'Active' : 'Deactive'); ?></td>
                    <td><?php echo e($commission->is_withdraw == 1 ? 'Active' : 'Deactive'); ?></td>
                     <td><?php echo e($commission->is_swap == 1 ? 'Active' : 'Deactive'); ?></td>
                     <?php if(in_array("write", explode(',',$AdminProfiledetails->commissionsetting))): ?> 
                    <td><a href="<?php echo e(url('/admin/commissionsettings', Crypt::encrypt($commission->id))); ?>" class="btn btn-success"> <i class="zmdi zmdi-edit"></i> View / Edit</a></td>
                    <?php endif; ?>
                    
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                   <tr><td colspan="7"> <?php echo e('No Commissions Settings'); ?>!</td></tr>
                <?php endif; ?>
                </tbody>
              </table>
              <?php echo e($commissions->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/commission/commission.blade.php ENDPATH**/ ?>