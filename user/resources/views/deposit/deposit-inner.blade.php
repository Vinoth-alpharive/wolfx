<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wolfx | USDT Deposit </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{url('css/common.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/custom.css')}}">
    <link rel="stylesheet" href="{{url('css/user_new.css')}}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{url('favicon/favicon.png')}}">
</head>
<body class="usdt-full">

<div class="pull-to-refresh">
    <div class="spinner-border"></div>
  </div>
  
    <main class="contain-width">

        <div id="popup" style="display: none;">
            <div id="popup-content">

                <p>Due to transaction fees charged by the
                    exchange when transferring funds,
                    please try to ensure that the deposited
                    amount and the amount received are as
                    close as possible.</p>

                <p>For example, if the transaction fee for the
                    exchange transfer is 1 USDT and the
                    deposited amount is 10023 IJSDT, the
                    transfer amount to the exchange should
                    be 101.23 USDT.</p>

                <div class="sell-btn">
                    <button id="close-popup" disabled="disabled">Okay</button>
                </div>

                <div class="buy-confirm">
                    <input id="dont-remind" type="radio">
                    <label>I already know, next time don't remind</label>
                </div>
            </div>
        </div>

        <section class="withdraw-head">
            <div class="withdraw-direct">
                <div class="prev-page">
                    <a href="{{url('deposit')}}"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <div class="withdraw-title">
                    <h6>USDT Deposit</h6>
                </div>
                <div class="support-part">
                
                </div>
            </div>
        </section>

        <section class="qr-code-scan">
            <div class="scan-pay">
                @if($trxaddress)
                <p>Scan the QR code and pay</p>
                <div class="qr-img">
                    {!! QrCode::size(180)->generate($trxaddress) !!}
                </div>
                @else
                <div class="qr-img">
                    Address Not Generate Yet
                </div>
                @endif
                <div class="transactipn-id">
                </div>
                </br>
                <div class="deposit-full-box">
                    <div class="deposit-amt-box copy-txt">
                        <div class="copy-id-box">
                            <div class="referral-id">
                                <p>Deposit Address</p>
                                <button id="copy-button" aria-label="Copy Text">
                                    <i class="fa-regular fa-copy copy-icon"></i>
                                </button>
                            </div>
                            <div class="referral-id-cnt">
                                <p id="referral-text">{{$trxaddress}}
                                </p>
                            </div>
                            <div id="toast" class="toast"> <i class="fa-solid fa-circle-check"></i> &nbsp; Copied
                                successfully!</div>
                        </div>
                    </div>


                </div>
                <div class="safety-note">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <p>For the safety of your funds, please note that the
                        recharge address for each order is different. Please
                        double-check carefully to avoid the risk of
                        irretrievable funds</p>
                </div>

                <div class="network-details">
                </div>
                <div class="network-box deposit-value">
                    <span>Network</span>
                    <div class="network-name">
                        <div class="coin-img">
                            <img src="{{url('image/exchange/trc.svg')}}">
                        </div>
                        <div class="network-value">
                            <span>USDT - TRC20</span>
                        </div>
                    </div>
                </div>
                <div class="network-box deposit-value">
                    <span>Create Time</span>

                    <div class="network-value">
                        @php $crdate = date('d M Y H:i:s') @endphp
                        <span>{{$crdate}} </span>
                    </div>
                </div>
            </div>
        </section>
        <section class="remark">
            <div class="remark">
                <p>Remark</p>
                <div class="trc-usd">
                    <label>TRC20-USDT only</label>
                </div>
            </div>
        </section>
        {{-- <section class="cancl-btn">
            <button class="btn" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Cancel</button>
        </section> --}}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>

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

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>

        document.getElementById("dont-remind").addEventListener('click',function(){
            document.getElementById("close-popup").disabled = false;
        })

        document.addEventListener("DOMContentLoaded", function() {

            const Popup = localStorage.getItem('depalert');
            if (!Popup) {
                function showPopup() {
                    document.getElementById('popup').style.display = 'block';
                    $('main').toggleClass('blur');

                }
            }

            function closePopup() {

                if (document.getElementById('dont-remind').checked) {
                    localStorage.setItem('depalert', true);
                }
                document.getElementById('popup').style.display = 'none';
                $('main').removeClass('blur');
            }

            showPopup();
            document.getElementById('close-popup').addEventListener('click', function() {
                closePopup();
            });
        });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new ClipboardJS('#copy-button', {
                text: () => document.getElementById('referral-text').textContent
            }).on('success', () => {
                const toast = document.getElementById('toast');
                toast.style.opacity = 1;
                toast.style.visibility = 'visible';
                setTimeout(() => {
                    toast.style.opacity = 0;
                    toast.style.visibility = 'hidden';
                }, 1500);
            }).on('error', (error) => {
                console.error('Failed to copy text:', error);
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            new ClipboardJS('#copy-buttontwo', {
                text: () => document.getElementById('referral-texts').textContent
            }).on('success', () => {
                const toast = document.getElementById('toast');
                toast.style.opacity = 1;
                toast.style.visibility = 'visible';
                setTimeout(() => {
                    toast.style.opacity = 0;
                    toast.style.visibility = 'hidden';
                }, 1500);
            }).on('error', (error) => {
                console.error('Failed to copy text:', error);
            });
        });

    </script>

    <script>
        function updateCountdown() {

            const targetDate = new Date("2025-01-01T00:00:00");
            const now = new Date();
            const timeDifference = targetDate - now;

            if (timeDifference <= 0) {
                document.getElementById("hours").innerText = "00";
                document.getElementById("minutes").innerText = "00";
                document.getElementById("seconds").innerText = "00";
                return;
            }

            const months = Math.floor(timeDifference / (1000 * 60 * 60 * 24 * 30));
            const days = Math.floor(
                (timeDifference % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24)
            );
            const hours = Math.floor(
                (timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            //   document.getElementById("months").innerText = String(months).padStart(2, "0");
            //   document.getElementById("days").innerText = String(days).padStart(2, "0");
            document.getElementById("hours").innerText = String(hours).padStart(2, "0");
            document.getElementById("minutes").innerText = String(minutes).padStart(
                2
                , "0"
            );
            document.getElementById("seconds").innerText = String(seconds).padStart(
                2
                , "0"
            );
        }
        setInterval(updateCountdown, 1000);

    </script>


<script>
    const pullToRefresh = document.querySelector('.pull-to-refresh');
let touchstartY = 0;
document.addEventListener('touchstart', e => {
  touchstartY = e.touches[0].clientY;
});
document.addEventListener('touchmove', e => {
  const touchY = e.touches[0].clientY;
  const touchDiff = touchY - touchstartY;
  if (touchDiff > 0 && window.scrollY === 0) {
    pullToRefresh.classList.add('visible');
    e.preventDefault();
  }
});
document.addEventListener('touchend', e => {
  if (pullToRefresh.classList.contains('visible')) {
    pullToRefresh.classList.remove('visible');
    location.reload();
  }
});
</script>

</body>

</html>
