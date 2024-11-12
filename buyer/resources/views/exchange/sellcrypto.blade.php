@php $title = "Exchange"; $atitle ="exchange"; @endphp
@include('layouts.headerlink')
<body class="reset-trans-pwd exchange-history">

    <main class="contain-width">
        <form action="{{ url('sellrequest') }}" method="POST">
            @csrf

            <section class="Authentication login">
                <div class="back-div">
                    <a href="{{url('exchange')}}"><i class="fa-solid fa-arrow-left"></i></a>
                    <h5>Exchange</h5>
                </div>
            </section>
            <section class="select-payee">
                <div class="payee-details">
                    <h5>Select payee</h5>
                    <div class="payee-history">
                        <a href="{{url('bank-history')}}">
                            <svg width="18" height="18" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.1136 0.568176H1.56818C0.836591 0.568176 0.256591 1.15477 0.256591 1.88636L0.25 9.79545C0.25 10.527 0.836591 11.1136 1.56818 11.1136H8.15909V9.79545H1.56818V5.8409H13.4318V1.88636C13.4318 1.15477 12.8452 0.568176 12.1136 0.568176ZM12.1136 3.20454H1.56818V1.88636H12.1136V3.20454ZM14.75 9.13636V10.4545H12.7727V12.4318H11.4545V10.4545H9.47727V9.13636H11.4545V7.15909H12.7727V9.13636H14.75Z" fill="black" />
                            </svg>
                        </a>
                    </div>
                </div>
                @if(isset($bank))

                <div class="add-acctn-detail accnt-history">

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="accnt-field-detail">
                                <label>AccNo</label>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="accnt-field-detail">
                                <input type="text" name="acc_no" value={{$bank->account_no ?? ''}} readonly>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="accnt-field-detail">
                                <label>IFSC</label>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="accnt-field-detail">
                                <input type="text" name="ifsc" value={{$bank->swift_code ?? ''}} readonly>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="accnt-field-detail last-line">
                                <label>AccName</label>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="accnt-field-detail last-line">
                                <input type="text" name="acc_name" value="{{$bank->account_name ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                @else

                <div class="add-bank">
                    <a href="{{url('add-bank')}}">
                        Add bank account
                    </a>
                </div>
                @endif

                <div class="sell-amt-box">
                    <p>Sell amount</p>
                    <div class="amnt-detail">
                        <input type="text" id="amount" name="amount" placeholder="Please enter the amount" class="sell-amt">
                        <p>USDT</p>
                    </div>

                    <input type="hidden" id="categoryType" name="category" value="">

                    <div class="amnt-detail">
                        <div class="avaible-acctn">
                            <label>Available: </label>
                            <label>{{$wallet->balance ?? 0}} </label>
                        </div>
                        <span>1USDT=₹ {{$coin->liveprice}}</span>
                    </div>
                    <div class="sell-table">
                        <p>Select category</p>
                        <table class="table table-bordered">
                            @forelse($category as $data)
                            <tbody>
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        <label id="changeButton" class="btn btn-success"  onclick="setCategoryType('{{ $data->type }}')">
                                            {{$data->price}}+ <span class="red-text"></span>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                            @empty
                            <tbody>
                                <tr>
                                    <td colspan="2">No categories available.</td>
                                </tr>
                            </tbody>
                            @endforelse
                        </table>
                    </div>
                </div>
                <div class="sell-btn">
                    <label>Confirm</label>
                </div>
                <div class="confirm-area">
                    <label>In order to get your funds back better, faster and more
                        conveniently, your exchange order may be split into
                        multiple parts</label>
                </div>

            </section>

            <div class="set-password-box confrm-trans-box">
                <div class="transaction-head">
                    <div class="mobile-tab-buy-sell-close-btn"><i class="fa-solid fa-xmark"></i></div>
                    <h3>Confirm transaction password</h3>
                    <p>Exchange for</p>
                    <h6><strong>10 ~ ₹ {{$coin->liveprice}} </strong></h6>
                </div>

                <div class="otp-container">
                    <input type="hidden" name="password" id="verificationcode" />
                    <input type="text" id="otp-1" class="otps otp-input" maxlength="1" />
                    <input type="text" id="otp-2" class="otps otp-input" maxlength="1" />
                    <input type="text" id="otp-3" class="otps otp-input" maxlength="1" />
                    <input type="text" id="otp-4" class="otps otp-input" maxlength="1" />
                    <input type="text" id="otp-5" class="otps otp-input" maxlength="1" />
                    <input type="text" id="otp-6" class="otps otp-input" maxlength="1" />
                </div>

                <div class="keypad">
                    <button type="submit">Confirm</button>
                </div>
            </div>

        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function setCategoryType(type) {
            document.getElementById('categoryType').value = type;
        }

    </script>

    <script>
        $(document).ready(function() {
            $(".otps").on('input', function() {
                let otpverifys = "";
                $(".otps").each(function() {
                    otpverifys += $(this).val();
                });
                $("#verificationcode").val(otpverifys)
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            $("#amount").on("input", function() {
                var livePrice = $("#liveprice-display").text();
                $("h6 strong").text($(this).val() + " ~ ₹ " + livePrice);
            });
        });

    </script>

    <!-- dark-light -->

    <script>
        const checkbox = document.getElementById("checkbox");
        document.addEventListener("DOMContentLoaded", function() {
            const body = document.body;
            const isDarkMode = localStorage.getItem("darkMode") === "true";
            if (isDarkMode) {
                document.body.classList.add("dark")
                checkbox.checked = true;
            }

            checkbox.addEventListener("change", () => {
                document.body.classList.toggle("dark")
                localStorage.setItem("darkMode", checkbox.checked);
                if (checkbox.checked === true) {
                    update_mode("dark");
                } else {
                    update_mode("light");
                }
            });


        });

        function update_mode(mode) {
            $.ajax({
                url: "" + mode
                , type: "GET"
                , async: true
                , cache: false
            });
        }

    </script>
    <script>
        // jQuery script for show/hide functionality
        $(document).ready(function() {
            // Show password box when Sell USDT button is clicked
            $('.sell-btn').click(function() {
                $('.set-password-box').toggleClass('showbox');
                $('main').toggleClass('blur');
            });

            // Close password box when close button is clicked
            $('.mobile-tab-buy-sell-close-btn').click(function() {
                $('.set-password-box').removeClass('showbox');
                $('main').removeClass('blur');
            });
        });

    </script>
    <script>
        function pressKey(value) {
            const inputs = document.querySelectorAll('.otp-input');

            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].value === '') {
                    inputs[i].value = value;
                    if (i < inputs.length - 1) {
                        inputs[i + 1].focus();
                    }
                    break;
                }
            }
        }

        function deleteLast() {
            const inputs = document.querySelectorAll('.otp-input');

            for (let i = inputs.length - 1; i >= 0; i--) {
                if (inputs[i].value !== '') {
                    inputs[i].value = '';
                    if (i > 0) {
                        inputs[i - 1].focus();
                    }
                    break;
                }
            }
        }

        // Optional: Handle input focus for automatic key input
        document.querySelectorAll('.otp-input').forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1 && index < 5) {
                    document.querySelectorAll('.otp-input')[index + 1].focus();
                }
            });
        });

    </script>

    <script>
        $('.key-btn').click(function(e) {
            e.preventDefault()
        })

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script>
        // Set Toastr options
        toastr.options = {
            "positionClass": "toast-top-right"
            , "closeButton": true
            , "timeOut": 3000
            , "showMethod": "fadeIn"
        , };

        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}');
        @endforeach
        @endif

        @if(session('error'))
        toastr.error('{{ session('
            error ')}}');
        @endif

        @if(session('success'))
        toastr.success('{{ session('
            success ') }}');
        @endif

        @if(session('status'))
        toastr.success('{{ session('
            status ') }}');
        @endif

    </script>
</body>

</html>
