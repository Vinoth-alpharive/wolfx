<?php
    $atitle = 'coinlist';
?>

<?php $__env->startSection('title', 'Coins Setting'); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Token List Settings</h1>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <a href="<?php echo e(url('/admin/addcoin')); ?>" class="btn btn-info">Add Token</a>
                                <br /><br />
                                <?php if(session('status')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button><strong>Success!</strong>
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Token Symbol</th>
                                            <th>Token Type</th>
                                            <th>Token Name</th>
                                            <th>Withdraw Commssion</th>
                                            <th>Contract Address</th>
                                            <th>Decimal</th>
                                            <th>Visiblity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $limit = 15;
                                            if (isset($_GET['page'])) {
                                                $page = $_GET['page'];
                                                $i = $limit * $page - $limit + 1;
                                            } else {
                                                $i = 1;
                                            }
                                        ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e($commission->source); ?></td>
                                                <td><?php echo e(ucfirst($commission->type)); ?></td>
                                                <td><?php echo e($commission->coinname); ?></td>
                                                <td><?php echo e($commission->withdraw); ?></td>
                                                <td><?php echo e($commission->contractaddress); ?></td>
                                                <td><?php echo e($commission->decimal_value); ?></td>
                                                <td><?php echo e($commission->shown == 1 ? 'Show' : 'Hide'); ?></td>
                                                <td><?php echo e($commission->shown == 1 ? 'Active' : 'Inactive'); ?></td>
                                                <?php if(in_array("write", explode(',',$AdminProfiledetails->coinsetting))): ?>
                                                <td><a href="<?php echo e(url('/admin/coinsettings', Crypt::encrypt($commission->id))); ?>"
                                                        class="btn btn-info">View / Edit</a></td>
                                                <?php endif; ?>
                                                <?php if(in_array("delete", explode(',',$AdminProfiledetails->coinsetting))): ?>
                                                <td><a href="<?php echo e(url('/admin/deletedcoin', Crypt::encrypt($commission->id))); ?>"
                                                        class="btn btn-info">Delete</a></td>
                                                <?php endif; ?>
                                                <?php
                                                    $i++;
                                                ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="7"> <?php echo e('No List Settings'); ?>!</td>
                                            </tr>
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

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/tradepair/commission.blade.php ENDPATH**/ ?>