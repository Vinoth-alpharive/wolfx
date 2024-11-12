<?php
$atitle = "buyer";
?>


<?php $__env->startSection('title', 'Adding Buyer'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Add buyer</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?php echo e(url('admin/buyer')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to buyer</a>
                    <br /><br />

                    <?php if(session('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>

                    <form method="post" action="<?php echo e(url('admin/doaddBuyer')); ?>" autocomplete="off">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Username</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="username" id="username" class="form-control" value="<?php echo e(old('username')); ?>">
                                    <?php if($errors->has('username')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Password</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="password" class="form-control" value="<?php echo e(old('password')); ?>">
                                    <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="price" class="form-control" value="<?php echo e(old('price')); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('price')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('price')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Role</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    

                                    <!-- Base1 Checkbox -->
                                    <?php $__empty_1 = true; $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
                                    <div class="form-check">
                                        <input type="checkbox" name="role[]" value="<?php echo e($categ->name ?? ''); ?>" class="form-check-input" id="roleBase<?php echo e($categ->id ?? ''); ?>" <?php echo e(is_array(old('role')) && in_array($categ->name, old('role')) ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="roleBase<?php echo e($categ->id ?? ''); ?>"><?php echo e($categ->name ?? ''); ?></label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                    <!-- Base2 Checkbox -->
                                    

                                    <!-- Base3 Checkbox -->
                                    

                                    <!-- Validation error message -->
                                    <?php if($errors->has('role')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('role')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-light"><i class=""></i> Add</button>
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

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/user/addbuyer.blade.php ENDPATH**/ ?>