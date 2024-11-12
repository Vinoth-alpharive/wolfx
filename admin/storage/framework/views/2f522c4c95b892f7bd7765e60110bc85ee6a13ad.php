<?php
$atitle ="tradepair";
?>

<?php $__env->startSection('title', 'Add Coin pair Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Add Coin pair Settings</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?php echo e(url('admin/tradepairlist')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to Coinpair</a>
                    <br /><br />
                    <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>


                    <?php if(session('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>


                    <form method="post" action="<?php echo e(url('admin/addpairinsert')); ?>" autocomplete="off">
                        <?php echo e(csrf_field()); ?>




                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coinone</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="coinone" id="coinone" class="form-control" value="<?php echo e(old('coinone')); ?>">
                                    <?php if($errors->has('coinone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('coinone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cointwo</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="cointwo" class="form-control" value="<?php echo e(old('cointwo')); ?>">
                                    <?php if($errors->has('cointwo')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('cointwo')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Minimum Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="min_price" class="form-control" value="<?php echo e(old('min_price')); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('min_price')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('min_price')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Maximum Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="max_price" class="form-control" value="<?php echo e(old('max_price')); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('max_price')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('max_price')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Average Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="average_price" class="form-control" value="<?php echo e(old('average_price')); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('average_price')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('average_price')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="symbolsec">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Symbol</label>
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
                                    <label>Status</label>
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
                            <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
    <script src="<?php echo e(url('public/js/jquery.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#is_bot').on('change', function() {
                var value = $(this).val();

                if (value == 1) {
                    $('#symbolsec').show();
                } else {
                    $('#symbolsec').hide();
                }
            });
        });

    </script>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/tradepair/addpair.blade.php ENDPATH**/ ?>