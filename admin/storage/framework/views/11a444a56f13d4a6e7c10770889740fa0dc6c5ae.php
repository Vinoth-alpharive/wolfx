<?php
$atitle ="seller";
?>

<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>Seller</h1>
    </header>
    <div class="card">
        <div class="card-body">

            <?php if($message = Session::get('updated_status')): ?>
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo e($message); ?></strong>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(url('/admin/users/search')); ?>" method="get" autocomplete="off">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-3">
                        <input type="hidden" name="type" value="Seller" />
                        <input type="text" name="searchitem" class="form-control" placeholder="Search for User Name or Email" value="" required="" />
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-success user_date" value="Search" />
                        <a class="btn btn-warning btn-xs" href="<?php echo e(url('admin/seller')); ?>"> Reset </a>
                    </div>
            </form>
            <div class="col-md-3">
                <a class="btn btn-warning" href="<?php echo e(route('userexport')); ?>">Export To Excel</a>
            </div>
        </div>

        <br />

        <div class="table-responsive search_result">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.NO </th>
                        <th>Date and Time</th>
                        <th>Username</th>
                        <th>Email ID</th>
                        <th>Email Verify</th>
                        <?php if(in_array("write", explode(',',$AdminProfiledetails->userlist))): ?>
                        <th colspan="1">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i =1;

                    $limit=15;

                    if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    $i = (($limit * $page) - $limit)+1;
                    }else{
                    $i =1;
                    }
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i); ?></td>
                        <td><?php echo e(date('Y/m/d h:i:s', strtotime($user->created_at ?? ''))); ?></td>
                        <td><?php echo e($user->username ?? ''); ?></td>
                        <td><?php echo e($user->email ?? ''); ?></td>
                        <td><?php if($user->email_verify == 1): ?> Yes <?php elseif($user->email_verify == 2): ?> Waiting <?php else: ?> No <?php endif; ?></td>
                        <?php if(in_array("write", explode(',',$AdminProfiledetails->userlist ?? ''))): ?>
                        <td><a class="btn btn-success btn-xs" href="<?php echo e(url('/admin/users_edit/'.Crypt::encrypt($user->id ?? ''))); ?>"><i class="zmdi zmdi-edit"></i> View </a></td>
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


                    <?php if(count($users) > 0): ?>
                    <?php echo $users->appends(Request::only(['searchitem'=>'searchitem']))->render(); ?>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/user/seller.blade.php ENDPATH**/ ?>