@php $title = "Seller Support";
$atitle = "seler support"; @endphp
@include('layouts.headerlink')

<body class="pending-status-page seller-support-page">

    <main class="contain-width p-0">
        <section class="pending-status">
            <!-- <a href="{{url('/')}}" class="auth-logo">
                <img src="assets/image/light-logo.png" class="light-logo img-fluid" alt="light-logo">
                <img src="assets/image/dark-logo.png" class="dark-logo img-fluid" alt="dark-logo">
        </a> -->

            <div class="back-div support-back">
                <a href="{{url('/')}}"><img src="{{ url('image/previous-arrow.svg') }}" alt="previous-arrow"></a>
            </div>
            <h2>Buyer payment

                processing...</h2>

            <div class="sell-support-blocks">

                <div class="seller-details network-box deposit-value">
                    <h3 class="seller-name">John Doe</h3>
                    <p>**** **** **** 3040</p>
                    <p>IFSC*****</p>
                    <p>500000 INR</p>
                    <span>Processing</span>

                </div>

                <div class="seller-details network-box deposit-value">
                    <h3 class="seller-name">John Doe</h3>
                    <p>**** **** **** 3040</p>
                    <p>IFSC*****</p>
                    <p>500000 INR</p>
                    <span>Processing</span>

                </div>

                <div class="seller-details network-box deposit-value">
                    <h3 class="seller-name">John Doe</h3>
                    <p>**** **** **** 3040</p>
                    <p>IFSC*****</p>
                    <p>500000 INR</p>
                    <span>Processing</span>

                </div>



            </div>

        </section>
    </main>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered take-it-popup">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="seller-details">
                        <h3 class="seller-name">John Doe</h3>
                        <p>**** **** **** 3040</p>
                        <p>IFSC*****</p>
                        <p>500000 INR</p>

                    </div>
                </div>
                <div class="modal-footer">
                    <a class="take-it-btn" href="{{url('take-it')}}">Confirm</a>
                </div>
            </div>
        </div>
    </div>


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



    <!-- Custom JavaScript -->


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>


    <script>
    const input = document.querySelector("input");
    const preview = document.querySelector(".preview");
    const para = document.querySelector(".no-pic");
    const image = document.querySelector(".profile-img");
    input.addEventListener("change", updateImageDisplay);

    function updateImageDisplay() {
        para.style.display = "none";
        const curFiles = input.files;
        image.src = URL.createObjectURL(curFiles[0]);
        image.style.opacity = 1;
    }
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

</body>

</html>