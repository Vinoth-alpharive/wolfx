<?php
    $atitle = 'referalcommission';
?>

<?php $__env->startSection('title', 'Coins Setting'); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="content__inner">
            <header class="content__title">
                <h1>Referal Commission</h1>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                
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
                                            <th>Coin</th>
                                            <th>Amount</th>
                                            
                                            
                                            
                                            
                                            
                                            
                                            <th>Type</th>
                                            <th>Reward Type</th>
                                            
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
                                        <?php $__empty_1 = true; $__currentLoopData = $commissionReferal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e(strtoupper($commission->coin)); ?></td>
                                                <td><?php echo e($commission->amount); ?></td>
                                                
                                                
                                                
                                                
                                                
                                                
                                                <td><?php echo e(Ucwords($commission->type)); ?></td>
                                                <td><?php echo e(Ucwords($commission->reward_type)); ?></td>
                                                
                                                <td><a href="<?php echo e(url('/admin/referalcommissionedit', Crypt::encrypt($commission->id))); ?>"
                                                        class="btn btn-info">View / Edit</a></td>
                                               
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
                                <?php echo e($commissionReferal->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/commission/referealcommission.blade.php ENDPATH**/ ?>