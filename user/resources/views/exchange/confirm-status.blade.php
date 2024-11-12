@php $title = "Seller Support";
$atitle = "seler support"; @endphp
@include('layouts.headerlink')

<body class="take-it-page confirm-page">

    <main class="contain-width p-0">
        @include('layouts.header')
        <section class="take-it">

            <div class="back-div support-back">
                <a href="{{url('/processing')}}"><img src="{{ url('image/previous-arrow.svg') }}"
                        alt="previous-arrow"></a>
                <div class="withdraw-title">
                    <h6>Payment Processing...</h6>
                </div>
            </div>

            <div class="withdraw-title" style="text-align: center;">
                <h6>Slip Uploader By Buyer</h6>
            </div>


            <div class="upload-screen-shot">
                <label>
                    <img id="img-preview" onload="showToast()" src="{{ url('image/buyerimg/'.$data->slip) }}" />
                </label>
            </div>
            <div class="acc-details-card seller-details" id="card-to-copy">
                <div class="acc-details-card-content">
                    <div class="d-flex1">
                        <p>Account Name</p>
                        <p>{{$data->account_name}}</p>
                    </div>
                    <div class="d-flex1">
                        <p>Ifsc</p>
                        <p>{{$data->ifsc}}</p>
                    </div>
                    <div class="d-flex1">
                        <p>Account Number</p>
                        <p>{{$data->account_number}}</p>
                    </div>
                    <div class="d-flex1">
                        <p>Value</p>
                        <p>{{$data->value}} INR</p>
                    </div>
                </div>
            </div>

            <form id="paymentForm" method="POST" action="{{ url('completePayment') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <input type="hidden" name="status" id="statusInput" value="">
                <div class="submit-btn">
                    <button type="button" class="take-it-btn"
                        onclick="setStatusAndShowModal('Accept', 'exampleModal')">Confirm</button>
                    <button type="button" class="take-it-btn"
                        onclick="setStatusAndShowModal('deny', 'exampleModal2')">Deny</button>
                </div>
            </form>
        </section>
    </main>

    @include('layouts.footerlink')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function setStatusAndShowModal(status, modalId) {
            document.getElementById('statusInput').value = status;
            var confirmModal = new bootstrap.Modal(document.getElementById(modalId));
            confirmModal.show();
        }
        document.querySelectorAll('.confirmButton').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('paymentForm').submit();
            });
        });
        window.setStatusAndShowModal = setStatusAndShowModal;
    });
    </script>

</body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog confirm-deny-popup">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body confirm-deny-payment">
                Please confirm that you have received the correct amount credited to your bank account before
                proceeding.
                <br><br>
                <strong>Amount to be credited:</strong> {{ $data->value }}
                <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="take-it-btn confirmButton" data-bs-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog confirm-deny-popup modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Confirm Denial</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body confirm-deny-payment">
                <p>
                    Are you sure you want to deny this request?

                    Upon denial, this request will be escalated to the admin for further review. The admin will verify
                    whether the denial is legitimate or fraudulent.
                </p>

             <p>
             <strong>The admin may choose to:</strong><br>
                - Cancel the order if the denial is justified.<br>
                - Release the funds to the buyer if the denial is found to be unjustified.
   </p>  
   <p> Please confirm if you want to proceed with the denial.</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="take-it-btn confirmButton" data-bs-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>

</html>