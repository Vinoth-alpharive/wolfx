


@include('layouts.headerlink')

<body class="reset-trans-pwd">

    <main class="contain-width p-0">
    @include('layouts.header')
        <section class="Authentication login">
            <div class="back-div">
                <a href="setting"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>
            @if(session('status'))
                <div class="alert alert-success alert-block">{{session('status')}}</div>
            @endif
            <div class="auth-inner-box">
                <h5>Reset password</h5>
                <form class="password-form" action="{{url('reset-password')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="enter-name">
                            <div class="input-svg">
                                <img src="{{url('image/exchange/svg-1.svg')}}">
                            </div>
                            <input type="password" name="oldpassword" class="form-control" id="password" placeholder="Enter Old Password">
                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        </div>
                        @error('oldpassword')
                            <span class="error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="enter-name">
                            <div class="input-svg">
                                <img src="{{url('image/exchange/svg-2.svg')}}">
                            </div>
                            <input type="password" name="newpassword" class="form-control"
                                placeholder="Enter New Password">
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        </div>
                        @error('newpassword')
                            <span class="error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="enter-name">
                            <div class="input-svg">
                                <img src="{{url('image/exchange/svg-2.svg')}}">
                            </div>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm New Password">
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        </div>
                        @error('password_confirmation')
                            <span class="error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                        <input class="auth-btn" type="submit" value="Confirm" />
                </form>
            </div>
        </section>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
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
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

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