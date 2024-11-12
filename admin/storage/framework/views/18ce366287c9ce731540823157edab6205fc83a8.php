<?php $__env->startSection('title', 'Add sub- Admin'); ?>
<?php $__env->startSection('content'); ?>

<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Sub Admin </h1>
    </header>
    <div class="card">
      <div class="card-body customcheck">
        <a href="<?php echo e(url('admin/subadminlist')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back</a>
        <br>
        <p>Sub Admin :-</p>
        <br />
        

        <?php if($error = Session::get('error')): ?>
        <div class="alert alert-warning alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong><?php echo e($error); ?></strong>
        </div>
        <?php endif; ?>
        <form method="post" action="<?php echo e(url('admin/subadmincreated')); ?>" autocomplete="off">
          <?php echo e(csrf_field()); ?>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group ctmcheck <?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                <input type="text" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="username" class="form-control" id="username" value="<?php echo e(old('username')); ?>" required />
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
                <input type="email" name="email" onkeypress="return AvoidSpace(event)" required pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" class="form-control" value="<?php echo e(old('email')); ?>" required />
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
                <label for="password">Password</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group ctmcheck <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                <input type="password" name="password"  id="password" class="form-control" value  required />
                <i class="form-group__bar"></i>
              <?php if($errors->has('password')): ?>
              <span class="help-block" style="color:red;">
                <strong><?php echo e($errors->first('password')); ?></strong>
              </span>
              <?php endif; ?> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Confirm Password</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group ctmcheck <?php echo e($errors->has('confirmpassword') ? ' has-error' : ''); ?>">
                <input type="password" name="confirmpassword"  id="confirmpassword" class="form-control" value required />
                <i class="form-group__bar"></i>
              <?php if($errors->has('confirmpassword')): ?>
              <span class="help-block" style="color:red;">
                <strong><?php echo e($errors->first('confirmpassword')); ?></strong>
              </span>
              <?php endif; ?>
              </div>
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
                    <input type="checkbox" name="dashboard[]" class="checkmark" value="buyers" />
                    <span class="checkmark">Buyer</span>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="dashboard[]" class="checkmark" value="sellers" />
                    <span class="checkmark">Seller</span>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="dashboard[]" class="checkmark" value="coinrequest" />
                    <span class="checkmark">Coin Request</span>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="dashboard[]" class="checkmark" value="userdetails" />
                    <span class="checkmark">User Details</span>
                  </label>
                </div>
              </div>
              
            </div>
            <div class="row mb-20 mt-20">
              <div class="col-md-3"></div>
              <div class="col-md-3">
                <h5>Read</h5>
              </div>
              <div class="col-md-3">
                <h5>Write</h5>
              </div>
              <div class="col-md-3">
                <h5>Delete</h5>
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
                    <input type="checkbox" name="userlist[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="userlist[]" class="checkmark" value="write" />
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
                    <input type="checkbox" name="refferalcommission[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="refferalcommission[]" class="checkmark" value="write" />
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
                    <input type="checkbox" name="refferalhistory[]" class="checkmark" value="read" />
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
                    <input type="checkbox" name="withdrawwallet[]" class="checkmark" value="read" />
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
                  <label>Coin Setting</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="coinsetting[]" class="checkmark" value="read" />
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="coinsetting[]" class="checkmark" value="write" />
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
                  <label>Contact</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="contact[]" class="checkmark" value="read" />
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="contact[]" class="checkmark" value="delete" />
                    <span class="checkmark"></span>
                  </label>  

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
                    <input type="checkbox" name="depositlist[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="depositlist[]" class="checkmark" value="write" />
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
                    <input type="checkbox" name="withdrawlist[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="withdrawlist[]" class="checkmark" value="write" />
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
                    <input type="checkbox" name="category[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="category[]" class="checkmark" value="write" />
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
                  <label>Commission Settings</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="commissionsetting[]" class="checkmark" value="read" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">
                  <label>
                    <input type="checkbox" name="commissionsetting[]" class="checkmark" value="write" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-check">

                </div>
              </div>
            </div> 
      
<div class="col-md-3">
<div class="form-check">

</div>
</div>
</div> 


  


<!--<div class="row">-->
  <!--  <div class="col-md-3">-->
    <!--    <div class="form-group">-->
      <!--      <label>Admin Security Settings</label>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--  <div class="col-md-3">-->
        <!--    <div class="form-check">-->
          <!--      <label>-->
            <!--        <input type="checkbox" name="adminsecurity[]" class="checkmark" value="read" />-->
            <!--      </label>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--  <div class="col-md-3">-->
              <!--    <div class="form-check">-->
                <!--      <label>-->
                  <!--        <input type="checkbox" name="adminsecurity[]" class="checkmark" value="write" />-->
                  <!--      </label>-->
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--  <div class="col-md-3">-->
                    <!--    <div class="form-check">-->
                      <!--      <label>-->
                        <!--        <input type="checkbox" name="adminsecurity[]" class="checkmark" value="delete" />-->
                        <!--      </label>-->
                        <!--    </div>-->
                        <!--  </div>-->
                        <!--</div>-->
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Add Sub Admin</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="addadmin[]" class="checkmark" value="read" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="addadmin[]" class="checkmark" value="write" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="addadmin[]" class="checkmark" value="delete" />
                                <span class="checkmark"></span>
                              </label>
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
                                <input type="checkbox" name="purchase[]" class="checkmark" value="read" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="purchase[]" class="checkmark" value="write" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="purchase[]" class="checkmark" value="delete" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                        </div>

                          



                         <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>security</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              <label>
                                <input type="checkbox" name="security[]" class="checkmark" value="write" />
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-check">
                              
                            </div>
                          </div>
                        </div>

<!--          <div class="row">
<div class="col-md-3">
<div class="form-group">
<label>Subscriber</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="read" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="write"  style=" cursor: not-allowed;" disabled="disabled" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="subscriber[]" class="checkmark" value="delete"  style=" cursor: not-allowed;" disabled="disabled"/>
<span class="checkmark"></span>
</label>
</div>
</div>
</div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>Contact  </label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="read" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="write"  style=" cursor: not-allowed;" disabled="disabled"/>
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="contact[]" class="checkmark" value="delete" />
<span class="checkmark"></span>
</label>
</div>
</div>
</div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
<label>News </label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="read" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="write" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="news[]" class="checkmark" value="delete" />
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
<input type="checkbox" name="post_page[]" class="checkmark" value="read" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="post_page[]" class="checkmark" value="write" />
<span class="checkmark"></span>
</label>
</div>
</div>
<div class="col-md-3">
<div class="form-check">
<label>
<input type="checkbox" name="post_page[]" class="checkmark" value="delete" />
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
        <input type="checkbox" name="support[]" class="checkmark" value="read" />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="support[]" class="checkmark" value="write" />
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
        <input type="checkbox" name="cms[]" class="checkmark" value="read" />
        <span class="checkmark"></span>
      </label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-check">
      <label>
        <input type="checkbox" name="cms[]" class="checkmark" value="write" />
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
      <button type="submit" name="edit" class="btn btn-light"><i class></i>Create Subadmin </button>
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
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/adminaccount/subadminadd.blade.php ENDPATH**/ ?>