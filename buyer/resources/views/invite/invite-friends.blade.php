@include('layouts.headerlink')
<!-- exchange-full -->

<body class="invite-friends" data-aos="fade-left">

    <main class="contain-width">
        <div class="referral-head">
            <div class="back-div">
                <a href="{{url('profile')}}"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>
        </div>
        <section class="top-invite-info">
            <h1>Invite friends and make money together</h1>
            <p>Each accepted order of your subordinates will get you corresponding rewards</p>

            <div><img src="{{url('image/invite-main-asset.png')}}" alt="invite-main-asset"></div>
        </section>
        <section class="platform-price">
            <div class="refresh-value-part">
                <h2>Rules</h2>
                <div class="exchange-table">
                    <div class="exchange-table-box">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Subordinate</th>
                                    <th>Commission rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($all_commission) > 0)
                                @foreach($all_commission as $commission)
                                <tr>
                                    <td>Level {{$commission->generation}}</td>
                                    <td>
                                        {{$commission->amount}}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="sell-btn">
                <button>Invite Friends</button>
            </div>
        </section>


        <!-- @include('layouts.footer') -->

        <div class="set-password-box">
            <div class="transaction-head">
                <div class="mobile-tab-buy-sell-close-btn"><i class="fa-solid fa-xmark"></i></div>
                <div class="set-up-img">
                    <img src="{{url('image/wolfx-qrcode.png')}}">
                </div>
                <h3>Please use mobile browser scan QR code to
                    registration </h3>
            </div>

            <form>
                <div class="copy-text copy1">
                    <button class="copy copy-btn1"><img src="{{url('image/copy-code.svg')}}" alt="copy-code"></button>
                    <input type="text" id="Invite-code" name="Invite code"
                        class="form-control common-input-border text1 mb-3" value="{{@$referral->referral_id}}" placeholder="Invite code">
                </div>
                <div class="copy-text copy2">
                    <button class="copy copy-btn2"><img src="{{url('image/copy-code.svg')}}" alt="copy-code"></button>
                    <input type="text" id="Invite-link" name="Invite link"
                        class="form-control common-input-border text2 mb-3" value="{{ Config::get('app.url')}}/referral/{{$referral->referral_id}}" placeholder="Invite link">
                </div>
            </form>
        </div>
    </main>









    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
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
    // button1
    let copyText = document.querySelector(".copy1");
    copyText.querySelector(".copy-btn1").addEventListener("click", function() {
        let input = copyText.querySelector("input.text1");
        input.select();
        document.execCommand("copy");
        copyText.classList.add("active");
        window.getSelection().removeAllRanges();
        setTimeout(function() {
            copyText.classList.remove("active");
        }, 2500);
    });

        // button2
        let copyText1 = document.querySelector(".copy2");
    copyText1.querySelector(".copy-btn2").addEventListener("click", function() {
        let input1 = copyText1.querySelector("input.text2");
        input1.select();
        document.execCommand("copy");
        copyText1.classList.add("active");
        window.getSelection().removeAllRanges();
        setTimeout(function() {
            copyText1.classList.remove("active");
        }, 2500);
    });

    // button refresh avoid
    $('button.copy').click(function(e) {
        e.preventDefault()
    })

    </script>
    <noscript>
    // button2
    let copyText1 = document.querySelector(".copy2");
    copyText1.querySelector(".copy-btn2").addEventListener("click", function() {
        let input1 = copyText1.querySelector("input.text2");
        input1.select();
        document.execCommand("copy");
        copyText1.classList.add("active");
        window.getSelection().removeAllRanges();
        setTimeout(function() {
            copyText1.classList.remove("active");
        }, 2500);
    });
    </noscript>

</body>

</html>