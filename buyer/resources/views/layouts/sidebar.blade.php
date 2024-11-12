<?php
if(isset($atitle)){ 
    switch($atitle){
      case 'exchange':
      $active = "exchange";
      break;
      case 'withdraw':
      $active = "withdraw";
      break;
      case 'history':
      $active = "history";
      break;
      case 'profile':
      $active = "profile";
      break;
    }
}else{
	$active = "";
}
?>
<div id="mySidenav" class="sidenav sidemenu">
    <div class="sidenav-top">
        <div class="wolfx-logo">
            <img src="{{url('image/light-logo1.png')}}" class="light-logo img-fluid" alt="light-logo">
            <img src="{{url('image/dark-logo1.png')}}" class="dark-logo img-fluid" alt="dark-logo">
        </div>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>

    </div>
    <div class="home-svg @if($active=='exchange' ) active @endif">
        <a href=" {{url('exchange')}}">Exchange</a>
    </div>
    <div class="home-svg @if($active=='history') active @endif">
        <a href="{{url('exchange-history')}}">Order History</a>
    </div>
    <div class="home-svg @if($active=='withdraw') active @endif">
        <a href="{{url('withdraw')}}">Withdraw</a>
    </div>

    <div class="home-svg @if($active=='deposit') active @endif">
        <a href="{{url('deposit')}}">Deposit</a>
    </div>

    <!-- <a href="#">Profile</a> -->
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

</script>
