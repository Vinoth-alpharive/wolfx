@include('layouts.headerlink')
<body class="history-full select-address-full">
    <main class="contain-width">
    @include('layouts.header')
        <section class="withdraw-head">
            <div class="withdraw-direct">
                <div class="prev-page">
                    <a href="withdraw"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <div class="withdraw-title">
                    <h6>Select wallet address</h6>
                </div>
            </div>
        </section>

        <section class="select-wallet">

            @forelse($wallet as $data )
            <div class="network-name">
                <div class="coin-img">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div class="network-value">
                    <span>TRC20-USDT</span><br>
                    <span>{{$data->address}}</span>
                </div>
                <input type="checkbox" class="setPrimary" value="{{$data->id ?? ''}}" />
            </div>
            @empty

            <div class="no-record-cnt">
                <img src="{{'image/exchange/no-record-img.png'}}" />
                <p>No more data</p>
            </div>
            @endforelse



        </section>
        <section class="add-address">
        <div class="add-bank-acctn">
            <a href="{{url('add-address')}}">
                Add Address
            </a>
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

    <script>
        $(document).ready(function() {
            $('.setPrimary').change(function() {
                if (this.checked) {
                    $.ajax({
                        url: 'set-primary-address'
                        , type: 'POST'
                        , data: {
                            accountId: $(this).val()
                            , _token: '{{ csrf_token() }}'
                        }
                        , success: function(data) {
                            if (data.success) {
                                window.location.href = data.redirectPath;
                            } else {
                                console.log('Failed to set as primary. Please try again.', data);
                            }
                        }
                        , error: function(xhr, status, error) {
                            console.log('AJAX Error: ' + status + error);
                        }
                    });
                }
            });
        });

    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

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
