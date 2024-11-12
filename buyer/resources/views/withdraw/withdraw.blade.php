@php $title = "Seller Support";
$atitle = "withdraw"; @endphp
@include('layouts.headerlink')
<body class="withdraw-full">
    <main class="contain-width">

        @include('layouts.header')
        @include('layouts.sidebar')

        <section class="withdraw-head">
            <div class="withdraw-direct">

                <div class="withdraw-title">
                    <h6>Withdraw USDT</h6>
                </div>

            </div>
        </section>
        <section class="select-address">
            <div class="withdraw-direct">
                <h6>Select address</h6>
                <div class="support-add">
                
                        <a href="{{url('walletlist')}}">
                        <div class="support-link">
                            <svg width="18" height="18" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.1136 0.568176H1.56818C0.836591 0.568176 0.256591 1.15477 0.256591 1.88636L0.25 9.79545C0.25 10.527 0.836591 11.1136 1.56818 11.1136H8.15909V9.79545H1.56818V5.8409H13.4318V1.88636C13.4318 1.15477 12.8452 0.568176 12.1136 0.568176ZM12.1136 3.20454H1.56818V1.88636H12.1136V3.20454ZM14.75 9.13636V10.4545H12.7727V12.4318H11.4545V10.4545H9.47727V9.13636H11.4545V7.15909H12.7727V9.13636H14.75Z" fill="white" />
                            </svg>
                            </div>
                        </a>
                 
                    
                        <a href="{{url('exchange-history-withdraw')}}">
                        <div class="support-link">
                            <svg width="18" height="18" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.71956 3.63291H2.3529C2.04236 3.63291 1.79102 3.38097 1.79102 3.07103V1.69953C1.79102 1.43248 2.00731 1.21619 2.27436 1.21619C2.54142 1.21619 2.75771 1.43248 2.75771 1.69953V2.63541L3.72984 2.65595C3.99569 2.662 4.20774 2.8789 4.20774 3.14412C4.20774 3.41359 3.98902 3.63291 3.71895 3.63291L3.71956 3.63291Z" fill="white" />
                                <path d="M7.5005 11.8498C5.10187 11.8498 3.15039 9.89827 3.15039 7.49964C3.15039 5.10101 5.10187 3.14954 7.5005 3.14954C9.89913 3.14954 11.8506 5.10101 11.8506 7.49964C11.8506 9.89827 9.89913 11.8498 7.5005 11.8498ZM7.5005 4.11623C5.63533 4.11623 4.11708 5.63453 4.11708 7.49964C4.11708 9.36475 5.63539 10.8831 7.5005 10.8831C9.36561 10.8831 10.8839 9.36475 10.8839 7.49964C10.8839 5.63453 9.36561 4.11623 7.5005 4.11623Z" fill="white" />
                                <path d="M6.42322 14.6719C2.99989 14.1764 0.374208 11.2153 0.254493 7.75888C0.226097 6.939 0.332433 6.13422 0.569881 5.36272C0.653863 5.08903 0.946288 4.93858 1.21272 5.04251C1.4544 5.13736 1.56919 5.4032 1.49246 5.65092C1.29611 6.28833 1.20366 6.95293 1.21756 7.63085C1.27919 10.6584 3.56051 13.2751 6.55725 13.7137C10.5708 14.3004 14.011 11.0631 13.7712 7.10946C13.5852 4.04203 11.1244 1.50513 8.06297 1.24049C6.17073 1.07675 4.36542 1.74136 3.04577 3.06699L2.36063 2.38548C3.88377 0.855095 5.96816 0.0889349 8.15164 0.278097C11.5163 0.569311 14.2877 3.24468 14.695 6.5967C15.2738 11.3588 11.2022 15.3634 6.42258 14.6722L6.42322 14.6719Z" fill="white" />
                                <path d="M7.93556 8.70684L7.3042 8.00478C7.11932 7.79876 7.0166 7.5317 7.0166 7.25438V6.13422C7.0166 5.86717 7.23289 5.65088 7.49995 5.65088C7.767 5.65088 7.98329 5.86717 7.98329 6.13422V7.31298L8.65393 8.05915C8.83215 8.25793 8.81646 8.56303 8.61768 8.74188C8.41889 8.92071 8.11379 8.9044 7.93495 8.70623L7.93556 8.70684Z" fill="white" />
                            </svg>
                            </div>
                        </a>
                    
                </div>
            </div>

            <div class="currency-box">
                <p>Currency</p>
                <div class="currency-tab">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                <img src="{{url('image/exchange/eth.svg')}}">
                                USDT</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <form action="{{url('verifywithdraw')}}" method="post">
                            @csrf
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="tab-part-full">
                                    <div class="wallet-address-detail">
                                        <div class="address-box">
                                            @if($address)
                                            {{$address->address}}
                                            <input type="hidden" name="address" value="{{$address->address}}">
                                            @else
                                            <a href="{{url('add-address')}}"><i class="fa-solid fa-plus"></i>&nbsp Add wallet
                                                address </a>
                                            <input type="hidden" name="address" value="">
                                            @endif
                                        </div>
                                        <input type="hidden" name="coin" value="USDT">
                                    </div>
                                    <div class="amount-type">
                                        <div class="amount-input">
                                            <label>Withdraw amount</label>
                                            <input type="text" name="amount" placeholder="0">
                                        </div>
                                        <div class="currency-type">
                                            <div class="currency-coin">
                                                <img src="{{url('image/exchange/eth.svg')}}">
                                            </div>
                                            <div class="currency-coin">
                                                <span>USDT</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="refund-fee">
                                        <div class="availble-balance">
                                            <label>Available($) </label>
                                            <div class="input-box-coin">
                                                <img src="{{url('image/exchange/eth.svg')}}">
                                                <input type="text" value="{{$userwallet->balance ?? 0}}">
                                            </div>
                                        </div>
                                        <div class="fee-refund">
                                            <p>Refund fee : <span>1 USDT</span></p>
                                        </div>
                                    </div>
                                    <div class="confm-btn">
                                        <button type="submit">Confirm</button>
                                        <div class="safety-note">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            <p>For the safety of your funds, please note that the
                                                recharge address for each order is different. Please
                                                double-check carefully to avoid the risk of
                                                irretrievable funds</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="tab-part-full">
                                <div class="wallet-address-detail">
                                    <div class="address-box">
                                        <a href="{{url('wallet-address')}}"><i class="fa-solid fa-plus"></i> &nbsp Add wallet
                                            address</a>
                                    </div>
                                </div>
                                <div class="amount-type">
                                    <div class="amount-input">
                                        <label>Withdraw amount</label>
                                        <input type="text" value="0">
                                    </div>
                                    <div class="currency-type">
                                        <div class="currency-coin">
                                            <img src="{{url('image/exchange/logo-fav.svg')}}">
                                        </div>
                                        <div class="currency-coin">
                                            <span>Wolfx</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="refund-fee">
                                    <div class="availble-balance">
                                        <label>Available($) </label>
                                        <div class="input-box-coin">
                                            <img src="{{url('image/exchange/logo-fav.svg')}}">
                                            <input type="text" value="000">
                                        </div>
                                    </div>
                                    <div class="fee-refund">
                                        <p>Refund fee : <span>1 USDT</span></p>
                                    </div>
                                </div>

                                <div class="confm-btn">
                                    <button>Confirm</button>
                                    <div class="safety-note">
                                        <i class="fa-solid fa-circle-exclamation"></i>
                                        <p>For the safety of your funds, please note that the
                                            recharge address for each order is different. Please
                                            double-check carefully to avoid the risk of
                                            irretrievable funds</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footerlink')
</body>
</html>
