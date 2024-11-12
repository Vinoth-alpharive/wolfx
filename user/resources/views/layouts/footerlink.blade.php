<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
<script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select-button').on('click', function () {
            var typeValue = $(this).val();
            $.ajax({
                url: '/setType'
                , type: 'POST'
                , data: {
                    _token: '{{ csrf_token() }}'
                    , type: typeValue
                }
                , success: function (response) { }
                , error: function (xhr, status, error) { }
            });
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
            ,
        }
        , navigation: {
            nextEl: ".swiper-button-next"
            , prevEl: ".swiper-button-prev"
            ,
        },

        breakpoints: {
            0: {
                slidesPerView: 2
                ,
            }
            , 520: {
                slidesPerView: 2
                ,
            }
            , 950: {
                slidesPerView: 3
                ,
            }
            ,
        }
        ,
    });

</script>
<script>
    // const checkbox = document.getElementById("checkbox")
    // checkbox.addEventListener("change", () => {
    //   document.body.classList.toggle("dark")
    // })


    // const checkbox = document.getElementById("checkbox");
    // document.addEventListener("DOMContentLoaded", function () {
    //     const body = document.body;
    //     const isDarkMode = localStorage.getItem("darkMode") === "true";
    //     if (isDarkMode) {
    //         document.body.classList.add("dark")
    //         checkbox.checked = true;
    //     }

    //     checkbox.addEventListener("change", () => {
    //         document.body.classList.toggle("dark")
    //         localStorage.setItem("darkMode", checkbox.checked);
    //         if (checkbox.checked === true) {
    //             update_mode("dark");
    //         } else {
    //             update_mode("light");
    //         }
    //     });
    // });

    // function update_mode(mode) {
    //     $.ajax({
    //         url: "" + mode
    //         , type: "GET"
    //         , async: true
    //         , cache: false
    //     });
    // }

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

<!-- <script>
    document.getElementById('refreshButton').addEventListener('click', function () {
        window.location.href = "{{ url('exchange') }}";
    });

</script> -->


<script>
    document.getElementById('refreshButton').addEventListener('click', function () {
        window.location.reload();
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchBox = document.querySelector('.search-box');
        const searchIcon = searchBox.querySelector('.search-icon');
        const closeIcon = searchBox.querySelector('.close-icon');
        const searchInput = searchBox.querySelector('.search-input');

        searchIcon.addEventListener('click', function () {
            searchBox.classList.add('active');
            searchInput.focus();
        });

        closeIcon.addEventListener('click', function () {
            searchBox.classList.remove('active');
            searchInput.value = ''; // Optional: Clear the input field when closing
        });
    });

</script>
<script>
    $(document).ready(function () {
        $('#sell-btn').click(function () {
            $('.set-password-box').toggleClass('showbox');
            $('main').toggleClass('blur');
        });

        $('.mobile-tab-buy-sell-close-btn').click(function () {
            $('.set-password-box').removeClass('showbox');
            $('main').removeClass('blur');
        });
    });

</script>
<script>
    // jQuery script for show/hide functionality
    $(document).ready(function () {
        // Show password box when Sell USDT button is clicked
        $('.policy-cmt').click(function () {
            $('.policy-box').toggleClass('showbox');
            $('main').toggleClass('blur');
        });

        // Close password box when close button is clicked
        $('.mobile-tab-buy-sell-close-btn').click(function () {
            $('.policy-box').removeClass('showbox');
            $('main').removeClass('blur');
        });
    });

</script>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#pills-home").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

</script>
<script>
    function redirectToPayment(element) {
        var transferId = element.getAttribute('data-transfer-id');

        var url = '/orderdetails/' + transferId;

        window.location.href = url;
    }

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

