@php $title = "Profile"; $atitle ="profile"; @endphp
@include('layouts.headerlink')

<body class="page-animation profile-main">

    <main class="contain-width">
        <!-- <div class="profile-blur"> -->
        @include('layouts.header')
        @include('layouts.sidebar')
        {{-- @include('layouts.profile-head') --}}
        <section class="profile-head-sctn">
            <div class="welcome-wolfx">
                @if(Auth::user())
                <h1>{{Auth()->user()->phone_no}}</h1>
                @isset($balance)
                <span>{{number_format($balance)}}</span>
                @endif
                @endif
            </div>
            <div class="profile-upload">
                <img src="{{url('image/landing/profile-pic.png')}}">
            </div>
        </section>
        <section class="p-0">
            <div class="total-process">
                <div class="inner-process">
                <div>
                        <p>Total amount($)</p>
                        <h2>{{@$balance + @$process}}</h2>
                    </div>
                    <div class="border">
                        <p>Available($)</p>
                        <h2>{{@$balance}}</h2>
                    </div>
                    <div>
                        <p>Progressing(S)</p>
                        <h2>{{@$process}}</h2>
                    </div>
            </div>
        </section>

        <section class="profile-sec">
            <div class="payx-whole">
                <button class="payx" data-bs-toggle="modal" data-bs-target="#payxModal">
                    <div class="wx-top">
                        <div class="left-part">
                            <div><img src="{{url('image/wx-logo.png')}}" alt="wx-logo"></div>
                            <div>
                                <h2>0 PAYX</h2>
                                <p>1WOLX = 0010851 USDT</p>
                                <!-- <img src="{{url('image/query.svg')}}" alt="query"> -->
                            </div>
                        </div>
                        <div class="right-part widthdraw">
                            <a href="withdraw">Withdraw</a>
                        </div>
                    </div>

                    <!-- <form action=""> -->
                        <input class="auth-btn wolf-btn" type="submit" value="To WolfX pro" />
                    <!-- </form> -->
                </button>

            </div>

            <div class="rewards-details">
                <div class="inner-process">
                    <div>
                        <p>Exchange</p>
                        <h3>$0</h3>
                    </div>
                    <div>
                        <p>Reward</p>
                        <h3>{{@number_format($total_rewards)}}</h3>
                    </div>
                </div>

                <div class="detail-con">
                    {{-- <a href="#">Details</a> --}}
                    <h3>{{ \Carbon\Carbon::now()->format('d F') }}</h3>

                </div>
            </div>
        </section>
        <section class="p-0">
            <ul class="profile-inner-links">
                <li class="odd"><a href="{{url('referral-rewards')}}">
                        <div class="link-key"><img src="{{url('image/referral.svg')}}" alt="referral">Referrals</div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
                <li class="even"><a href="{{url('exchange-history')}}">
                        <div class="link-key"><img src="{{url('image/exchange.svg')}}" alt="exchange">Exchange history
                        </div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
                {{-- <li class="odd"><a href="{{url('statement')}}">
                <div class="link-key"><img src="{{url('image/statement.svg')}}" alt="statement">Statement</div>
                <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                </a></li> --}}
                {{-- <li class="even"><a href="{{url('bank-account')}}">
                <div class="link-key"><img src="{{url('image/account.svg')}}" alt="account">Bank account</div>
                <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                </a></li> --}}
                <li class="odd"><a href="{{url('invite-friends')}}">
                        <div class="link-key"><img src="{{url('image/invite-friends.svg')}}" alt="invite-friends">Invite
                            friends</div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
            </ul>
        </section>


        <!-- @include('layouts.footer') -->
        <!-- </div> -->
        <!-- <div class="about-payx">
            <div class="top-head">
                <button type="button" class="btn-close"></button>
                <div><img src="{{url('image/wx-logo.png')}}" alt="wx-logo">
                    <h3>What is PAYX ?</h3>
                </div>
                <p>Indian merchants can utilize PAYX tokens to swiftly and cost-effectively accept
                    international payments. Consumers can use PAYX tokens for cross-border shopping and
                    asset transfers, achieving a more convenient and efficient financial transaction
                    experience.</p>
                <form action="verify-code" method="POST">
                    <input class="btn auth-btn wolf-btn btn-close" type="button" value="Yes, I know" />
                </form>
            </div>
        </div> -->

        <div class="set-password-box" style="display:none">
            <div class="transaction-head">
                <div class="mobile-tab-buy-sell-close-btn"><i class="fa-solid fa-xmark"></i></div>
                <div class="set-up-img">
                    <img src="{{url('image/exchange/set-up.svg')}}">
                </div>
                <h3>Set up transaction Password </h3>


            </div>
            <p>After getting transaction password you can more conviently carry out withdrawal, Sell USDT and other business operations</p>

            <div class="set-up">
                <a href="transaction-password">Set up now</a>
            </div>
        </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <noscript>
        $(".payx").click(function() {
        // add alert class
        $(".about-payx").addClass("alert");
        // $("main").addClass("blur");
        // Close all open windows
        $(".about-payx").stop().slideUp(300);
        // Toggle this window open/close
        $(this).next(".about-payx").stop().slideToggle(300);
        //hitter test//
        $(".hitter").show()
        });

        $(".hitter").click(function() {
        // Close all open windows
        $(".about-payx").stop().slideUp(300);
        });
        // remove alert class
        $(".btn-close").click(function() {
        $(".about-payx").stop().slideUp(300);
        });

    </noscript>

    <noscript>
        // jQuery script for show/hide functionality
        $(document).ready(function() {
            // Show password box when Sell USDT button is clicked
            $('.payx').click(function() {
                $('.about-payx').toggleClass('showbox');
                $('main').toggleClass('blur');
            });
            $('.widthdraw').click(function() {
                $('.set-password-box').toggleClass('showbox');
                $('main').toggleClass('blur');
            });


            // Close password box when close button is clicked
            $('.mobile-tab-buy-sell-close-btn').click(function() {
                $('.about-payx').removeClass('showbox');
                $('main').removeClass('blur');
            });

            $('.mobile-tab-buy-sell-close-btn').click(function() {
                $('.set-password-box').removeClass('showbox');
                $('main').removeClass('blur');
            });

            $('.btn-close').click(function() {
                $('.about-payx').removeClass('showbox');
                $('main').removeClass('blur');
            });
        });

    </noscript>
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
</body>

</html>
