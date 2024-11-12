<?php $__env->startSection('title', 'Admin Wallet'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1><?php echo e($coin); ?> Withdrawal Wallet</h1>
    </header>
    <?php if(session('status')): ?>
    <div class="alert alert-success">
      <?php echo e(session('status')); ?>

    </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Select Withdraw Asset</label>
            </div>
          </div>
          <div class="col-md-3 tg-select float-left">
            <select onchange="location = this.value;" class="form-control custom-s text-left">
              <option value="<?php echo e(url('admin/feewallet/'.$coin)); ?>" disabled><?php echo e($coin); ?></option>
              <?php $__currentLoopData = $coinlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coinlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e(url('admin/feewallet/'.$coinlist->source.'/'.$coinlist->type)); ?>" <?php if($coin==$coinlist->source && $coinlist->type == $type): ?> selected <?php endif; ?>><?php echo e($coinlist->source); ?> (<?php echo e(ucfirst($coinlist->type)); ?>)</option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>

          <div class="col-md-3">
            <div class="form-group">


              <a href="<?php echo e(url('admin/feewalletedit'). '/'.Crypt::encrypt($data->id)); ?>" name="edit" class="btn btn-light"><i class=""></i> Edit</a>

            </div>
          </div>
        </div>




        <form method="POST" action="<?php echo e(url('admin/cryptosendamount')); ?>" id="theform">
          <?php if(Session::has('success')): ?>
          <div class="alert alert-info"><?php echo e(Session::get('success')); ?></div>
          <?php elseif(Session::has('error')): ?>
          <div class="alert alert-danger"><?php echo e(Session::get('error')); ?></div>
          <?php endif; ?>
          <?php echo e(csrf_field()); ?>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Coin</label>
              </div>
            </div>
            <div class="col-md-4">
              <input type="hidden" name="id" class="form-control" value="<?php echo e(Crypt::encrypt($data->id)); ?>" readonly>

              <div class="form-group">
                <input type="text" name="coinname" class="form-control" value="<?php echo e($coin); ?>" readonly>
                <i class="form-group__bar"></i>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>From Address</label>
              </div>
            </div>
            <div class="col-md-5">
              <div class="input-group">
                <input type="text" name="fromaddress" class="form-control" value="<?php echo e($data->address); ?>" id="myInput" />
                <div class="input-group-append">
                  <span class="input-group-text btn btn-warning" id="basic-addon2" onclick="myFunction()">Click to Copy</span>
                </div>

                <i class="form-group__bar"></i>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Site Balance</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="site_balance" class="form-control" value="<?php echo e(display_format($site_balance,8)); ?>" readonly="">
                <i class="form-group__bar"></i>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Total Balance</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" name="balance" class="form-control" value="<?php echo e(display_format($data->balance,8)); ?>" readonly="">
                <i class="form-group__bar"></i>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>To Address</label>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <input type="text" name="toaddress" class="form-control" value="">
                <i class="form-group__bar"></i>
                <?php if($errors->has('toaddress')): ?>
              <span class="help-block">
                <strong class="text text-danger"><?php echo e($errors->first('toaddress')); ?></strong>
              </span>
              <?php endif; ?>
              </div>
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Amount</label>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <input type="text" id="amount" pattern="[0-9]*" inputmode="numeric" name="amount" class="form-control" value="">
                <i class="form-group__bar"></i>
                <?php if($errors->has('amount')): ?>
              <span class="help-block">
                <strong class="text text-danger"><?php echo e($errors->first('amount')); ?></strong>
              </span>
              <?php endif; ?>
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <button type="submit" name="edit" class="btn btn-light"><i class=""></i> Submit</button>
          </div>
        </form>
        <hr>
        <h4>Transaction Histroy:-</h4>
        <hr>
        <div class="table-responsive search_result">
          <table class="table" id="dows">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Date</th>
                <th>Type</th>
                <th>Txn ID</th>
                <th>Recipient</th>
                <th>Sender</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php if($depositList->count()): ?>
              <?php
              $limit=10;
              $i=1;
              if(isset($_GET['page'])){
              $page = $_GET['page'];
              $i = (($limit * $page) - $limit)+1;
              }else{
              $i =1;
              }
              if($coin == 'ETH'){
              $url = "https://etherscan.io/tx/";
              }else if($coin == 'BNB'){
              $url = "https://bscscan.com/tx/";
              }else{
              $url = "https://tronscan.org/#/transaction/";
              }

              ?>

              <?php $__currentLoopData = $depositList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $histroy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($i); ?></td>
                <td><?php echo e(date('d-m-Y h:i:s', strtotime($histroy->created_at))); ?></td>
                <td><?php echo e($histroy['txtype'] !="" ? $histroy['txtype'] : '-'); ?></td>
                <td><a href="<?php echo e($url.$histroy['txid']); ?>" target="_blank"><?php echo e($histroy['txid'] !="" ? mb_strimwidth($histroy['txid'], 0, 20, "...") : '-'); ?></a></td>

                <td><?php echo e($histroy['to_addr'] !="" ? $histroy['to_addr'] : '-'); ?></td>
                <td><?php echo e($histroy['from_addr'] !="" ? $histroy['from_addr'] : '-'); ?></td>
                <td><?php echo e(display_format($histroy->amount,8)); ?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <td colspan="7"> <?php echo e('No record found! '); ?></td>
              <?php endif; ?>
            </tbody>
          </table>

          <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
            <div class="pagination-tt clearfix">
              <?php if($depositList->count()): ?>
              <?php echo e($depositList->links()); ?>

              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#amount').on('input', function() {
      this.value = this.value.replace(/[^0-9]/g, ''); // Allow only digits
    });
  });
</script>
<script type="text/javascript">
  function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    document.getElementById("myInput").innerHTML = html;

  }
</script>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/admin/feewallet.blade.php ENDPATH**/ ?>