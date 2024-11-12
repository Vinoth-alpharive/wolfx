@php $title = "Seller Support";
$atitle = "exchange"; @endphp
@include('layouts.headerlink')

<body class="take-it-page">

    <main class="contain-width p-0">
        @include('layouts.header')
        @include('layouts.sidebar')

        <section class="take-it">
            <div class="back-div support-back">
                <a href="{{url('/exchange-history')}}"><img src="{{ url('image/previous-arrow.svg') }}" alt="previous-arrow"></a>
                <div class="withdraw-title">
                    <h6 class="mb-2 mt-5"> Uploader By Buyer</h6>
                    <p class="mb-5">
                        Important: Please upload your payment slip within 15 minutes to avoid cancellation of your order.
                    </p>

                </div>
            </div>

            <form method="POST" id="paymentForm" action="{{url('slipupload')}}" enctype="multipart/form-data">
                <input type="hidden" name="id" value={{$data->id}}>
                @csrf
                <div class="acc-details-card network-box deposit-value seller-details" id="card-to-copy">
                    <div class="acc-details-card-content">

                        <div class="d-flex1">
                            <p>Account Name</p>
                            <p>{{$data->account_name ?? ''}}</p>
                        </div>
                        <div class="d-flex1">
                            <p>Account Number</p>
                            <p>{{$data->account_number ?? ''}}</p>
                        </div>
                        <div class="d-flex1">
                            <p>IFSC</p>
                            <p>{{$data->ifsc ?? ''}}</p>
                        </div>
                        <div class="d-flex1">
                            <p>Value</p>
                            <p>{{$data->value ?? ''}}</p>
                        </div>
                    </div>

                    {{-- <div class="copy-icon" onclick="copyToClipboard()">
                    <i class="fa-regular fa-copy"></i>
                </div> --}}
                </div>

                {{-- <div class="seller-payment-option">
                <select>
                    <option value="google-pay">Google Pay</option>
                    <option value="paytm">Paytm</option>
                    <option value="phonepe">Phonepe</option>
                </select>
             </div> --}}

                <input type="text" class="transaction-id" required name="transactionId" placeholder="Transaction Id">
                <div id="upload-container">
                    <div class="upload-screen-shot">
                        <label for="file-input">
                            <input id="file-input" name="slip" type="file" />
                            <img id="img-preview" onload="showToast()" src="{{ url('image/upload-imgs.png') }}" />
                        </label>
                    </div>
                </div>

                <div class="submit-btn">
                    <button id="add-upload-section" class="take-it-btn" type="button">Add More</button>
                    <button class="take-it-btn" type="button" data-bs-toggle="modal" href="#exampleModalToggle">Submit</button>
                </div>


            </form>
        </section>
    </main>
    @include('layouts.footerlink')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('confirmButton').addEventListener('click', function() {
                document.getElementById('paymentForm').submit();
            });
        });

    </script>

</body>

</html>

<div class="confirm-popup-modal">
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit?
                </div>
                <div class="modal-footer">
                    <button class="take-it-btn" data-bs-target="" id="confirmButton" data-bs-toggle="modal" data-bs-dismiss="modal">Confirm</button>
                    {{-- <button class="take-it-btn cancel-btn" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Cancel</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
