@php $title = "Withdraw"; $atitle ="history"; @endphp
@include('layouts.headerlink')

<body class="history-full">
    <main class="contain-width">
    @include('layouts.header')
        <section class="withdraw-head">
            <div class="withdraw-direct">
                <div class="prev-page">
                    <a href="{{url('/profile')}}"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <div class="withdraw-title">
                    <h6>Deposit Transactions</h6>
                </div>
                <div></div>

                <!-- <div class="support-link">
                    <a href="{{url('/support')}}" target="_blank"><i class="fa-solid fa-headset"></i></a>
                </div> -->
            </div>
        </section>

        <section class="history-tab">
            <div class="history-detail">
            <!-- <div class="refresh-btn text-end" id="refreshButton">
                    <i class="fa-solid fa-rotate-right"></i>
                </div> -->
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a href="{{url('processing')}}"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Processing</button></a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history')}}"><button class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="true">Purchase</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-deposit')}}"><button class="nav-link active" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">Deposit</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-withdraw')}}"><button class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">Withdraw</button></a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div class="withdraw-full-detail">
                            @if(count($all_history) > 0)
                            @foreach($all_history as $allhistory)
                            <div class="detail-box">

                                <div class="amnt-detail-direct">
                                    <div class="history-status @if($allhistory->txtype == 'deposit') deposit @endif">
                                        <span>{{$allhistory->txtype}}</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <img src="{{url('images/color/'.@$allhistory->coinNames->image)}}">
                                        </div>
                                        <div class="value-coin">
                                            <Span>{{$allhistory->currency}}</Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Amount</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>
                                                {{$allhistory->amount}}
                                            </Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Address</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{$allhistory->to_addr}}</Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Transaction ID</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{$allhistory->txid}}</Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Date</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{date('Y-m-d H:i:s',strtotime($allhistory->created_at))}}</Span>
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
    @include('layouts.footer')
    @include('layouts.footerlink')
</body>
</html>