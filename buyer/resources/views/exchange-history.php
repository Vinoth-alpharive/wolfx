<?php include ('define.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOLFX | Exchange</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- intl-tel-input CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/common.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/user_new.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="reset-trans-pwd exchange-history">

    <main class="contain-width">
        <section class="Authentication login">
            <div class="back-div">
                <a href="exchange"><img src="assets/image/previous-arrow.svg" alt="previous-arrow"></a>
                <h5>Exchange</h5>
            </div>
        </section>
        <section class="select-payee">

            <div class="payee-details">
                <h5>Select payee</h5>
                <div class="payee-history">
                    <a href="bank-history">
                        <img src="assets/image/exchange/select-payee.png" />
                    </a>


                </div>


            </div>

            <div class="add-bank">
                <a href="add-bank">
                    Add bank account
                </a>
            </div>

            <div class="sell-amt-box">
                <p>Sell amount</p>
                <div class="amnt-detail">
                    <label>Please enter the amount</label>
                    <p>USDT</p>
                </div>
                <div class="amnt-detail">
                    <div class="avaible-acctn">
                        <label>Available: </label>
                        <input type="text" placeholder="0">
                    </div>
                    <span>1USDT=₹93</span>
                </div>
                <div class="sell-table">
                    <table class="table table-bordered">
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

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="sell-btn">
                <button>Confirm</button>
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
                <h6><strong>10 ~ ₹930 </strong></h6>


            </div>


            <div class="otp-container">
                <input type="text" id="otp-1" class="otp-input" maxlength="1" />
                <input type="text" id="otp-2" class="otp-input" maxlength="1" />
                <input type="text" id="otp-3" class="otp-input" maxlength="1" />
                <input type="text" id="otp-4" class="otp-input" maxlength="1" />
                <input type="text" id="otp-5" class="otp-input" maxlength="1" />
                <input type="text" id="otp-6" class="otp-input" maxlength="1" />
            </div>

            <div class="keypad">
                <button onclick="pressKey('1')">1</button>
                <button onclick="pressKey('2')">2</button>
                <button onclick="pressKey('3')">3</button>
                <button onclick="pressKey('4')">4</button>
                <button onclick="pressKey('5')">5</button>
                <button onclick="pressKey('6')">6</button>
                <button onclick="pressKey('7')">7</button>
                <button onclick="pressKey('8')">8</button>
                <button onclick="pressKey('9')">9</button>
                <button onclick="deleteLast()" class="clear-btn">Back</button>
                <button onclick="pressKey('0')">0</button>
                <a href="confirmation" class="clear-btn">Confirm</a>

            </div>
        </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- timer -->
    <script>
        let timeLeft = 60;
        const timerElement = document.getElementById('timer');

        const countdown = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerElement.textContent = "Time's up!";
            } else {
                timerElement.textContent = timeLeft;
                timeLeft--;
            }
        }, 1000);
    </script>
    <!-- dark-light -->
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
        // jQuery script for show/hide functionality
        $(document).ready(function () {
            // Show password box when Sell USDT button is clicked
            $('.sell-btn').click(function () {
                $('.set-password-box').toggleClass('showbox');
                $('main').toggleClass('blur');
            });

            // Close password box when close button is clicked
            $('.mobile-tab-buy-sell-close-btn').click(function () {
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
            input.addEventListener('input', function () {
                if (this.value.length === 1 && index < 3) {
                    document.querySelectorAll('.otp-input')[index + 1].focus();
                }
            });
        });
    </script>
</body>

</html>