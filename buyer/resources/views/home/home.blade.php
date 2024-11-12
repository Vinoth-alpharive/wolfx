@php $title = "Dashboard"; $atitle ="dashboard";
@endphp
@include('layouts.headerlink')
<style>
    .t-green {
        color: green;
    }

    .t-red {
        color: red;
    }

</style>
<body>
    <main class="contain-width">
        @include('layouts.header')
        @include('layouts.sidebar')
        <section class="welcome-sctn">
            <div class="welcome-wolfx">
                <h1>Welcome to Wolf-X</h1>
                @if(Auth::user())
                <p>{{Auth()->user()->username}}</p>
                @endif
            </div>
            <div class="pro-pic">
                <img src="{{url('image/landing/pro-pic.png')}}">
            </div>
        </section>
        <section class="get-start">
            <div class="earn-more-card">
                <div class="gold-card">
                    <img src="{{url('image/landing/gold-card.png')}}">
                </div>
                <div class="gold-card">
                    <h6>Wolf-x</h6>
                    <p>Exchange more earn more
                        make your life better</p>
                </div>
            </div>
            <div class="get-start-card-row">
                @if(isset($keynote) && $keynote != "")
                @foreach($keynote as $keynotes)
                <div class="get-start-card">
                    <div class="card-img-box">
                        <img src="{{url('image/landing/card-img-1.png')}}">
                    </div>
                    <div class="card-img-box">
                        <h5>{{$keynotes->title}}</h5>
                        <p>{{$keynotes->description}}</p>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </section>
        <section class="market-table">
            <div class="market-search">
                <div class="serach-col">
                    <p>In the past 24 hours</p>
                    <h2>Market is up <span class="green-text">+4.19%</span></h2>
                </div>
            </div>
            <div class="assets-tab">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All assets</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-col" id="myTable">
                            @if(isset($tabsTrades) && $tabsTrades != "")
                            @foreach($tabsTrades as $tabtrade)
                            <div class="table-whole-div">
                                <div class="coin-name">
                                    <div class="coin-img">
                                        <img src="{{url('images/color/' . $tabtrade->coinonedetails['image'])}}">
                                    </div>
                                    <div class="coin-img">
                                        <h5>{{$tabtrade->coinonedetails['coinname']}}</h5>
                                        <span>{{$tabtrade->coinone}}</span>
                                    </div>
                                </div>
                                <div class="value-text">
                                    <h5 class="coin-img">USD {{ $tabtrade->coinonedetails['usd_value'] }}</h5>
                                    <span class="price_change_{{ $tabtrade->symbol }}"><span class="green-text">{{ $tabtrade->hrchange }}%</span></span>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
        </section>
        <section class="exchange-price">
            <h2>Exchanges price</h2>
            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                        @if(isset($trades) && $trades != "")
                        @foreach($trades as $trade)
                        <div class="card swiper-slide">
                            <div class="card-details">
                                <div class="avergae-value">
                                    <p>Avg <span>{{$trade->average_price}}</span>RS </p>
                                </div>
                                <span>1USDT = $91.83</span>
                                <div class="min-max">
                                    <h6> <span>Min</span> {{$trade->min_price}}</h6>
                                    <h6> <span>Max</span> {{$trade->max_price}}</h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </section>

        <section class="platform-advantage">
            <h2>Platform advantage</h2>
            @if(isset($advantages) && $advantages != "")
            @foreach($advantages as $adv)
            <div class="adv-card">
                <div class="full-support">
                    <div class="support-svg">
                        <img src="{{url('image/landing/support-1.svg')}}">
                    </div>
                    <div class="support-svg">
                        <h5>{{$adv->title}}</h5>

                    </div>
                </div>
                <div class="support-cnt">
                    <p>{{$adv->description}}</p>
                </div>
            </div>
            @endforeach
            @endif
        </section>
        <!-- @include('layouts.footer') -->
        @include('layouts.footerlink')
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
                    slidesPerView: 1
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
    <script type="text/javascript">
        $(document).ready(function() {
            var conn = new WebSocket("wss://stream.binance.com:9443/ws");
            conn.onopen = function(evt) {
                var cpair = 'BTCUSDT';
                var array_dta = [];

                @forelse($trades as $pairlist)

                var bpair = '{{ strtolower(trim($pairlist->symbol)) }}';
                array_dta1 = [bpair + "@ticker"];
                array_dta1.forEach(function(item) {
                    array_dta.push(item);
                })
                @empty
                var bpair = 'btcusdt';
                array_dta1 = [bpair + "@ticker"];
                array_dta1.forEach(function(item) {
                    array_dta.push(item);
                })
                @endforelse

                var messageJSON = {
                    "method": "SUBSCRIBE"
                    , "params": array_dta
                    , "id": 1
                };

                conn.send(JSON.stringify(messageJSON));
            }
            conn.onmessage = function(evt) {
                if (evt.data) {
                    var get_data = JSON.parse(evt.data);
                    if ((typeof get_data['e'] == "24hrTicker") || (get_data['e'] != null)) {
                        var last_price = get_data['c'];
                        var high_price = get_data['h'];
                        var low_price = get_data['l'];
                        var open_price = get_data['o'];
                        var price_change = get_data['P'];
                        var quote = get_data['q'];
                        var symbol = get_data['s'];

                        var is_data = "t-red";
                        if (price_change > 0) {
                            is_data = "t-green";
                        }

                        if ((typeof last_price != 'undefined')) {
                            $('.last_price_' + symbol).html(parseFloat(last_price + '$'.toString()));
                        }

                        if ((typeof quote != 'undefined') && (typeof last_price != 'undefined')) {
                            $('.quote_' + symbol).html(parseFloat(quote + '$'.toString()));
                        }
                        if ((typeof open_price != 'undefined') && (typeof last_price != 'undefined')) {
                            $('.open_' + symbol).html(parseFloat(open_price.toString()));
                        }
                        if ((typeof low_price != 'undefined') && (typeof last_price != 'undefined')) {
                            $('.low_' + symbol).html(parseFloat(low_price.toString()));
                        }
                        if ((typeof high_price != 'undefined') && (typeof last_price != 'undefined')) {
                            $('.high_' + symbol).html(parseFloat(high_price.toString()));
                        }

                        if ((typeof price_change != 'undefined') && (typeof last_price != 'undefined')) {
                            price_change = price_change * 1;
                            price_change = price_change.toFixed(2);
                            $('.price_change_' + symbol).html('<span class="' + is_data + '">' + parseFloat(
                                price_change).toFixed(2) + '% </span>');
                        }

                    }
                }
            }
        });

    </script>
</body>
</html>
