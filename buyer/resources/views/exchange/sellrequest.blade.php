@php $title = "exchange"; $atitle ="exchange"; @endphp
@include('layouts.headerlink')
<body class="seller-support-page">
    <main class="contain-width p-0">
        @include('layouts.header')
        @include('layouts.sidebar')
        <section class="seller-support exchange-head">
            <h1 class="text-center">Exchange</h1>
            <!-- <div class="refresh-btn text-end" id="refreshButton">
                    <i class="fa-solid fa-rotate-right"></i>
                </div> -->
            @forelse($request as $data)
            <div class="sell-support-blocks">

                <div class="seller-support-block network-box deposit-value">

                    <div class="seller-support-right">
                        <a class="take-it-btn" data-bs-toggle="modal" data-id="{{ $data->id }}" data-name="{{ $data->account_name }}" data-price="{{ $price }}" data-qty="{{ $data->qty }}" data-value="{{ $data->value }}" onclick="setSellerDetails(this)" href="#exampleModalToggle" role="button">Take it</a>
                    </div>

                    <div class="seller-support-left seller-details">
                        <div class="d-flex1">
                            <h3 class="seller-name">Seller Name</h3>
                            <h3 class="seller-name">{{$data->sellername}}</h3>
                        </div>
                        <div class="d-flex1">
                            <p>Price</p>
                            <p>{{$price}}</p>
                        </div>
                        <div class="d-flex1">
                            <p>Value</p>
                            <p>{{ $data->value  }} INR</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="no-record">
                <img src="{{('image/no-record.png')}}">
            </div>
            @endforelse
        </section>

        <!-- @include('layouts.footer') -->

    </main>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered take-it-popup">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="seller-details">
                        <div class="d-flex1">
                            <h3 class="seller-name">Account Name</h3>
                            <h3 class="seller-name" id="modalSellerName"></h3>
                        </div>
                        <div class="d-flex1">
                            <p>Price</p>
                            <p id="modalPrice"></p>
                        </div>
                        <div class="d-flex1">
                            <p>Value</p>
                            <p id="modalValue"></p>
                        </div>
                    </div>
                </div>

                <form action="{{ url('matchseller') }}" method="POST">
                    @csrf
                    <input type="hidden" id="sellerId" name="id" value="" />
                    <div class="modal-footer">
                        <button type="submit" class="take-it-btn">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
@include('layouts.footerlink')
</html>
