<?php
$atitle ="category";
?>

<?php $__env->startSection('title', 'Category - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Category</h1>
        <?php if(in_array("write",explode(',',$AdminProfiledetails->category))): ?>
        <a class="btn btn-success btn-xs" href="<?php echo e(url ('/admin/addcategory')); ?>"> Add</a>
        <?php endif; ?>
        <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
    </header>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive search_result">
                <table class="table" id="dows">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <?php if(in_array("edit", explode(',',$AdminProfiledetails->category))): ?>
                            <th colspan="1">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i =1;
                        $limit=5;
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        $i = (($limit * $page) - $limit)+1;
                        }else{
                        $i =1;
                        }
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($cat->name); ?></td>
                            <td><?php echo e($cat->type); ?></td>
                            <td><?php echo e($cat->price); ?></td>
                            <?php if(in_array("write", explode(',',$AdminProfiledetails->category))): ?>
                            <td><a class="btn btn-danger btn-xs" href="<?php echo e(url ('/admin/editcategory/'.encrypt($cat->id))); ?>"> Edit </a> </td>
                            <?php endif; ?>
                        </tr>
                        <?php
                        $i++;
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7"> No record found!</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                    <div class="pagination-tt clearfix">
                        <?php if($data->count()): ?>
                        <?php echo e($data->links()); ?>

                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/category/category.blade.php ENDPATH**/ ?>