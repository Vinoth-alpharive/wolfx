<?php
$atitle ="pendingpurchase";
?>

<?php $__env->startSection('title', ' Pending Purchase'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Cancelled purchase History</h1>
    </header>
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div id="buyo" class="tab-pane fade in active show">
                    <div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
                        <?php if(session('success')): ?>
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong><?php echo e(session('success')); ?></strong>
                        </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                        <div class="alert alert-warning alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong><?php echo e(session('error')); ?></strong>
                        </div>
                        <?php endif; ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>Value</th>
                                    <th>Quantity</th>
                                    <th>Remark</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    
                                    <th>View</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i =1;
                                $limit=30;
                                if(isset($_GET['page'])){
                                $page = $_GET['page'];
                                $i = (($limit * $page) - $limit)+1;
                                }else{
                                $i =1;
                                }
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($trade->buyername); ?></td>
                                    <td><?php echo e($trade->sellername); ?></td>
                                    <td><?php echo e($trade->value); ?></td>
                                    <td><?php echo e($trade->qty); ?></td>
                                    <td><?php echo e($trade->remark); ?></td>
                                    <td><?php echo e($trade->account_name); ?></td>
                                    <td><?php echo e($trade->account_number); ?></td>
                                    <td><a href="<?php echo e(url('admin/viewPendingpurchase',Crypt::encrypt($trade->id))); ?>"><button type="button" class="btn btn-success user_date"><i class="zmdi zmdi-edit"></i>&nbsp View</button></a></td>
                                    

                                </tr>
                                <?php
                                $i++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="12">
                                        <div class="alert alert-info">Yet no record available</div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="pagination-tt clearfix">
                            <?php if($purchase->count()): ?>
                            <?php echo e($purchase->links()); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>
    <script>
        function pageredirect(self) {
            window.location.href = self.value;
        }

    </script>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/purchase/pendingPurchase.blade.php ENDPATH**/ ?>