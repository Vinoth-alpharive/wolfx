@php $title = "Exchange"; $atitle ="exchange"; @endphp
@include('layouts.headerlink')
<body class="reset-trans-pwd exchange-history">

    <main class="contain-width">
        <section class="Authentication login">
            <div class="back-div">
                <a href="{{url('sellcrypto')}}"><i class="fa-solid fa-arrow-left"></i></a>
                <h5>Bind bank card</h5>
            </div>
        </section>
        <section class="bind-bank">
            <form action="{{ url('doadd-bank') }}" method="POST">
                @csrf
                <div class="add-acctn-detail">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="accnt-field-detail">
                                <label>AccNo</label>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="accnt-field-detail">
                                <input type="text" name="acc_no" placeholder="Please enter Account No">
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="accnt-field-detail">
                                <label>IFSC</label>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="accnt-field-detail">
                                <input type="text" name="ifsc" placeholder="Please enter IFSC">
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <div class="accnt-field-detail last-line">
                                <label>AccName</label>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                            <div class="accnt-field-detail last-line">
                                <input type="text" name="acc_name" placeholder="Please enter Payee Name">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="confirm-area">
                    <button>Confirm</button>
                    <label>Please check the information carefully before submission, If the transfer issues occur due to
                        incorrect information provided by user, It is the user's own responsibility</label>
                </div>
            </form>
        </section>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
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
