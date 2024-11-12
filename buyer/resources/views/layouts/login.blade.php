
@include('layouts.headerlink')
<body>

    <main class="contain-width p-0">
        <section class="Authentication login">
        <a href="index" class="auth-logo">
                <img src="{{url('image/light-logo1.png')}}" class="light-logo img-fluid" alt="light-logo">
                <img src="{{url('image/dark-logo1.png')}}" class="dark-logo img-fluid" alt="dark-logo">
        </a>

            <div class="back-div">
                <a href="{{url('login')}}"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>

            <div class="auth-inner-box">
                <h5>Login account</h5>
                <p>please enter mobile number</p>

                <form id="phoneForm">
                    <div class="mb-3">
                        <input type="tel" id="phone" name="phone" class="form-control tel" value="+91 9876543210" placeholder="9876543210">
                    </div>
                </form>

                <!-- <input type="tel" id="phone" name="phone" class="form-control"> -->

                <!-- <button class="auth-btn">Login</button> -->
                {{-- <form action="verify-code" method="POST" class="w-100"> --}}
                    <input class="auth-btn" type="submit" value="Next" />
                {{-- </form> --}}
            </div>
        </section>
    </main>


    @include('layouts.footerlink')
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


    <!-- intl-tel-input JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <!-- Custom JavaScript -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        // Optional: Retrieve and set the phone number value from localStorage
        var storedPhoneNumber = localStorage.getItem("phoneNumber");
        if (storedPhoneNumber) {
            input.value = storedPhoneNumber;
        }

        // Handle form submission
        var form = document.getElementById("phoneForm");
        if (form) {
            form.addEventListener("submit", function(event) {
                event.preventDefault();

                // Save the phone number to localStorage
                localStorage.setItem("phoneNumber", input.value);

                // Log the phone number (you can replace this with actual form submission)
                console.log("Submitted Phone Number:", input.value);
            });
        } else {
            console.error("Form element not found.");
        }
    });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
<script src="{{url('js/darkmode.js')}}"></script>

</body>

</html>