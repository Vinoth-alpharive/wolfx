<?php
$atitle ="p2ptrade";
?>

<?php $__env->startSection('title', 'P2p Raise dis - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content purcase-full">
    <div class="content__inner">
        <header class="content__title">
            <h1></h1>
        </header>
        <a href="<?php echo e(url('admin/purchasehistory')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back</a>

        <div class="card">
            <div class="card-body">
                <?php if($message = Session::get('success')): ?>
                <div class="alert alert-info"><?php echo e($message); ?> </div><br />
                <?php endif; ?>
                
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="<?php echo e($trades->id); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Buyer Info:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name : </td>
                                    <td><?php echo e($trades->buyername); ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Order details:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity : </td>
                                    <?php if($trades->buyerid != ""): ?>
                                    <td><?php echo e($trades->qty); ?></td>
                                    <?php endif; ?>
                                </tr>

                                <tr>
                                    <td>Value : </td>
                                    <?php if($trades->buyerid != ""): ?>
                                    <td><?php echo e($trades->value); ?></td>
                                    <?php endif; ?>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Remarks:-</h3>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Buyer Remark : </td>
                                    <?php if($trades->buyerid != ""): ?>
                                    <td><?php echo e($trades->buyer_remark); ?></td>
                                    <?php endif; ?>
                                </tr>

                                </tbody>
                            </table>

                            <div class="form-group">
                                <label>Uploaded Proof</label>
                                <?php if($trades->buyerid != ""): ?>
                                <?php if(count($photoSlips) > 0): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $photoSlips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="input-group row">
                                    <div class="input-group col">
                                    <img src="<?php echo e(' https://vipchengdui.com/buyerimg/'.$photos->slip_name ?? ''); ?>" style="width: 200px;">
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Seller Info:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name : </td>
                                    <td><?php echo e($trades->sellername); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Order details:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity : </td>
                                    <?php if($trades->sellerid != ""): ?>
                                    <td><?php echo e($trades->qty); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <td>Value : </td>
                                    <?php if($trades->sellerid != ""): ?>
                                    <td><?php echo e($trades->value); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h3 class="title-header white">Remarks:-</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Seller Remark : </td>
                                    <?php if($trades->sellerid != ""): ?>
                                    <td><?php echo e($trades->seller_remark); ?></td>
                                    <?php endif; ?>
                                </tr>
                                </tbody>
                            </table>

                            
                        </div>
                        
                    </div>
            </div>
            
        </div>
    </div>
    </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/purchase/viewcompletedpurchase.blade.php ENDPATH**/ ?>