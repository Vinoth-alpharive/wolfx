
@include('layouts.headerlink')

<body class="history-full">




    <main class="contain-width">

        <section class="withdraw-head">
            <div class="withdraw-direct">
                <div class="prev-page">
                    <a href="{{url('/profile')}}"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <div class="withdraw-title">
                    <h6>Bank Account</h6>
                </div>
                <div class="support-link">
                <a href="{{url('/support')}}" target="_blank"><i class="fa-solid fa-headset"></i></a>
                </div>
            </div>
        </section>


        <section class="history-tab">
            <div class="history-detail">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{url('bank-account')}}"><button class="nav-link active" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Bank Payment</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('bank-account-upi')}}"><button class="nav-link"  data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">UPI</button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-withdraw')}}"><button class="nav-link" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Withdraw</button></a>
                    </li> --}}
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                        <div class="withdraw-full-detail">
                            @if(count($bank_details) > 0)
                                @foreach($bank_details as $bank_detail)
                            <div class="detail-box">
                                
                                {{-- <div class="amnt-detail-direct">
                                    <div class="history-status @if($allhistory->type == 'deposit') deposit @endif">
                                        <span>{{$allhistory->type}}</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <img src="{{url('images/color/'.@$allhistory->coinNames->image)}}">
                                        </div>
                                        <div class="value-coin">
                                            <Span>{{$allhistory->coin}}</Span>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Bank Name</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>
                                                {{$bank_detail->bank_name}} 
                                            </Span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Account Number</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{$bank_detail->account_no}}</Span>
                                        </div>
                                    </div>
                                </div>

                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Account Type</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{$bank_detail->accounttype}}</Span>
                                        </div>
                                    </div>
                                </div>

                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Ifsc Code</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{($bank_detail->swift_code)}}</Span>
                                        </div>
                                    </div>
                                </div>

                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Action</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            {{-- <Span>{{date('Y-m-d H:i:s',strtotime($allhistory->created_at))}}</Span> --}}
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
                    {{-- <div class="tab-pane fade" id="pills-profile" role="tabpanel">

                    <div class="withdraw-full-detail">
                            <div class="detail-box">
                                <div class="amnt-detail-direct">
                                    <div class="history-status">
                                        <span>Withdrew</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <img src="{{url('image/exchange/eth.svg')}}">
                                        </div>
                                        <div class="value-coin">
                                            <Span>USDT</Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Amount</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>1,641.20 BTC</Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Address</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>3DkQyAdif6kQLPMBu</Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Transaction ID</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>3DkQyAdif6kQLPMBu</Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Date</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>2021-06-05 04:12:30</Span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="no-record">
                            <img src="{{('image/no-record.png')}}">
                           </div>
                        </div>
                    </div> --}}
                   
                </div>
            </div>
        </section>




    </main>









    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper(".slide-content", {
        slidesPerView: 2,
        spaceBetween: 10,
        loop: true,
        autoplay: true,
        centerSlide: "true",
        fade: "true",
        grabCursor: "true",
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            0: {
                slidesPerView: 2,
            },
            520: {
                slidesPerView: 2,
            },
            950: {
                slidesPerView: 3,
            },
        },
    });
    </script>
  <script>
    
    document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("checkbox");
            const body = document.body;

            // Retrieve mode from localStorage, default to dark mode
            let isDarkMode = localStorage.getItem("darkMode");
            if (isDarkMode === null) {
                isDarkMode = true; // Default to dark mode
                localStorage.setItem("darkMode", isDarkMode);
            } else {
                isDarkMode = (isDarkMode === "true");
            }

            // Apply the mode based on the retrieved or default value
            if (isDarkMode) {
                body.classList.add("dark");
                checkbox.checked = true;
            } else {
                body.classList.remove("dark");
                checkbox.checked = false;
            }

            checkbox.addEventListener("change", () => {
                const isChecked = checkbox.checked;

                if (isChecked) {
                    body.classList.add("dark");
                } else {
                    body.classList.remove("dark");
                }

                // Update localStorage
                localStorage.setItem("darkMode", isChecked);
                console.log(`Mode changed to: ${isChecked ? "dark" : "light"}`); // Debugging line
                // Send update to the server
                update_mode(isChecked ? "dark" : "light");
            });

            function update_mode(mode) {
        $.ajax({
            url: "" + mode
            , type: "GET"
            , async: true
            , cache: false
        });
            }
        });
  
  </script>
    <script>
    // ---- ---- Const ---- ---- //
    let inputBox = document.querySelector('.search-box'),
        searchIcon = document.querySelector('.search'),
        closeIcon = document.querySelector('.close-icon');

    // ---- ---- Open Input ---- ---- //
    searchIcon.addEventListener('click', () => {
        inputBox.classList.add('open');
    });
    // ---- ---- Close Input ---- ---- //
    closeIcon.addEventListener('click', () => {
        inputBox.classList.remove('open');
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBox = document.querySelector('.search-box');
        const searchIcon = searchBox.querySelector('.search-icon');
        const closeIcon = searchBox.querySelector('.close-icon');
        const searchInput = searchBox.querySelector('.search-input');

        searchIcon.addEventListener('click', function() {
            searchBox.classList.add('active');
            searchInput.focus();
        });

        closeIcon.addEventListener('click', function() {
            searchBox.classList.remove('active');
            searchInput.value = ''; // Optional: Clear the input field when closing
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pills-home").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>


</body>

</html>