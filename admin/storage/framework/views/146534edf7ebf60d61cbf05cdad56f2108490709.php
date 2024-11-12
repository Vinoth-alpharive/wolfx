<?php
$atitle ="cms";
?>

<?php $__env->startSection('title', 'Update Features'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <header class="content__title">
    <h1>Update Features</h1>
  </header>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
        <!--  <a href="<?php echo e(url('admin/cmscontentedit/security')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back </a> -->
            <br /><br />
          <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('statuserror')): ?>
                        <div class="alert alert-danger  " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('statuserror')); ?>

                        </div>
                    <?php endif; ?>
  
          <form method="post" action="<?php echo e(url('admin/featureupdate')); ?>" autocomplete="off" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" value="<?php echo e($Data->key); ?>" name="key">
            <input type="hidden" value="<?php echo e(Crypt::encrypt($Data->id)); ?>" name="featureid">

            
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label> Title </label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="title" class="form-control" value="<?php echo e($Data->title != NULL ? $Data->title : ' - '); ?>" /><i class="form-group__bar"></i>
                  <?php if($errors->has('title')): ?>
                  <span class="help-block">
                  <strong><?php echo e($errors->first('title')); ?></strong>
                  </span>
                  <?php endif; ?>
                 
                </div>
              </div>
            </div>
            <input type="hidden" name="descid" value="<?php echo e($Data->id); ?>">
            <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Upload Image</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="file" name="image"/>
                  </div>
                  <div class="form-group">
                    <img src="<?php echo e(url('public/images/contentimage')); ?>/<?php echo e($Data['image']); ?>"  width="36px" height="36px" class="img-responsive kyc_img_cls" />
                  </div>
                  
                </div>
              </div>


             <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label> Description </label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <textarea rows="4" cols="50" name="description" class="form-control ckeditor"><?php echo e($Data->description != NULL ? $Data->description : ' - '); ?></textarea>
                <?php if($errors->has('description')): ?>
                  <span class="help-block">
                  <strong><?php echo e($errors->first('description')); ?></strong>
                  </span>
                  <?php endif; ?>
                  
                </div>
              
              </div>
            </div>

            <div class="form-group">
            <?php if(in_array("write", explode(',',$AdminProfiledetails->cms_settings))): ?>
              <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/Cms/featureedit.blade.php ENDPATH**/ ?>