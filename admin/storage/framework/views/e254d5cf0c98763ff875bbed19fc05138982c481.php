<?php
  
  if(isset($atitle)){ 
    switch($atitle){
      case 'dashboard':
      $active = "dashboard";
      break;
      case 'users':
      $active = "users";
      break;
            case 'buyer':
      $active = "buyer";
      break;
            case 'seller':
      $active = "seller";
      break;
      case 'tradepair':
      $active = "tradepair";
      break;
      case 'commission':
      $active = "commission";
      break;
      case 'p2ptrade':
        $active = "p2ptrade";
        break;
      case 'pendingpurchase':
      $active = "pendingpurchase";
      break;
      case 'completedpurchase':
      $active = "completedpurchase";
      break;
      case 'deposit':
      $active = "deposit";
      break;
      case 'trades':
        $active = "trades";
        break;
      case 'withdraw':
      $active = "withdraw";
      break;
      case 'adminwallet':
      $active = "adminwallet";
      break;
      case 'adminbank':
      $active = "adminbank";
      break;
      case 'coinlist':
      $active = "coinlist";
      break;
      case 'contact':
      $active = "contact";
      break;
      case 'subscriber':
      $active = "subscriber";
      break;
       case 'support':
      $active = "support";
      break;
       case 'cms':
      $active = "cms";
      break;
      case 'homepage':
      $active = "homepage";
      break;
       case 'liveprice':
      $active = "liveprice";
      break;
       case 'tc':
      $active = "tc";
      break;
       case 'privacy':
      $active = "privacy";
      break;
       case 'faq':
      $active = "faq";
      break;
      case 'faq_add':
      $active = "faq_add";
      break;
       case 'faq_edit':
      $active = "faq_edit";
      break;
       case 'aboutus':
      $active = "aboutus";
      break;
       case 'bittrex':
      $active = "bittrex";
      break;
       case 'socialmedia':
      $active = "socialmedia";
      break;
       case 'termsservices':
      $active = "termsservices";
      break;
       case 'settings':
      $active = "settings";
      break;
      case 'swap':
      $active ="swap";
      case 'swaphistory':
      $active ="swaphistory";
      case 'logout':
      $active = "logout";
      break;
      case 'feescollected':
      $active = "feescollected";
      break;
      case 'apply-launchpad':
      $active = 'apply-launchpad';
      break;
      case 'p2b-launchpad':
      $active = 'p2b-launchpad';
      break;
      case 'participates-launchpad':
      $active = 'participates-launchpad';
      break;
      case 'borrow-list':
      $active = 'borrow-list';
      break;
      case 'borrow-interest':
      $active = 'borrow-interest';
      break;
      case 'offer':
      $active = 'offer';
      break;
      case 'welcomerewards':
      $active = 'welcomerewards';
      break;
      case 'commission_wallet_history':
      $active = "commission_wallet_history";
      break;
      case 'commission_history':
      $active = "commission_history";
      break;
      case 'category':
      $active = "category";
      break;
      case 'referalcommission':
      $active = "referalcommission";
      break;
      default:
      $active = "dashboard";
      break;
    }
    }else{
    $active = "";
  }
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin Dashboard | <?php echo e(config('app.name')); ?> </title>

    <link rel="icon" href="<?php echo e(url('images/favicon.png')); ?>">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/dist/css/material-design-iconic-font.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/js/jquery.scrollbar/jquery.scrollbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/fullcalendar.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/flatpickr.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/font-awesome/css/font-awesome.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/app.min.css?v=1.1.24')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('adminpanel/css/pagination.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <META NAME="robots" CONTENT="noindex,nofollow">



    <?php echo $__env->yieldPushContent('customscripts'); ?>
</head>
<body data-sa-theme="7">
    <main class="main">
        <header class="header">
            <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                <i class="zmdi zmdi-menu"></i>
            </div>

            <div class="logo hidden-sm-down">
                <h1><a href="<?php echo e(url('admin/dashboard')); ?>">
                        <img src="<?php echo e(url('public/images/pageimage/light-logo.png')); ?>" class="logo-text-1" />
                    </a></h1>
            </div>

            <ul class="top-nav">
                <li class="hidden-xl-up"><a href="#" data-sa-action="search-open"><i class="zmdi zmdi-search"></i></a></li>
                <li class="dropdown top-nav__notifications">
                    <a href="#" data-toggle="dropdown" class="top-nav__notify">
                        <i class="zmdi zmdi-notifications"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                </li>
            </ul>


        </header>

        <aside class="sidebar">
            <div class="scrollbar-inner">
                <div class="user">
                    <div class="user__info" data-toggle="dropdown">
                        <div>
                            <div class="user__name"><?php echo e($Admindetails->username); ?></div>
                            <div class="user__email"><?php echo e($Admindetails->email); ?> </div>
                        </div>
                    </div>
                </div>

                <ul class="navigation">
                    <li class="@photogalleryactive"><a <?php if($active=="dashboard" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/dashboard')); ?>"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a></li>

                    <?php if(in_array("read", explode(',',$AdminProfiledetails->userlist))): ?>
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-accounts-alt"></i>User</a>
                        <ul <?php if($active=="buyer" || $active=="seller" ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <li class="@colorsactive"><a <?php if($active=="buyer" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/buyer')); ?>">Buyer</a></li>
                            <li class="@colorsactive"><a <?php if($active=="seller" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/seller')); ?>">Seller</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(in_array("read", explode(',',$AdminProfiledetails->coinsetting))): ?>
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-edit"></i>Coin Settings</a>
                        <ul <?php if($active=="tradepair" || $active=="commission" || $active=="coinlist" ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <li class="@colorsactive"><a <?php if($active=="coinlist" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/coinlist')); ?>">Tokens List</a></li>
                            
                            <?php if(in_array("read", explode(',',$AdminProfiledetails->commissionsetting))): ?>
                            <li class="@colorsactive"><a <?php if($active=="commission" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/commission')); ?>">Commission Settings </a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    

                    <?php if(in_array("read", explode(',',$AdminProfiledetails->refferalcommission))): ?> 
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-edit"></i>Referral</a>
                        
                        <ul <?php if($active=="referalcommission" ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                            <li class="@colorsactive"><a <?php if($active=="referalcommission" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/referalcommission')); ?>">Referral Settings</a></li>
                            
                    
                </ul>
                </li>
                <?php endif; ?>
                <?php if(in_array("read",explode(',',$AdminProfiledetails->category))): ?>
                <li class="@photogalleryactive"><a <?php if($active=="category" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/category')); ?>"><i class="zmdi zmdi-globe"></i>Category</a></li>
                <?php endif; ?>

                <?php if(in_array("read", explode(',',$AdminProfiledetails->purchase))): ?>
                <li class="navigation__sub navigation__sub--toggled"><a <?php if($active=="" ): ?> class="active" <?php endif; ?> href="#"><i class="zmdi zmdi-time-restore"></i>Purchase</a>
                    <?php endif; ?>
                    <ul <?php if($active=="pendingpurchase" || $active=="purchasehistory" ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>

                        <li class="@colorsactive"><a <?php if($active=="pendingpurchase" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/pendingpurchase')); ?>">Cancelled Purchase</a></li>
                        <li class="@colorsactive"><a <?php if($active=="purchasehistory" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/purchasehistory')); ?>">Completed Purchase</a></li>
                    </ul>
                </li>


                <?php if(in_array("read", explode(',',$AdminProfiledetails->depositlist))): ?>
                <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="fa fa-money" aria-hidden="true"></i>User Deposit History</a>
                    <?php endif; ?>
                    <ul <?php if($active=="deposit" ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                        <?php $__empty_1 = true; $__currentLoopData = list_coin(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                        <?php if(isset($coin)): ?>
                        <?php $selectedcoin = $coin; ?>
                        <?php else: ?>
                        <?php $selectedcoin = 'BTC'; ?>
                        <?php endif; ?>


                        <li class="@colorsactive"><a <?php if($selectedcoin==$coins->source): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/deposits/'.$coins->source)); ?>"><?php echo e($coins->source); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="@colorsactive"><a href="#">No Coins list</a></li>
                        <?php endif; ?>
                    </ul>
                </li>


                <?php if(in_array("read", explode(',',$AdminProfiledetails->withdrawlist))): ?>
                <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="fa fa-arrows" aria-hidden="true"></i>User Withdraw History</a>
                    <?php endif; ?>
                    <ul <?php if($active=="withdraw" ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                        <?php $__empty_1 = true; $__currentLoopData = list_coin(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coinss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                        $c = \Request::segment(3);?>
                        <?php if(isset($c)): ?>
                        <?php $selectedcoin = $c; ?>
                        <?php else: ?>
                        <?php $selectedcoin = 'BTC'; ?>
                        <?php endif; ?>
                        <li class="@colorsactive"><a <?php if($selectedcoin==$coinss->source): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/withdraw/'.$coinss->source)); ?>"><?php echo e($coinss->source); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="@colorsactive"><a <?php if($active=="withdraw" ): ?> class="active" <?php endif; ?> href="#">No Coins list</a></li>
                        <?php endif; ?>
                    </ul>
                </li>

                
                <?php if(in_array("read", explode(',',$AdminProfiledetails->withdrawwallet))): ?>
                <li class="@photogalleryactive"><a <?php if(request()->segment(2) == "feewallet"): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/feewallet/ETH/coin')); ?>"><i class="zmdi zmdi-balance-wallet"></i>Withdraw Wallet</a></li>
                <?php endif; ?>
                
                    <ul <?php if($active=="adminbank" ): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                        <?php
                        $cmss = \Request::segment(3);
                        $Commission = \App\Models\Commission::on('mysql2')->where('type','fiat')->get();
                        ?>
                        <?php $__currentLoopData = $Commission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="@colorsactive">
                            <a <?php if($value->source == $cmss): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/bank/'.$value->source )); ?>"><?php echo e($value->source); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </li>

                

                <?php if(in_array("read", explode(',',$AdminProfiledetails->addadmin))): ?>
                <li class="@photogalleryactive"><a <?php if($active=="kyc" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/subadminlist')); ?>"><i class="zmdi zmdi-assignment-o"></i>Sub-Admin Control</a></li>
                <?php endif; ?>

                <?php if(in_array("read", explode(',',$AdminProfiledetails->refferalcommission))): ?>
                <!-- <li class="@photogalleryactive"><a <?php if(request()->segment(2) == 'aff_commission'): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/aff_commission')); ?>"><i class="fa fa-share-alt"></i>Referral Commission</a></li> -->
                <?php endif; ?>

                <?php if(in_array("read", explode(',',$AdminProfiledetails->refferalhistory))): ?>
                <!-- <li class="@photogalleryactive"><a <?php if(request()->segment(2) == 'affliatetransaction'): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/affliatetransaction')); ?>"><i class="fa fa-share-alt"></i>Referral Histroy</a></li> -->
                <?php endif; ?>

                <!-- <?php if(in_array("read", explode(',',$AdminProfiledetails->contact))): ?> 
                 <li class="@photogalleryactive"><a <?php if($active == "contact"): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/contactus')); ?>"><i class="zmdi zmdi-account-box"></i> Contact</a></li>
                <?php endif; ?> -->

                <?php if(in_array("read", explode(',',$AdminProfiledetails->cms_settings))): ?>
                <li class="navigation__sub navigation__sub--toggled"><a <?php if(request()->segment(2) == "cmscontentedit"): ?> class="active" <?php endif; ?> href="#"><i class="zmdi zmdi-settings-square"></i>Page Content Setting</a>
                    <?php endif; ?>
                    <ul <?php if(request()->segment(2) == "cmscontentedit"): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>

                        <li class="@colorsactive"><a <?php if(request()->segment(3) == "features"): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/featurelist/feature')); ?>">Features</a></li>
                        <li class="@colorsactive"><a <?php if(request()->segment(3) == "platformadvantage"): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/platformadvantage/platform')); ?>">Platform Advantage</a></li>
                        
                </ul>
                </li>

                <!-- <?php if(in_array("read", explode(',',$AdminProfiledetails->subscriber))): ?> 
                 <li class="@photogalleryactive"><a <?php if($active == "subscriber"): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/subscriber')); ?>"><i class="zmdi zmdi-email-open"></i> Subscriber</a></li> 
            <?php endif; ?> -->

                <!-- <?php if(in_array("read", explode(',',$AdminProfiledetails->refferalhistory))): ?>
                <li class="@photogalleryactive"><a <?php if($active=="support" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('/admin/support')); ?>"><i class="zmdi zmdi-ticket-star"></i> Support (<?php echo e(ticketcount()); ?>)<span class="pull-right"> </span></a></li>
                <?php endif; ?> -->

                <?php if(in_array("write", explode(',',$AdminProfiledetails->security))): ?>
                <li class="@photogalleryactive"><a <?php if($active=="settings" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('admin/security')); ?>"><i class="zmdi zmdi-shield-check" aria-hidden="true"></i>Security Settings </a></li>
                <?php endif; ?>
                <!--   <li class="@photogalleryactive"><a href="<?php echo e(url('admin/adminwallet')); ?>"><i class="zmdi zmdi-balance-wallet zmdi-hc-fw" aria-hidden="true"></i>Admin Wallet </a></li> -->

                <li class="@photogalleryactive"><a <?php if($active=="logout" ): ?> class="active" <?php endif; ?> href="<?php echo e(url('logout')); ?>"><i class="zmdi zmdi-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </aside>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\WolfX_admin\public\resources\views/layouts/header.blade.php ENDPATH**/ ?>