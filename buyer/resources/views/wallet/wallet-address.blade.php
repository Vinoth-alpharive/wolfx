@include('layouts.headerlink')
<body class="wallet-full">
    <main class="contain-width">
    @include('layouts.header')
    @include('layouts.sidebar')
        <section class="withdraw-head">
            <div class="withdraw-direct">

                <div class="prev-page">
                    <a href="{{url('withdraw')}}"><i class="fa-solid fa-arrow-left"></i></a>
                </div>

                <div class="withdraw-title">
                    <h6>Bind wallet address</h6>
                </div>
                <div class="support-link">
                    <!-- <a href=""><i class="fa-solid fa-headset"></i></a> -->
                </div>
            </div>
        </section>
        <section class="select-address">
            <div class="currency-box">
                <div class="network-detail">
                    <p>Network</p>
                    <div class="ntwork-type-box">
                        <div class="coin-img">
                            <img src="{{url('image/exchange/trc.svg')}}">
                        </div>
                        <span>TRC20-USDT</span>
                    </div>
                </div>

                <form action="{{ url('doadd-address') }}" method="POST">
                    @csrf
                    <div class="wallet-address-input">
                        <label>Wallet address</label>
                        <input type="text" id="checkaddress" name="address" placeholder="Please enter Wallet Address" required>
                    </div>
                       <span id="address-error" style="color: red;"></span> 
                    <div class="commit-btn">
                        <button type="submit">Commit</button>
                    </div>
                                      
                </form>

                <div class="check-msg">
                    <p>Please check the information carefully before
                        submission, If the transfer issues occur due to
                        incorrect information provided by user, It is the
                        users own responsibility</p>
                </div>
            </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#checkaddress").on("keyup", function() {
                var value = $(this).val();
                var isValidTrxAddress = /^T[a-zA-Z0-9]{33}$/.test(value); 
                if (isValidTrxAddress) {
                    $("#address-error").text("");
                } else {
                    $("#address-error").text("Enter a valid TRX address."); 
                }
            });
        });

    </script>


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
