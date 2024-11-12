<?php echo $__env->make('email.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<tr><td align='left'>&nbsp;</td><td style='text-align:left;font-size: 15px;color:#000;'>Hi <?php echo e($details['user']); ?>,</td><td align='left'>&nbsp;</td></tr>
<tr><td colspan='3' align='center' height='1' style='padding:0px;'></td></tr>
<?php if($details['status'] == 'Accept'): ?>
<tr><td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>Your <?php echo e(display_format($details['amount'],8)); ?> <?php echo e($details['coin']); ?> Withdraw Request has been Transferred Successfully   . Kindly login your Koin Pair  account and check  withdraw history for detail Transaction. </td><td align='left' style='padding-top:0px;'>&nbsp;</td></tr>
<?php elseif($details['status'] == 'Cancel'): ?>
<tr><td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>Your <?php echo e($details['amount']); ?> <?php echo e($details['coin']); ?> Withdraw Request has been cancelled by admin . Kindly login your <?php echo e(config('app.name')); ?> account and check <?php echo e($details['coin']); ?> withdraw history </td><td align='left' style='padding-top:0px;'>&nbsp;</td></tr>
<?php else: ?>
<tr><td align='left' style='padding-top:0px;'>&nbsp;</td><td style='text-align:left;font-size:15px;color:#000;padding-top:0px;'>Your <?php echo e(display_format($details['amount'],8)); ?> <?php echo e($details['coin']); ?> Withdraw Request has been Transferred Successfully   . Kindly login your Koin Pair  account and check  withdraw history for detail Transaction.</td><td align='left' style='padding-top:0px;'>&nbsp;</td></tr>
<?php endif; ?>
<tr><td colspan='3' align='center' height='30' style='padding:0px;'></td></tr>


<?php echo $__env->make('email.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/email/withdraw.blade.php ENDPATH**/ ?>