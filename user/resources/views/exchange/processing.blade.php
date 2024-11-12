@php $title = "history"; $atitle ="history"; @endphp
@include('layouts.headerlink')
<body class="pending-status-page seller-support-page">
    <main class="contain-width p-0">
        @include('layouts.header')
        <section class="withdraw-head">
            <div class="withdraw-direct">
                <div class="prev-page">
                    <a href="{{url('/exchange-history')}}"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <div class="withdraw-title">
                    <h6>Payment Processing...</h6>
                </div>
                <div>
                    <!-- <a href="" target="_blank"><i class="fa-regular fa-bell"></i></a> -->
                </div>
            </div>
        </section>

        <section class="pending-status">
            <div class="history-detail">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a href="{{url('processing')}}"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Processing</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history')}}"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Purchase</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-deposit')}}"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Deposit</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-withdraw')}}"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Withdraw</button></a>
                    </li>
                </ul>
            </div>

            <!-- <div class="refresh-btn text-end" id="refreshButton">
                <i class="fa-solid fa-rotate-right"></i>
            </div> -->

            <div class="sell-support-blocks">

                <div id="pending-list">

                    @forelse($pending as $data)
                    @if($data->status == 1)
                    <div class="seller-details network-box deposit-value" data-transfer-id="{{ $data->transferId }}" onclick="redirectToPayment(this)">
                        @else
                        <div class="seller-details network-box deposit-value">
                            @endif


                            @if($data->status == 1)
                            <span>Processing</span>
                            @elseif($data->status == 4)
                            <span>Completed</span>
                            @elseif($data->seller_remark == "Accept")
                            <span>Completed</span>
                            @elseif($data->seller_remark == "Deny")
                            <span>Waiting For Admin Approval</span>
                            @endif


                            <div class="d-flex1">
                                <h3 class="seller-name">Buyer name</h3>
                                <h3 class="seller-name">{{ $data->buyername }}</h3>
                            </div>

                            <div class="d-flex1">
                                <p>Account Name</p>
                                <p>{{ $data->account_name }}</p>
                            </div>

                            <div class="d-flex1">
                                <p>Ifsc</p>
                                <p>{{ $data->ifsc }}</p>
                            </div>

                            <div class="d-flex1">
                                <p>Account Number</p>
                                <p>{{ $data->account_number }}</p>
                            </div>

                            <div class="d-flex1">
                                <p>Qty</p>
                                <p>{{ $data->qty }}</p>
                            </div>

                            <div class="d-flex1">
                                <p>Matched At</p>
                                <p>{{ $data->created_at }}</p>
                            </div>

                            <div class="d-flex1">
                                <p>My Status</p>
                                @if($data->seller_remark != null)
                                <p>{{ $data->seller_remark }}</p>
                                @else
                                <button class="btn btn-success">To Confirm</button>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="no-record">
                            <img src="{{('image/no-record.png')}}">
                        </div>
                        @endforelse
                    </div>
                </div>
        </section>

    </main>
    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchPendingData() {
            $.ajax({
                url: '{{ url("processingUpdate") }}'
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
                            '<div class="seller-details network-box deposit-value" ' +
                            (item.status == 1 ? 'data-transfer-id="' + item.transferId + '" onclick="redirectToPayment(this)"' : '') +
                            '>' +
                            statusText +
                            '<div class="d-flex1">' +
                            '<h3 class="seller-name">Buyer name</h3>' +
                            '<h3 class="seller-name">' + item.buyername + '</h3>' +
                            '</div>' +

                            '<div class="d-flex1">' +
                            '<p>Account Name</p>' +
                            '<p>' + item.account_name + '</p>' +
                            '</div>' +

                            '<div class="d-flex1">' +
                            '<p>Ifsc</p>' +
                            '<p>' + item.ifsc + '</p>' +
                            '</div>' +

                            '<div class="d-flex1">' +
                            '<p>Account Number</p>' +
                            '<p>' + item.account_number + '</p>' +
                            '</div>' +

                            '<div class="d-flex1">' +
                            '<p>Qty</p>' +
                            '<p>' + item.qty + '</p>' +
                            '</div>' +

                            '<div class="d-flex1">' +
                            '<p>Matched At</p>' +
                            '<p>' + item.created_at + '</p>' +
                            '</div>' +

                            '<div class="d-flex1">' +
                            '<p>My Status</p>' +
                            (item.seller_remark != null ? '<p>' + item.seller_remark + '</p>' : '<button class="btn btn-success">To Confirm</button>') +
                            '</div>' +
                            '</div>'
                        );
                    });
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
