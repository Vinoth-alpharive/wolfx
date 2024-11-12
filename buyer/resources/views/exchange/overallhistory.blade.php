
@include('layouts.headerlink')

<body class="history-full">
    <main class="contain-width">

        <section class="withdraw-head">
            <div class="withdraw-direct">
                <div class="prev-page">
                    <a href="{{url('/profile')}}"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <div class="withdraw-title">
                    <h6>Overall Transactions</h6>
                </div>
                <div class="support-link">
                <a href="{{url('/support')}}" target="_blank"><i class="fa-solid fa-headset"></i></a>
                </div>
            </div>
        </section>


        <section class="history-tab">
            <div class="history-detail">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history')}}"><button class="nav-link active" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Overall</button></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-deposit')}}"><button class="nav-link"  data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Deposit</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{url('exchange-history-withdraw')}}"><button class="nav-link" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Withdraw</button></a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                        <div class="withdraw-full-detail">
                            @if(count($all_history) > 0)
                                @foreach($all_history as $allhistory)
                            <div class="detail-box">
                                
                                <div class="amnt-detail-direct">
                                    <div class="history-status @if($allhistory->type == 'deposit') deposit @endif">
                                        <span>{{$allhistory->type}}</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <img src="{{url('images/color/'.@$allhistory->coinNames->image)}}">
                                        </div>
                                        <div class="value-coin">
                                            <Span>{{$allhistory->coin}}</Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Amount</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>
                                                @if($allhistory->credit > 0)
                                                    {{$allhistory->credit}}
                                                @else
                                                    {{$allhistory->debit}}
                                                @endif
                                            </Span>
                                        </div>
                                    </div>
                                </div>
                                <div class="amnt-detail-direct">
                                    <div class="withdraw-status">
                                        <span>Date</span>
                                    </div>
                                    <div class="withdraw-value">
                                        <div class="value-coin">
                                            <Span>{{date('Y-m-d H:i:s',strtotime($allhistory->created_at))}}</Span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="no-record">
                                <img src="{{('image/no-record.png')}}">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
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
    // ---- ---- Const ---- ---- //
    let inputBox = document.querySelector('.search-box'),
        searchIcon = document.querySelector('.search'),
        closeIcon = document.querySelector('.close-icon');

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