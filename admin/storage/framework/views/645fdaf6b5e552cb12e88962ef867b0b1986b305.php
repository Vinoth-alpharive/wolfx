<?php $__env->startSection('title', 'Add sub- Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1> Sub Admin List</h1>
    </header>
    <?php if(Session::has('message')): ?>
    <p class="alert alert-success"><?php echo e(Session::get('message')); ?></p>
    <?php endif; ?>
    <?php if($error = Session::get('error')): ?>
    <div class="alert alert-warning alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong><?php echo e($error); ?></strong>
    </div>
    <?php endif; ?>
    <div class="card">
      <div class="card-body">
        <a href="<?php echo e(url('admin/subadminlist')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to Sub Admin List</a>
        <br ><br >
        <div class="tab-container">                 
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="<?php echo e(url('/admin/subadminedit/'.Crypt::encrypt($user->id))); ?>" role="tab">Sub Admin Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(url('/admin/subadminchangepassword/'.Crypt::encrypt($user->id))); ?>" role="tab">Sub Admin Change Password</a>
            </li>
          </ul>
          <br>
        </div>
        <form method="post" action="<?php echo e(url('admin/subadminupdate/'.$id)); ?>" autocomplete="off">
          <?php echo e(csrf_field()); ?>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group ctmcheck <?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                <input type="text" name="username" class="form-control" value="<?php echo e($user->name); ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required="" />
                <i class="form-group__bar"></i> 
              </div>
              <?php if($errors->has('username')): ?>
              <span class="help-block" style="color:red;"> 
                <strong><?php echo e($errors->first('username')); ?></strong>
              </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="email">Email</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group ctmcheck">
                <input type="email" name="email" onkeypress="return AvoidSpace(event)" required pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" class="form-control" value="<?php echo e($user->email); ?>" required="" readonly/>
                <i class="form-group__bar"></i>
              </div>
              <?php if($errors->has('email')): ?>
              <span class="help-block" style="color:red;">
                <strong><?php echo e($errors->first('email')); ?></strong>
              </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="email">Google 2FA</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group ctmcheck">
                <select name="twofa"  class="form-control" required="required">
                  <?php if($user->google2fa_verify!=0): ?>
                  <option <?php if($user->google2fa_verify==1): ?> selected <?php endif; ?> value="1">Enabled</option>
                  <option <?php if($user->google2fa_verify==2): ?> selected <?php endif; ?> value="2">Disabled</option>
                  <?php else: ?>
                  <option value="0">Not Verified</option>
                  <?php endif; ?>
                </select>
                <i class="form-group__bar"></i>
              </div>
              <?php if($errors->has('email')): ?>
              <span class="help-block" style="color:red;">
                <strong><?php echo e($errors->first('email')); ?></strong>
              </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="checkmrkbox">
            
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Dashboard</label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check">
                  <label>   
                    <input type="checkbox" name="dashboard[]" class="checkmark" value="buyers"  <?php if(in_array("buyers", explode(',',$profile->dashboard))): ?> checked <?php endif; ?>/>
                    <span class="checkmark">Buyers</span>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="dashboard[]" class="checkmark" value="sellers"  <?php if(in_array("sellers", explode(',',$profile->dashboard))): ?> checked <?php endif; ?> />
                    <span class="checkmark">Sellers</span>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="dashboard[]" class="checkmark" value="coinrequest" <?php if(in_array("coinrequest", explode(',',$profile->dashboard))): ?> checked <?php endif; ?>/>
                    <span class="checkmark">Coin Request</span>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="dashboard[]" class="checkmark" value="userdetails" <?php if(in_array("userdetails", explode(',',$profile->dashboard))): ?> checked <?php endif; ?>/>
                    <span class="checkmark">User Details</span>
                  </label>
                </div>
              </div>
             
            </div>
            <div class="row mb-20 mt-20">
              <div class="col-md-3"></div>
              <div class="col-md-3">
                <h5>Read </h5>
              </div>
              <div class="col-md-3">
                <h5>Write </h5>
              </div>
              <div class="col-md-3">
                <h5>Delete </h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Users List</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="userlist[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->userlist))): ?> checked <?php endif; ?>/>
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="userlist[]" class="checkmark" value="write"  <?php if(in_array("write", explode(',',$profile->userlist))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  
                </div>
              </div>
            </div>

              <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Referral Commision</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="refferalcommission[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->refferalcommission))): ?> checked <?php endif; ?>/>
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="refferalcommission[]" class="checkmark" value="write"  <?php if(in_array("write", explode(',',$profile->refferalcommission))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  
                </div>
              </div>
            </div>

              <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Refferal History</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="refferalhistory[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->refferalhistory))): ?> checked <?php endif; ?>/>
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  
                </div>
              </div>
            </div>
            

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Withdraw Wallet</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="withdrawwallet[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->withdrawwallet))): ?> checked <?php endif; ?> />
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                </div>
              </div>
            </div> 

            
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Deposit History</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="depositlist[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->depositlist))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="depositlist[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->depositlist))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Withdraw History</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="withdrawlist[]" class="checkmark" value="read"  <?php if(in_array("read", explode(',',$profile->withdrawlist))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="withdrawlist[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->withdrawlist))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Category</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="category[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->category))): ?> checked <?php endif; ?>/>
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="category[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->category))): ?> checked <?php endif; ?>/>
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">

                </div>
              </div>
            </div>
            

            

              <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Coin Setting</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="coinsetting[]" class="checkmark" value="read"  <?php if(in_array("read", explode(',',$profile->coinsetting))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="coinsetting[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->coinsetting))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="coinsetting[]" class="checkmark" value="delete" <?php if(in_array("delete", explode(',',$profile->coinsetting))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Commission Settings</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="commissionsetting[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->commissionsetting))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="commissionsetting[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->commissionsetting))): ?> checked <?php endif; ?> />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                </div>
              </div>
            </div> 
             

            
                                    
                                    <div class="row">
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label>Add Sub Admin</label>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-check">
                                          <label>
                                            <input type="checkbox" name="addadmin[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->addadmin))): ?> checked <?php endif; ?> />
                                            <span class="checkmark"></span>
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-check">
                                          <label>
                                            <input type="checkbox" name="addadmin[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->addadmin))): ?> checked <?php endif; ?> />
                                            <span class="checkmark"></span>
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-check">
                                          <label>
                                            <input type="checkbox" name="addadmin[]" class="checkmark" value="delete" <?php if(in_array("delete", explode(',',$profile->addadmin))): ?> checked <?php endif; ?> />
                                            <span class="checkmark"></span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
<!--      <div class="row">
<div class="col-md-3">
<div class="form-group">
<label>Subscriber</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->subscriber))): ?> checked <?php endif; ?> />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->subscriber))): ?> checked <?php endif; ?> disabled=""/>
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="delete" <?php if(in_array("delete", explode(',',$profile->subscriber))): ?> checked <?php endif; ?>  disabled=""/>
<span class="checkmark"></span>
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label> Contact </label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->contact))): ?> checked <?php endif; ?> />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->contact))): ?> checked <?php endif; ?> disabled=""/>
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="delete" <?php if(in_array("delete", explode(',',$profile->contact))): ?> checked <?php endif; ?> />
<span class="checkmark"></span>
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>News</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->news))): ?> checked <?php endif; ?> />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->news))): ?> checked <?php endif; ?> />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="delete" <?php if(in_array("delete", explode(',',$profile->news))): ?> checked <?php endif; ?> />
<span class="checkmark"></span>
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>post menu </label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="post_page[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->post_page))): ?> checked <?php endif; ?>  />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="post_page[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->post_page))): ?> checked <?php endif; ?> />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="post_page[]" class="checkmark" value="delete" <?php if(in_array("delete", explode(',',$profile->post_page))): ?> checked <?php endif; ?> />
<span class="checkmark"></span>
</label>
</div>
</div>
</div> -->
                                    



<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label> Support</label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="support[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->support))): ?> checked <?php endif; ?> />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="support[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->support))): ?> checked <?php endif; ?> />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Purchase</label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="purchase[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->purchase))): ?> checked <?php endif; ?>/>
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="purchase[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->purchase))): ?> checked <?php endif; ?>/>
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="purchase[]" class="checkmark" value="delete" <?php if(in_array("delete", explode(',',$profile->purchase))): ?> checked <?php endif; ?>/>
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label>Security</label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="security[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->security))): ?> checked <?php endif; ?> />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
    </div>
  </div>
</div>



<div class="row">
  <div class="col-md-3">
    <div class="form-group">
      <label> Page Content Settings</label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="cms[]" class="checkmark" value="read" <?php if(in_array("read", explode(',',$profile->cms_settings))): ?> checked <?php endif; ?>/>
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="cms[]" class="checkmark" value="write" <?php if(in_array("write", explode(',',$profile->cms_settings))): ?> checked <?php endif; ?>/>
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="cms[]" class="checkmark" value="delete" <?php if(in_array("delete", explode(',',$profile->cms_settings))): ?> checked <?php endif; ?>/>
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
    </div>
  </div>
</div>
</div>
<?php if(in_array("write", explode(',',$AdminProfiledetails->addadmin))): ?>
<div class="row">
  <div class="col-md-12">        
    <div class="form-group">
      <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
    </div>
  </div>
</div>
<?php endif; ?>
</div>
</div>
</form>
</div>
</div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/adminaccount/subadminedit.blade.php ENDPATH**/ ?>