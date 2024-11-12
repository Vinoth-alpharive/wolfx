@php $title = "Seller Support";
$atitle = "history"; @endphp
@include('layouts.headerlink')

<body class="history-full">
    <main class="contain-width">

        @include('layouts.header')
        @include('layouts.sidebar')

        <section class="withdraw-head">
            <div class="withdraw-direct">

                <div class="withdraw-title">
                    <h6>Purchase History</h6>
                </div>

            </div>
        </section>

        <section class="history-tab">
            <div class="history-detail">
                <!-- <div class="refresh-btn text-end" id="refreshButton">
                    <i class="fa-solid fa-rotate-right"></i>
                </div> -->
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history')}}"><button class="nav-link active" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Purchase</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-deposit')}}"><button class="nav-link" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Deposit</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-withdraw')}}"><button class="nav-link" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Withdraw</button></a>
                    </li>
                </ul>



                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                        <div class="withdraw-full-detail">

                            @if(count($purchaseHistory) > 0)
                            @foreach($purchaseHistory as $purchase)
                            <div class="detail-box">

                                <div class="amnt-detail-direct">
                                    <div class="history-status deposit ">
                                        <span>{{$purchase->remark}}</span>
                                    </div>
                                </div>

                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Value</span>
                                    </div>

                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{$purchase->value}}</Span>
                                        </div>
                                    </div>
                                </div>

                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Status</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>
                                                @if($purchase->status == 3)
                                                Waiting for Admin Approve
                                                @elseif($purchase->status == 1)
                                                Waiting for Seller Approve
                                                @elseif($purchase->status == 4)
                                                Completed
                                                @elseif($purchase->status == 5)
                                                Admin Cancelled
                                                @else
                                                <a href={{url('payment',['code'=> $purchase->transferId])}}>Upload
                                                    Slip</a>
                                                @endif
                                            </Span>
                                        </div>
                                    </div>
                                </div>

                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Price</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>
                                                {{ Auth::user()->price}}
                                            </Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Date</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{date('Y-m-d H:i:s',strtotime($purchase->created_at))}}</Span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="no-record">
                                <img src="{{('image/no-record.png')}}">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footerlink')
</body>

</html>