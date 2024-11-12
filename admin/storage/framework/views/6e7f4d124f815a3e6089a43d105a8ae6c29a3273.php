<?php
$atitle ="tradepair";
?>

<?php $__env->startSection('title', 'Tradepair Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Tradepair Settings</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?php echo e(url('admin/tradepairlist')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to Tradepair</a>
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
                    <form method="post" action="<?php echo e(url('admin/pairupdate')); ?>" autocomplete="off">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($pairres->id); ?>" name="id">


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Coinone</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="coinone" class="form-control" value="<?php echo e($pairres->coinone); ?>" readonly>
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

                                    <input type="text" name="cointwo" class="form-control" value="<?php echo e($pairres->cointwo); ?>" readonly>
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
                                    <input type="number" name="min_price" class="form-control" value="<?php echo e($pairres->min_price); ?>"><i class="form-group__bar"></i>
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
                                    <input type="number" name="max_price" class="form-control" value="<?php echo e($pairres->max_price); ?>"><i class="form-group__bar"></i>
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
                                    <input type="number" name="average_price" class="form-control" value="<?php echo e($pairres->average_price); ?>" /><i class="form-group__bar"></i>
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
                                    <input type="text" name="symbol" class="form-control" value="<?php echo e($pairres->symbol); ?>"><i class="form-group__bar"></i>
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
                                        <option value="1" <?php echo e($pairres->active == '1' ? 'selected' : ''); ?>>Active</option>
                                        <option value="0" <?php echo e($pairres->active == '0' ? 'selected' : ''); ?>>Deactive</option>
                
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
                    $('#bot-symbol').show();
                } else {
                    $('#bot-symbol').hide();
                }
            });
        });

    </script>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/tradepair/pairedit.blade.php ENDPATH**/ ?>