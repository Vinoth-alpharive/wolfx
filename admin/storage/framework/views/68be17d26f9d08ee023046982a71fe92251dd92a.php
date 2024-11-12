<?php
$atitle ="tradepair";
?>

<?php $__env->startSection('title', 'Tradepair Setting'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="content__inner">
        <header class="content__title">
            <h1>Tradepair Settings</h1>
        </header>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">

                        <a href="<?php echo e(url('/admin/addpair')); ?>" class="btn btn-info">Add Trade Pair</a>
                        <div class="table-responsive">


                            <form action="<?php echo e(url('/admin/trade/search')); ?>" method="get" autocomplete="off">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="searchitem" class="form-control" placeholder="Search for symbol" value="" required="" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" class="btn btn-success user_date" value="Search" />
                                        <a class="btn btn-warning btn-xs" href="<?php echo e(url('admin/tradepairlist')); ?>"> Reset </a>
                                    </div>
                            </form>
                            <div class="col-md-3">
                                <a class="btn btn-warning" href="<?php echo e(route('userexport')); ?>">Export To Excel</a>
                            </div>
                        </div>

                        <br />


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Coinone</th>
                                    <th>Cointwo</th>
                                    <th>symbol</th>
                                    <th>Buy Commission</th>
                                    <th>Sell Commission</th>
                                    <th>Status</th>
                                    <?php if(in_array("write", explode(',',$AdminProfiledetails->tradepair))): ?>
                                    <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i =1;
                                $limit=10;
                                if(isset($_GET['page'])){
                                $page = $_GET['page'];
                                $i = (($limit * $page) - $limit)+1;
                                }else{
                                $i =1;
                                }
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $tradepair; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($value->coinone); ?></td>
                                    <td><?php echo e($value->cointwo); ?></td>
                                    <td><?php echo e($value->symbol); ?></td>
                                    <td><?php echo e($value->buy_trade); ?></td>
                                    <td><?php echo e($value->sell_trade); ?></td>
                                    
                                    <td><?php echo e($value->active == 1 ? 'Active' : 'Deactive'); ?></td>
                                    <?php if(in_array("write", explode(',',$AdminProfiledetails->tradepair))): ?>
                                    <td><a href="<?php echo e(url('/admin/pairedit', Crypt::encrypt($value->id))); ?>" class="btn btn-info">View / Edit</a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(url('/admin/pairdelete', Crypt::encrypt($value->id))); ?>" class="btn btn-info">Delete</a></td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7"> <?php echo e('No List Settings'); ?>!</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php echo e($tradepair->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/tradepair/tradepair.blade.php ENDPATH**/ ?>