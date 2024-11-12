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
      case 'feewallet':
      $active = "feewallet";
      break;
      case 'subadmincontrol':
      $active = "subadmincontrol";
      break;
      case 'featurelist':
      $active = "featurelist";
      break;
      case 'platformadvantage':
      $active = "platformadvantage";
      break;
      case 'purchasehistory':
      $active = "purchasehistory";
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | {{ config('app.name') }} </title>

    <link rel="icon" href="{{ url('images/favicon.png') }}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ url('adminpanel/dist/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/js/jquery.scrollbar/jquery.scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ url('adminpanel/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ url('adminpanel/css/app.min.css?v=1.2.2') }}">
    <link rel="stylesheet" href="{{ url('adminpanel/css/pagination.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <META NAME="robots" CONTENT="noindex,nofollow">



    @stack('customscripts')
</head>
<body data-sa-theme="7">
    <main class="main">
        <header class="header">
            <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                <i class="zmdi zmdi-menu"></i>
            </div>

            <div class="logo hidden-sm-down">
                <h1><a href="{{ url('admin/dashboard') }}">
                        <img src="{{ url('public/images/pageimage/light-logo.png') }}" class="logo-text-1" />
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
                            <div class="user__name">{{ $Admindetails->username }}</div>
                            <div class="user__email">{{ $Admindetails->email }} </div>
                        </div>
                    </div>
                </div>

                <ul class="navigation">
                    <li class="@@photogalleryactive"><a @if($active=="dashboard" ) class="active" @endif href="{{ url('admin/dashboard') }}"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a></li>

                    @if(in_array("read", explode(',',$AdminProfiledetails->userlist)))
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-accounts-alt"></i>User</a>
                        <ul @if($active=="buyer" || $active=="seller" ) style="display: block;" @else style="display: none;" @endif>
                            <li class="@@colorsactive"><a @if($active=="buyer" ) class="active" @endif href="{{ url('admin/buyer') }}">Buyer</a></li>
                            <li class="@@colorsactive"><a @if($active=="seller" ) class="active" @endif href="{{ url('admin/seller') }}">Seller</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(in_array("read", explode(',',$AdminProfiledetails->coinsetting)))
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-edit"></i>Coin Settings</a>
                        <ul @if($active=="tradepair" || $active=="commission" || $active=="coinlist" ) style="display: block;" @else style="display: none;" @endif>
                            <li class="@@colorsactive"><a @if($active=="coinlist" ) class="active" @endif href="{{ url('admin/coinlist') }}">Tokens List</a></li>
                            {{-- <li class="@@colorsactive"><a @if($active=="tradepair" ) class="active" @endif href="{{ url('admin/tradepairlist') }}">Trade Pair </a></li> --}}
                            @if(in_array("read", explode(',',$AdminProfiledetails->commissionsetting)))
                            <li class="@@colorsactive"><a @if($active=="commission" ) class="active" @endif href="{{ url('admin/commission') }}">Commission Settings </a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    

                    @if(in_array("read", explode(',',$AdminProfiledetails->refferalcommission))) 
                    <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-edit"></i>Referral</a>
                        {{-- @endif   --}}
                        <ul @if($active=="referalcommission" ) style="display: block;" @else style="display: none;" @endif>
                            <li class="@@colorsactive"><a @if($active=="referalcommission" ) class="active" @endif href="{{ url('admin/referalcommission') }}">Referral Settings</a></li>
                            {{-- <li class="@@colorsactive"><a @if($active == "tradepair") class="active" @endif href="{{ url('admin/tradepairlist') }}">Trade Pair </a>
                    </li> --}}
                    {{-- @if(in_array("read", explode(',',$AdminProfiledetails->commissionsetting))) 
                         <li class="@@colorsactive"><a @if($active == "commission") class="active" @endif href="{{ url('admin/commission') }}">Commission Settings </a></li>
                    @endif --}}
                </ul>
                </li>
                @endif
                @if(in_array("read",explode(',',$AdminProfiledetails->category)))
                <li class="@@photogalleryactive"><a @if($active=="category" ) class="active" @endif href="{{ url('admin/category') }}"><i class="zmdi zmdi-globe"></i>Category</a></li>
                @endif

                @if(in_array("read", explode(',',$AdminProfiledetails->purchase)))
                <li class="navigation__sub navigation__sub--toggled"><a @if($active=="" ) class="active" @endif href="#"><i class="zmdi zmdi-time-restore"></i>Purchase</a>
                    @endif
                    <ul @if($active=="pendingpurchase" || $active=="purchasehistory" ) style="display: block;" @else style="display: none;" @endif>

                        <li class="@@colorsactive"><a @if($active=="pendingpurchase" ) class="active" @endif href="{{ url('admin/pendingpurchase') }}">Cancelled Purchase</a></li>
                        <li class="@@colorsactive"><a @if($active=="purchasehistory" ) class="active" @endif href="{{ url('admin/purchasehistory') }}">Completed Purchase</a></li>
                    </ul>
                </li>


                @if(in_array("read", explode(',',$AdminProfiledetails->depositlist)))
                <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="fa fa-money" aria-hidden="true"></i>User Deposit History</a>
                    @endif
                    <ul @if($active=="deposit" ) style="display: block;" @else style="display: none;" @endif>
                        @forelse(list_coin() as $coins)


                        @if(isset($coin))
                        @php $selectedcoin = $coin; @endphp
                        @else
                        @php $selectedcoin = 'BTC'; @endphp
                        @endif


                        <li class="@@colorsactive"><a @if($selectedcoin==$coins->source) class="active" @endif href="{{ url('admin/deposits/'.$coins->source) }}">{{$coins->source}}</a></li>
                        @empty
                        <li class="@@colorsactive"><a href="#">No Coins list</a></li>
                        @endforelse
                    </ul>
                </li>


                @if(in_array("read", explode(',',$AdminProfiledetails->withdrawlist)))
                <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="fa fa-arrows" aria-hidden="true"></i>User Withdraw History</a>
                    @endif
                    <ul @if($active=="withdraw" ) style="display: block;" @else style="display: none;" @endif>
                        @forelse(list_coin() as $coinss)
                        @php
                        $c = \Request::segment(3);@endphp
                        @if(isset($c))
                        @php $selectedcoin = $c; @endphp
                        @else
                        @php $selectedcoin = 'BTC'; @endphp
                        @endif
                        <li class="@@colorsactive"><a @if($selectedcoin==$coinss->source) class="active" @endif href="{{ url('admin/withdraw/'.$coinss->source) }}">{{$coinss->source}}</a></li>
                        @empty
                        <li class="@@colorsactive"><a @if($active=="withdraw" ) class="active" @endif href="#">No Coins list</a></li>
                        @endforelse
                    </ul>
                </li>

                {{-- @if(in_array("read", explode(',',$AdminProfiledetails->adminwallet))) 
                 <li class="@@photogalleryactive"><a @if($active == "commission_wallet_history") class="active" @endif href="{{ url('admin/commission_wallet_history') }}"><i class="zmdi zmdi-balance-wallet"></i>Admin Wallet</a></li>
                @endif --}}
                @if(in_array("read", explode(',',$AdminProfiledetails->withdrawwallet)))
                <li class="@@photogalleryactive"><a @if($active == "feewallet") class="active" @endif href="{{ url('admin/feewallet/ETH/coin') }}"><i class="zmdi zmdi-balance-wallet"></i>Withdraw Wallet</a></li>
                @endif
                {{-- @if(in_array("read", explode(',',$AdminProfiledetails->kyc))) 
                <li class="@@photogalleryactive"><a @if($active == "kyc") class="active" @endif href="{{ url('admin/kyc') }}"><i class="zmdi zmdi-assignment-o"></i>KYC Submit</a></li>
                @endif
                @if(in_array("read", explode(',',$AdminProfiledetails->adminbank)))
                <li class="navigation__sub navigation__sub--toggled"><a href="#"><i class="zmdi zmdi-code" aria-hidden="true"></i>Admin Bank</a>
                    @endif --}}
                    <ul @if($active=="adminbank" ) style="display: block;" @else style="display: none;" @endif>
                        @php
                        $cmss = \Request::segment(3);
                        $Commission = \App\Models\Commission::on('mysql2')->where('type','fiat')->get();
                        @endphp
                        @foreach ($Commission as $value)
                        <li class="@@colorsactive">
                            <a @if($value->source == $cmss) class="active" @endif href="{{ url('admin/bank/'.$value->source ) }}">{{ $value->source }}</a>
                        </li>
                        @endforeach

                    </ul>
                </li>

                {{-- @if(in_array("read",explode(',',$AdminProfiledetails->countries)))
                <li class="@@photogalleryactive"><a @if($active=="Countries" ) class="active" @endif href="{{ url('admin/countrieslist') }}"><i class="zmdi zmdi-globe"></i>Countries</a></li>
                @endif --}}

                @if(in_array("read", explode(',',$AdminProfiledetails->addadmin)))
                <li class="@@photogalleryactive"><a @if($active=="subadmincontrol" ) class="active" @endif href="{{ url('admin/subadminlist') }}"><i class="zmdi zmdi-assignment-o"></i>Sub-Admin Control</a></li>
                @endif

                @if(in_array("read", explode(',',$AdminProfiledetails->refferalcommission)))
                <!-- <li class="@@photogalleryactive"><a @if(request()->segment(2) == 'aff_commission') class="active" @endif href="{{ url('admin/aff_commission') }}"><i class="fa fa-share-alt"></i>Referral Commission</a></li> -->
                @endif

                @if(in_array("read", explode(',',$AdminProfiledetails->refferalhistory)))
                <!-- <li class="@@photogalleryactive"><a @if(request()->segment(2) == 'affliatetransaction') class="active" @endif href="{{ url('admin/affliatetransaction') }}"><i class="fa fa-share-alt"></i>Referral Histroy</a></li> -->
                @endif

                <!-- @if(in_array("read", explode(',',$AdminProfiledetails->contact))) 
                 <li class="@@photogalleryactive"><a @if($active == "contact") class="active" @endif href="{{ url('/admin/contactus') }}"><i class="zmdi zmdi-account-box"></i> Contact</a></li>
                @endif -->

                @if(in_array("read", explode(',',$AdminProfiledetails->cms_settings)))
                <li class="navigation__sub navigation__sub--toggled"><a @if($active == "cmscontentedit") class="active" @endif href="#"><i class="zmdi zmdi-settings-square"></i>Page Content Setting</a>
                    @endif
                    <ul @if($active == "featurelist" || $active == "platformadvantage") style="display: block;" @else style="display: none;" @endif>

                        <li class="@@colorsactive"><a @if($active == "featurelist") class="active" @endif href="{{ url('admin/featurelist/feature') }}">Features</a></li>
                        <li class="@@colorsactive"><a @if($active == "platformadvantage") class="active" @endif href="{{ url('admin/platformadvantage/platform') }}">Platform Advantage</a></li>
                        {{-- <li class="@@colorsactive"><a @if(request()->segment(3) == "aboutus") class="active" @endif href="{{ url('admin/cmscontentedit/aboutus') }}">About us</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "tradingfee") class="active" @endif href="{{ url('admin/cmscontentedit/tradingfee') }}">Trading Fee</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "coininfo") class="active" @endif href="{{ url('admin/cmscontentedit/coininfo') }}">Coin Info</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "whatisbitcoin") class="active" @endif href="{{ url('admin/cmscontentedit/whatisbitcoin') }}">What is Bitcoin</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "security") class="active" @endif href="{{ url('admin/cmscontentedit/security') }}">Security</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "staking") class="active" @endif href="{{ url('admin/cmscontentedit/staking') }}">staking</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "refferal") class="active" @endif href="{{ url('admin/cmscontentedit/refferal') }}">Refferal</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "bubbles") class="active" @endif href="{{ url('admin/cmscontentedit/bubbles') }}">bubbles</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "terms-conditions") class="active" @endif href="{{ url('admin/cmscontentedit/terms-conditions') }}">terms-conditions</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "refundpolicy") class="active" @endif href="{{ url('admin/cmscontentedit/refundpolicy') }}">Refund policy</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "aml") class="active" @endif href="{{ url('admin/cmscontentedit/aml') }}">aml</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "kyc") class="active" @endif href="{{ url('admin/cmscontentedit/kyc') }}">kyc</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "privacy-policy") class="active" @endif href="{{ url('admin/cmscontentedit/privacy-policy') }}">privacy policy</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "cookiepolicy") class="active" @endif href="{{ url('admin/cmscontentedit/cookiepolicy') }}">Cookie policy</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "riskpolicy") class="active" @endif href="{{ url('admin/cmscontentedit/riskpolicy') }}">Risk Policy</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "faq") class="active" @endif href="{{ url('admin/cmscontentedit/faq') }}">FAQ</a></li>
                <li class="@@colorsactive"><a @if(request()->segment(3) == "tradingguide") class="active" @endif href="{{ url('admin/cmscontentedit/tradingguide') }}">tradingguide</a></li> --}}
                </ul>
                </li>

                <!-- @if(in_array("read", explode(',',$AdminProfiledetails->subscriber))) 
                 <li class="@@photogalleryactive"><a @if($active == "subscriber") class="active" @endif href="{{ url('/admin/subscriber') }}"><i class="zmdi zmdi-email-open"></i> Subscriber</a></li> 
            @endif -->

                <!-- @if(in_array("read", explode(',',$AdminProfiledetails->refferalhistory)))
                <li class="@@photogalleryactive"><a @if($active=="support" ) class="active" @endif href="{{ url('/admin/support') }}"><i class="zmdi zmdi-ticket-star"></i> Support ({{ ticketcount()}})<span class="pull-right"> </span></a></li>
                @endif -->

                @if(in_array("write", explode(',',$AdminProfiledetails->security)))
                <li class="@@photogalleryactive"><a @if($active=="settings" ) class="active" @endif href="{{ url('admin/security') }}"><i class="zmdi zmdi-shield-check" aria-hidden="true"></i>Security Settings </a></li>
                @endif
                <!--   <li class="@@photogalleryactive"><a href="{{ url('admin/adminwallet') }}"><i class="zmdi zmdi-balance-wallet zmdi-hc-fw" aria-hidden="true"></i>Admin Wallet </a></li> -->

                <li class="@@photogalleryactive"><a @if($active=="logout" ) class="active" @endif href="{{ url('logout') }}"><i class="zmdi zmdi-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </aside>

        @yield('content')

        @include('layouts.footer')
