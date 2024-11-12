<?php include('define.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOLFX | Select Bank Account</title>
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

<body class="reset-trans-pwd exchange-history bank-history">

    <main class="contain-width">
        <div class="whole-bank-accnt">
            <section class="Authentication login">
                <div class="back-div">
                    <a href="exchange-history"><img src="assets/image/previous-arrow.svg" alt="previous-arrow"></a>
                    <h5>Select Bank Account</h5>
                </div>
            </section>
            <section class="select-bank">

                <div class="accnt-select">
                    <div class="whole-acctn-detail">
                        <div class="profile-icon-img">
                            <img src="assets/image/exchange/profile-icon.png" />
                        </div>
                        <div class="accnt-information">
                            <p><strong>Account No:600601517324</strong></p>
                            <p>IFSC: ICIC0006006</p>
                            <p>Account Name: ICIC0006006</p>
                        </div>
                    </div>

                    <div class="create-time">
                        <label>Create time: 13 Aug 2024 15:23:19</label>
                    </div>
                </div>
            </section>

            <div class="no-record-cnt">
                <img src="assets/image/exchange/no-record-img.png" />
                <p>No more data</p>
            </div>
        </div>
        <div class="add-bank-acctn">
            <button type="button" class="add-bank-btn"> <i class="fa-solid fa-plus"></i> Add Bank
                Account</button>
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
            <button onclick="pressKey('0')">0</button>
            <button onclick="clearOtp()">Clear</button>
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
            url: "" + mode,
            type: "GET",
            async: true,
            cache: false
        });
    }
    </script>

    <script>
    // scripts.js

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

    function clearOtp() {
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach(input => input.value = '');
        inputs[0].focus();
    }

    // Optional: Handle input focus for automatic key input
    document.querySelectorAll('.otp-input').forEach((input, index) => {
        input.addEventListener('input', function() {
            if (this.value.length === 1 && index < 3) {
                document.querySelectorAll('.otp-input')[index + 1].focus();
            }
        });
    });
    </script>
</body>

</html>