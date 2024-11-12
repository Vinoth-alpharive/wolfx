@php $title = "Exchange"; $atitle ="exchange"; @endphp
@include('layouts.headerlink')
<body class="exchange-full">
    <main class="contain-width">
        @include('layouts.header')
        @include('layouts.profile-head')
        <section class="platform-price">
            <div class="platform-price-head">
                <h1>Platform price</h1>

                <!-- <div class="refresh-btn" id="refreshButton">
                    <i class="fa-solid fa-rotate-right"></i>
                </div> -->

            </div>
            <div class="refresh-value-part">
                {{-- <h5>Automatic refresh after 9s</h5> --}}
                <div class="value-box">{{$coin->liveprice ?? ''}}</div>
                <span>1 USDT= {{$coin->liveprice ?? ''}}</span>
                <div class="exchange-table">
                    <div class="exchange-table-box">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Exchange(S)</th>
                                    <th>Price($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>>=1075.27 and 2150.57</td>
                                    <td>
                                        93+ <span class="red-text">0.25</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>>=1075.27 and 2150.57</td>
                                    <td>
                                        93+ <span class="red-text">0.25</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>>=1075.27 and 2150.57</td>
                                    <td>
                                        93+ <span class="red-text">0.25</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="policy-cmt">What is tiered price policy?</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if($showPopup)
                    <div id="sell-btn" class="sell-btn">
                        <button>Sell USDT</button>
                    </div>
                    @else
                    <div class="sell-btn">
                        <a href="{{url('sellcrypto')}}">
                            <button>Sell USDT</button>
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </section>

        <section class="dep-with">
            <div class="deposit-withdraw-col">
                <div class="deposit-box">
                    <a href="{{url('deposit')}}">
                        <div class="dep-img">
                            <img src="{{('image/exchange/deposit-1.svg')}}">
                        </div>
                        Deposit
                    </a>
                </div>
                <div class="deposit-box">
                    <a href="{{url('withdraw')}}">
                        <div class="dep-img">
                            <img src="{{('image/exchange/deposit-2.svg')}}">
                        </div>
                        Withdraw
                    </a>
                </div>
                <div class="deposit-box">
                    <a href="{{url('invite-friends')}}">
                        <div class="dep-img">
                            <img src="{{('image/exchange/deposit-3.svg')}}">
                        </div>
                        Invite
                    </a>
                </div>
            </div>

            {{-- <div class="sold-annoucment">
                <div class="speaker-annouc">
                    <i class="fa-solid fa-volume-high"></i>
                    <div class="sold-result">
                        <p>11:02 91***7593 sold for $822</p>
                        <p>11:02 91***7593 sold for $822</p>
                        <p>11:02 91***7593 sold for $822</p>
                        <p>11:02 91***7593 sold for $822</p>
                    </div>
                </div>
                <div class="chevron-righ">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div> --}}

        </section>
        <section class="exchange-price">
            <h2>Exchanges price</h2>

            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                        <div class="card swiper-slide">
                            <div class="card-details">
                                <div class="front-arrow"><i class="fa-solid fa-chevron-right"></i></div>
                                <div class="avergae-value">
                                    <p>Avg <span>{{$coin->liveprice ?? ''}}</span>RS </p>
                                </div>

                                <span>1USDT = {{$coin->liveprice ?? ''}}</span>
                                <div class="min-max">
                                    <h6> <span>Min</span> 91.48RS</h6>
                                    <h6> <span>Max</span> 92.48RS</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="card-details">
                                <div class="front-arrow"><i class="fa-solid fa-chevron-right"></i></div>
                                <div class="avergae-value">
                                    <p>Avg <span>91 .83</span>RS </p>
                                </div>
                                <span>1USDT = $91.83</span>
                                <div class="min-max">
                                    <h6> <span>Min</span> 91.48RS</h6>
                                    <h6> <span>Max</span> 92.48RS</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card swiper-slide">
                            <div class="card-details">
                                <div class="front-arrow"><i class="fa-solid fa-chevron-right"></i></div>
                                <div class="avergae-value">
                                    <p>Avg <span>91 .83</span>RS </p>
                                </div>
                                <span>1USDT = $91.83</span>
                                <div class="min-max">
                                    <h6> <span>Min</span> 91.48RS</h6>
                                    <h6> <span>Max</span> 92.48RS</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="platform-advantage">
            <h2>Platform advantage</h2>
            <div class="adv-card">
                <div class="full-support">
                    <div class="support-svg">
                        <img src="{{url('image/landing/support-1.svg')}}">
                    </div>
                    <div class="support-svg">
                        <h5>24 / 7 Support</h5>

                    </div>
                </div>
                <div class="support-cnt">
                    <p>Got a problem? Just get in touch. Our customer
                        service support team is available 24/7.</p>
                </div>
            </div>
            <div class="adv-card">
                <div class="full-support">
                    <div class="support-svg">
                        <img src="{{url('image/landing/support-2.svg')}}">
                    </div>
                    <div class="support-svg">
                        <h5>Transaction free</h5>

                    </div>
                </div>
                <div class="support-cnt">
                    <p>Use a variety of payment methods to trade
                        cryptocurrency, free, safe and fast.</p>
                </div>
            </div>
            <div class="adv-card">
                <div class="full-support">
                    <div class="support-svg">
                        <img src="{{url('image/landing/support-3.svg')}}">
                    </div>
                    <div class="support-svg">
                        <h5>Rich information</h5>

                    </div>
                </div>
                <div class="support-cnt">
                    <p>Gather a wealth of information, let you know the
                        industry dynamics in first time.</p>
                </div>
            </div>
            <div class="adv-card">
                <div class="full-support">
                    <div class="support-svg">
                        <img src="{{url('image/landing/support-4.svg')}}">
                    </div>
                    <div class="support-svg">
                        <h5>Reliable security</h5>

                    </div>
                </div>
                <div class="support-cnt">
                    <p>Our sophisticated security measures protect your
                        cryptocurrency from all risks.</p>
                </div>
            </div>
        </section>
        <!-- @include('layouts.footer') -->
        <div class="set-password-box">
            <div class="transaction-head">
                <div class="mobile-tab-buy-sell-close-btn"><i class="fa-solid fa-xmark"></i></div>
                <div class="set-up-img">
                    <img src="{{url('image/exchange/set-up.svg')}}">
                </div>
                <h3>Set up transaction Password </h3>
            </div>
            <p>After getting transaction password you can more conviently carry out withdrawal, Sell USDT and other
                business operations</p>
            <div class="set-up">
                <a href="{{url('transaction-password')}}">Set up now</a>
            </div>
        </div>
        <div class="policy-box">
            <div class="transaction-head">
                <div class="mobile-tab-buy-sell-close-btn"><i class="fa-solid fa-xmark"></i></div>
                <h3>What is tiered price policy?</h3>
            </div>
            <p>In order to help users maximize their profits in the shortest possible time, we will launch a tiered exchange price discount policy.</p>
            <div class="set-up">
                <a href="">Yes, I Know</a>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".slide-content", {
            slidesPerView: 2
            , spaceBetween: 10
            , loop: true
            , autoplay: true
            , centerSlide: "true"
            , fade: "true"
            , grabCursor: "true"
            , pagination: {
                el: ".swiper-pagination"
                , clickable: true
                , dynamicBullets: true
            , }
            , navigation: {
                nextEl: ".swiper-button-next"
                , prevEl: ".swiper-button-prev"
            , },

            breakpoints: {
                0: {
                    slidesPerView: 2
                , }
                , 520: {
                    slidesPerView: 2
                , }
                , 950: {
                    slidesPerView: 3
                , }
            , }
        , });

    </script>
    <script>
        // const checkbox = document.getElementById("checkbox")
        // checkbox.addEventListener("change", () => {
        //   document.body.classList.toggle("dark")
        // })


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
        // ---- ---- Const ---- ---- //
        let inputBox = document.querySelector('.search-box')
            , searchIcon = document.querySelector('.search')
            , closeIcon = document.querySelector('.close-icon');

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
        document.getElementById('refreshButton').addEventListener('click', function() {
            window.location.href = "{{ url('exchange') }}";
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

    <script>
        $(document).ready(function() {
            $('#sell-btn').click(function() {
                $('.set-password-box').toggleClass('showbox');
                $('main').toggleClass('blur');
            });

            $('.mobile-tab-buy-sell-close-btn').click(function() {
                $('.set-password-box').removeClass('showbox');
                $('main').removeClass('blur');
            });
        });

    </script>
    <script>
        // jQuery script for show/hide functionality
        $(document).ready(function() {
            // Show password box when Sell USDT button is clicked
            $('.policy-cmt').click(function() {
                $('.policy-box').toggleClass('showbox');
                $('main').toggleClass('blur');
            });

            // Close password box when close button is clicked
            $('.mobile-tab-buy-sell-close-btn').click(function() {
                $('.policy-box').removeClass('showbox');
                $('main').removeClass('blur');
            });
        });

    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

    </script>

</body>

</html>
