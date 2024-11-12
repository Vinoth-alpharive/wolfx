<?php $__env->startSection('title', 'Security Settings - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
<div class="content__inner">
  <header class="content__title">
    <h1>ADMINS LIST</h1>
  </header>
   
  <?php if(Session::has('success')): ?>
   <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
  <?php elseif(Session::has('error')): ?>
   <div class="alert alert-danger"><?php echo e(Session::get('error')); ?></div> 
  <?php endif; ?>

  <?php if($message = Session::get('searcherror')): ?>
  <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><?php echo e($message); ?></strong> </div>
    <?php endif; ?>

  <div class="card">
    <div class="card-body">

        <div class="row">
        <div class="col-md-9">
        <form class="search_change" action="<?php echo e(url('admin/subadminsearch')); ?>" method="get">
        <?php echo e(csrf_field()); ?>

        <div class="row">
        <div class="col-md-3">
        <input type="text" name="fromdate" class="form-control date-picker" id="datepicker" value="" placeholder="Start Date" />
        </div>
        <div class="col-md-3">
        <input type="text" name="todate" class="form-control date-picker" id="datepicker2" value="" placeholder="End Date" />
        </div>
        <div class="col-md-3">
        <input type="submit" class="btn btn-light" value="Search" />
         <a class="btn btn-success btn-xs" href="<?php echo e(url('admin/subadminlist')); ?>"> Reset </a>
        </div>

        </div>
        </form>
        </div>
        <!-- 
        <div class="col-md-2">
        <a class="btn btn-info export" href="#" onclick="exportTableToCSV('subadmin.csv')" ><i class="fa fa-download"></i>&nbsp;Download Excel </a>
        </div> -->
        </div>
        <br/>

      <div class="col-md-12 col-sm-12 col-xs-12 pl-0">
        <div id="sendResult"></div>
       
        <?php if(in_array("write", explode(',',$subadmin->addadmin))): ?>
        <a href="<?php echo e(url('admin/subadminform')); ?>"  class="btn btn-light"><i class="fa fa-user-plus zmdi-hc-fw"></i> Add Sub Admin </a> </div>
        <?php endif; ?>
      <div class="table-responsive search_result">
        <table class="table downloaddatas" > 
          <!-- //id="allusers-table"  -->
          <thead>
            <tr>
              <th>S.No </th>
              <th>Username </th>
              <th>Email </th>
              <th>Date & Time</th>
               <!-- <th>logintime</th>
                <th>loginout</th> -->
               <?php if(in_array("write", explode(',',$subadmin->addadmin)) || in_array("write", explode(',',$subadmin->addadmin))): ?>  
               <th>Action</th>
                <?php endif; ?>
            </tr>
          </thead>
          <tbody>

          <?php
          $i = 1;
          ?>
          <?php if(count($admins) > 0): ?>
          
          <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($i); ?></td>
            <td><?php echo e($user->name); ?></td>
            <td><?php echo $user->email!= "" ?mb_strimwidth($user->email, 0, 100, "...") : ''; ?></td>
            <td><?php echo e(date('d-m-Y H:i:s',strtotime($user->created_at))); ?></td>
            <!-- <td><?php echo e($user->login_time  != ""? $user->login_time  :'-'); ?></td>
            <td><?php echo e($user->logout_time != "" ? $user->logout_time : '-'); ?></td> -->
            <td class="td-btns">
               
                <?php if(in_array("write", explode(',',$subadmin->addadmin))): ?>  
                <a class="btn btn-success btn-xs" href="<?php echo e(url('admin/subadminedit/'.\Crypt::encrypt($user->id))); ?>"><i class="zmdi zmdi-edit"></i> Edit </a> &nbsp;  
                <?php endif; ?>
                
                <?php if(in_array("delete", explode(',',$subadmin->addadmin))): ?>  
                <a style="color: #000" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-default2_<?php echo e($user->id); ?>"><i class="zmdi zmdi-delete"></i> Remove  </a>

                    <div class="modal fade" id="modal-default2_<?php echo e($user->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title pull-left">Remove user</h5>
                    </div>
                    <div class="modal-body">Are you want to remove <?php echo e($user->name); ?></div>
                    <div class="modal-footer"> <a href="<?php echo e(url('admin/subadminremove/'. \Crypt::encrypt($user->id))); ?>" class="btn btn-success btn-xs">Delete </a>
                    <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal">Close </button>
                    </div>
                    </div>
                    </div>
                    </div>

            
                <?php endif; ?>
                 
            </td>
          </tr>
          <?php
          $i++;
          ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
          <?php else: ?>
          <tr>
            <td colspan="5">No records Found</td>
          </tr>
          <?php endif; ?>
            </tbody>
          
        </table>
       <?php if($admins->count()): ?>
            <?php echo e($admins->links()); ?>

        <?php endif; ?>
        
        </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/adminaccount/subadminlist.blade.php ENDPATH**/ ?>