@php $title = "Withdraw"; $atitle ="history"; @endphp
@include('layouts.headerlink')

<body class="history-full">
    <main class="contain-width">
        @include('layouts.header')
        <section class="withdraw-head">
            <div class="withdraw-direct">
                <div class="prev-page">
                    <a href="{{url('/exchange')}}"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <div class="withdraw-title">
                    <h6>History</h6>
                </div>
                <div></div>
                <!-- <div class="support-link">
                    <a href="" target="_blank"><i class="fa-regular fa-bell"></i></a>
                </div> -->
            </div>
        </section>

        <section class="history-tab">
            <div class="history-detail">
                {{-- <div class="refresh-btn text-end" id="refreshButton">
                    <i class="fa-solid fa-rotate-right"></i>
                </div> --}}
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a href="{{url('processing')}}"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Processing</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history')}}"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Purchase</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-deposit')}}"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Deposit</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-withdraw')}}"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Withdraw</button></a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                        <div id="pending-list" class="withdraw-full-detail">

                            @if(count($purchaseHistory) > 0)
                            @foreach($purchaseHistory as $purchase)
                            <div class="detail-box">

                                <div class="amnt-detail-direct">
                                    <div class="history-status deposit">
                                        <span>{{$purchase->remark}}</span>
                                    </div>
                                </div>

                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Qty</span>
                                    </div>

                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{$purchase->qty}}</Span>
                                        </div>
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
                                        <span>price</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>
                                                {{$purchase->price}}
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
    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchPendingData() {
            $.ajax({
                url: '{{ url("exchange-historyUpdate") }}'
                , type: 'GET'
                , success: function(data) {
                    $('#pending-list').empty();

                    $.each(data, function(index, item) {
                        let statusText = '';

                        if (item.status == 1) {
                            statusText = '<span>Processing</span>';
                        } else if (item.status == 4 || item.seller_remark == "Accept") {
                            statusText = '<span>Completed</span>';
                        } else if (item.seller_remark == "Deny") {
                            statusText = '<span>Waiting For Admin Approval</span>';
                        }
                        $('#pending-list').append(
                            '<div class="detail-box">' +
                            '<div class="amnt-detail-direct">' +
                            '<div class="history-status deposit">' +
                            '<span>' + statusText + '</span>' +
                            '</div>' +
                            '</div>' +

                            '<div class="amnt-detail-direct">' +
                            '<div class="withdraw-status">' +
                            '<span>Qty</span>' +
                            '</div>' +
                            '<div class="withdraw-value">' +
                            '<div class="value-coin">' +
                            '<span>' + item.qty + '</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +

                            '<div class="amnt-detail-direct">' +
                            '<div class="withdraw-status">' +
                            '<span>Value</span>' +
                            '</div>' +
                            '<div class="withdraw-value">' +
                            '<div class="value-coin">' +
                            '<span>' + item.value + '</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +

                            '<div class="amnt-detail-direct">' +
                            '<div class="withdraw-status">' +
                            '<span>Price</span>' +
                            '</div>' +
                            '<div class="withdraw-value">' +
                            '<div class="value-coin">' +
                            '<span>' + item.price + '</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +

                            '<div class="amnt-detail-direct">' +
                            '<div class="withdraw-status">' +
                            '<span>Date</span>' +
                            '</div>' +
                            '<div class="withdraw-value">' +
                            '<div class="value-coin">' +
                            '<span>' + new Date(item.created_at).toLocaleString() + '</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    });
                    if (data.length === 0) {
                        $('#pending-list').append(
                            '<div class="no-record">' +
                            '<img src="{{ asset("image/no-record.png") }}">' +
                            '</div>'
                        );
                    }
                }
                , error: function(xhr, status, error) {
                    console.error('Error updating pending list:', error);
                }
            });
        }
        setInterval(fetchPendingData, 10000);

    </script>

    @include('layouts.footerlink')
</body>
</html>
