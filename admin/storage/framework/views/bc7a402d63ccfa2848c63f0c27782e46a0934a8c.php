<?php
if($userdetails->user_type == 'Buyer') {
$atitle = "buyer";
} else {
$atitle = "seller";
}
?>


<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <header class="content__title">
        <h1>View User Details</h1>
    </header>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <?php if($userdetails->user_type == 'Buyer'): ?>
                    <a href="<?php echo e(url('admin/buyer')); ?>"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    <?php else: ?>
                    <a href="<?php echo e(url('admin/seller')); ?>"><i class="zmdi zmdi-arrow-left"></i>Back to User</a>
                    <?php endif; ?>

                    <br /><br />

                    <?php if(session('updated_status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('updated_status')); ?>

                    </div>
                    <?php endif; ?>


                    <?php if(session('updated_error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('updated_error')); ?>

                    </div>
                    <?php endif; ?>

                    <div class="tab-container">

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo e(url('/admin/users_edit/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">User Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/transactionall/' . Crypt::encrypt($userdetails->id) . '/BTC')); ?>" role="tab">Transactions</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/users_referral/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">Referral</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/users_wallet/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">Wallet</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/userdeposit/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin Deposit</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/user_withdraw/' . Crypt::encrypt($userdetails->id))); ?>" role="tab">Coin Withdraw</a>
                            </li>


                        </ul>

                        </br>
                    </div>


                    <form method="post" action="<?php echo e(url('admin/update_user')); ?>" autocomplete="off">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($userdetails->id); ?>" name="id">

                        

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Price</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="price" class="form-control" value="<?php echo e($userdetails->price ?? '-'); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('price')): ?>
                                    <span class="help-block">
                                        <strong class="text text-danger"><?php echo e($errors->first('price')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Country</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="country">
                                        <?php if($userdetails->country == ''): ?>
                                        <option value="">Select Country</option>
                                        <?php $__currentLoopData = country(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($countrys->id); ?>" <?php if($countrys->id == $userdetails->country): ?> selected <?php endif; ?>>
                                            <?php echo e($countrys->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <?php $__currentLoopData = country(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($countrys->id); ?>" <?php if($countrys->id == $userdetails->country): ?> selected <?php endif; ?>>
                                            <?php echo e($countrys->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php if($errors->has('country')): ?>
                                    <span class="help-block">
                                        <strong class="text text-danger"><?php echo e($errors->first('country')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Phone No</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="number" name="phone" class="form-control" value="<?php echo e($phone); ?>" /><i class="form-group__bar"></i>
                                    <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong class="text text-danger"><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Address</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" cols="10" name="address"><?php echo e($address); ?></textarea>
                                    <?php if($errors->has('address')): ?>
                                    <span class="help-block">
                                        <strong class="text text-danger"><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nationality</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="nationality" class="form-control" value="<?php echo e($userdetails->nationality ? $userdetails->nationality : '-'); ?>" /><i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Refferal ID</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="referral_id" class="form-control" value="<?php echo e($userdetails->referral_id); ?>" readonly /><i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Parent ID</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="parent_id" class="form-control" value="<?php echo e($userdetails->parent_id ? $userdetails->parent_id : '-'); ?>" /><i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email Verify</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">

                                        <?php if($userdetails->email_verify == 1): ?>
                                        <select name="emailcheck" class="form-control" required>
                                            <option value="1">Verified</option>
                                            <option value="0">Not Verify</option>
                                        </select>
                                        <?php else: ?>
                                        <select name="emailcheck" class="form-control" required>
                                            <option value="0">Not Verify</option>
                                            <option value="1">Verified</option>
                                        </select>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="toggle-switch">

                                        <input type="checkbox" class="toggle-switch__checkbox" name="is_payment" <?php if($userdetails->is_payment == 1): ?> checked="" <?php endif; ?> value="1">
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>2FA Access</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">

                                        <select name="twofactor" class="form-control">
                                            <option value="">Please select</option>
                                            <option value="0">Reset 2FA</option>
                                            <option value="1" <?php if($userdetails->twofa == 'email_otp'): ?> selected <?php endif; ?>>
                                                Email OTP</option>
                                            <option value="3" <?php if($userdetails->twofa == 'google_otp'): ?> selected <?php endif; ?>>
                                                Google Authenticator</option>
                                            <option value="2">Reset Google 2fa secret</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> User block</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="toggle-switch">

                                        <input type="checkbox" class="toggle-switch__checkbox" name="user_status" <?php if($userdetails->status == 1): ?> checked="" <?php endif; ?> value="1">
                                        <i class="toggle-switch__helper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> User block reason</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <textarea rows="4" name="reason_block" class="form-control"><?php echo e($userdetails->reason); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Role</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                    <?php $__empty_1 = true; $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
                                        <div class="form-check">
                                            <input type="checkbox" name="user_role[]" value="<?php echo e($categ->name ?? ''); ?>" class="form-check-input" id="roleBase<?php echo e($categ->id ?? ''); ?>" <?php echo e(is_array($userrole) && in_array($categ->name, $userrole) ? 'checked' : ''); ?>>
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
                            <button type="submit" name="edit" class="btn btn-light"><i class=""></i>
                                Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php if(session('withdraw_status')): ?>
    <div class="alert alert-success">
        <?php echo e(session('withdraw_status')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('withdraw_error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('withdraw_error')); ?>

    </div>
    <?php endif; ?>

    <?php if(count($Bankuser) > 0): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="">BANK DETAILS</h5></br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>S.No</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>Bank Name</th>
                        <th>Bank Branch</th>
                        <th>Bank Address</th>
                        <th>Swift Code</th>
                        <th>Branch Code</th>
                    </thead>
                    <tbody>
                        <?php $i =1 ;?>
                        <?php $__currentLoopData = $Bankuser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($bank->account_name ? $bank->account_name : '-'); ?></td>
                            <td><?php echo e($bank->account_no ? $bank->account_no : '-'); ?></td>
                            <td><?php echo e($bank->bank_name ? $bank->bank_name : '-'); ?></td>
                            <td><?php echo e($bank->bank_branch ? $bank->bank_branch : '-'); ?></td>
                            <td><?php echo e($bank->bank_address ? $bank->bank_address : '-'); ?></td>
                            <td><?php echo e($bank->swift_code ? $bank->swift_code : '-'); ?></td>
                            <td><?php echo e($bank->branch_code ? $bank->branch_code : '-'); ?></td>
                        </tr>
                        <?php $i++;?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/user/user_edit.blade.php ENDPATH**/ ?>