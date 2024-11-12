<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin Panel | <?php echo e(config('app.name')); ?> </title>
<!-- favicon !-->
<link rel="icon" href="<?php echo e(url('images/favicon.png')); ?>">

<!-- Vendor styles -->
<link rel="stylesheet" href="<?php echo e(url('adminpanel/css/material-design-iconic-font.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('adminpanel/css/animate.min.css')); ?>">
<!-- App styles -->
<link rel="stylesheet" href="<?php echo e(url('adminpanel/css/app.min.css')); ?>">
</head>
<body data-sa-theme="7">
<!-- Login -->

<div class="login">

<div class="login__block active sectnbox" id="l-login">

<img src="<?php echo e(url('/images/light-logo.png')); ?>" class="logo-text" />

<div class="login__block__header">
<?php if($user->google2fa_verify==0): ?>
To enable 2FA, Scan the QR code shown on the page using an authenticator app like Google Authenticator                  
<?php else: ?>
Google Authenticator            
<?php endif; ?>
</div>

<div class="login__block__body">
<?php if(Session::has('error')): ?>
<p class="alert alert-danger"><?php echo e(Session::get('error')); ?></p>
<?php endif; ?>


<form method="post" class="form-horizontal" action="<?php echo e(url('/admin/google_admin_verfiy')); ?>">                       
<?php echo e(csrf_field()); ?>

<div class="panel panel-content panel-default panel-border bottom-line kyc-boxes">
<div class="">
<div class="text-center">
<h4>
<!-- <?php if($user->google2fa_verify==0): ?>
<?php echo e(__('common.Install_Google_Authenticator')); ?> 
<?php endif; ?> -->
</h4>
</div>
<div class="kyc-box">
<div class="text-center split-box col-xs-12">
<div class="">
<div class="grey-box enter-six-digit-verification-code">
<div>
<?php if(isset($image)): ?>
<?php if($user->google2fa_verify==0): ?>
<div style="qrimageborder"> <?php echo e($image ?? ''); ?></div>

<?php endif; ?>
<?php else: ?>
<?php endif; ?>
</div>
<h3 class="enter-six-digit-verification-code-google-verify">Google Verification</h3>
<?php if(session('warning')): ?>
<div class="alert alert-warning">
<?php echo e(session('warning')); ?>

</div>
<?php endif; ?>
<div class="form-group  has-feedback">
<label class="col-xs-12 enter-six-digit-verification-code-inner">Enter the 6 digits code</label>
<div class="col-xs-12 inputGroupContainer">
<input id="otp" type="number" class="form-control" name="otp" value="<?php echo e(old('otp')); ?>"  onkeyup="if (/[^0-9.]/g.test(this.value)) this.value = this.value.replace(/[^0-9.]/g,'')" required autofocus>
<?php if($errors->has('otp')): ?>
<span class="help-block">
<strong><?php echo e($errors->first('otp')); ?></strong>
</span>
<?php endif; ?>                                    
</div>
</div>
<div class="text-center form-group">        
<input type="submit" class="btn btn-success site-btn mt-20 text-uppercase nova-font-bold" value="Submit">
</div>

</div>
</div>
</div>
</div>
</div>
</div> 
</form>
</div>
</div>
</div>

<script src="<?php echo e(url('adminpanel/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(url('adminpanel/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('adminpanel/js/bootstrap.min.js')); ?>"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="<?php echo e(url('adminpanel/js/app.min.js')); ?>"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/qrcodeview.blade.php ENDPATH**/ ?>