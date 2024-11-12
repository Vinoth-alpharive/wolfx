<?php
$atitle ="category";
?>

<?php $__env->startSection('title', 'Add category'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Add category</h1>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="<?php echo e(url('admin/category')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back</a>
                    <br /><br />
                    <?php if(session('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Failed!</strong> <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>
                    <form method="post" action="<?php echo e(url('admin/addCategory')); ?>" autocomplete="off">
                        <?php echo e(csrf_field()); ?>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="type" value="<?php echo e(old('type')); ?>" class="form-control" value="" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('type')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('type')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
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
                                    <input type="number" name="price" class="form-control" value="<?php echo e(old('price')); ?>" /><i class="form-group__bar"></i>
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
                                    <label>Info</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea rows="4" cols="50" name="info" class="form-control ckeditor"><?php echo e(old('info')); ?></textarea>

                                    <?php if($errors->has('info')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('info')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="add" class="btn btn-light"><i class=""></i> Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/category/addcategory.blade.php ENDPATH**/ ?>