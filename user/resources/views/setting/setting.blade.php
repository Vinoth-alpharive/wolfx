@include('layouts.headerlink')

<body class="page-animation setting">

    <main class="contain-width">
    @include('layouts.header')
        <section class="referral-head">
            <div class="back-div">
                <a href="profile"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
                <div class="ref-head">Setting</div>
            </div>
        </section>

        <section class="p-0">
            <ul class="profile-inner-links">
                <li class="odd"><a href="#">
                        <div class="link-key"><img src="{{url('image/customer-service.svg')}}"
                                alt="customer-service">Customer service</div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
                <li class="even business"><a href="#">
                        <div class="link-key"><img src="{{url('image/business.svg')}}" alt="business-co-operate">Business
                            co-operation
                        </div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
                <li class="odd"><a href="#">
                        <div class="link-key"><img src="{{url('image/version.svg')}}" alt="version">Version</div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
                <li class="even"><a href="reset-transaction-password">
                        <div class="link-key"><img src="{{url('image/reset-trans-pwd.svg')}}" alt="reset-trans-pwd">Reset password</div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
            </ul>
        </section>

        <section class="log-out">
            <button class="btn" data-bs-toggle="modal" data-bs-target="#logoutConfirm">Logout</button>
        </section>

        <!-- Modal -->
        <div class="modal fade invite" id="logoutConfirm" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="index" class="auth-logo">
                            <img src="{{url('/image/light-logo.png')}}" class="light-logo img-fluid" alt="light-logo">
                            <img src="{{url('/image/dark-logo.png')}}" class="dark-logo img-fluid" alt="dark-logo">
                        </a>

                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you confirm sign out?</h1>
                    </div>
                    <div class="modal-footer mt-3 mb-4 justify-content-center">
                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{url('logout')}}" method="POST">
                            @csrf
                            <input class="auth-btn" type="submit" value="Confirm" />
                        </form>
                        <!-- <button type="button" class="btn auth-btn">Confirm</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="about-payx">
            <div class="top-head">
                <button type="button" class="btn-close"></button>
                    <h3>Business co-operation </h3>
                    <div class="business-link">
                    <a href="#" target="_blank" class="sm-btn tele-btn">Telegram</a>
                    <a href="#" target="_blank" class="sm-btn whatsapp-btn">WhatsApp!</a>
                    </div>
                <!-- <form action="https://web.telegram.org/" method="POST">
                    <input class="btn auth-btn wolf-btn" type="button" value="Yes, I know" />
                </form> -->
            </div>
        </div>

    </main>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
    // jQuery script for show/hide functionality
    $(document).ready(function() {
        // Show password box when Sell USDT button is clicked
        $('.business').click(function() {
            $('.about-payx').toggleClass('showbox');
            $('main').toggleClass('blur');
        });


        // Close password box when close button is clicked
        $('.mobile-tab-buy-sell-close-btn').click(function() {
            $('.about-payx').removeClass('showbox');
            $('main').removeClass('blur');
        });

        $('.btn-close').click(function() {
            $('.about-payx').removeClass('showbox');
            $('main').removeClass('blur');
        });
    });
    </script>

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