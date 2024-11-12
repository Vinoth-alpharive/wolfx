@include('layouts.headerlink')
<body>

    <main class="contain-width p-0">
        <section class="Authentication login">

            <div class="back-div">
                <a href="exchange"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>

            <div class="auth-inner-box">
                <h5>Set up transaction password</h5>
                <p> OTP send to {{$email}}</p>

                <form action="add-transactionpassword" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="enter-name">
                            <div class="input-svg">
                                <img src="{{url('image/exchange/svg-1.svg')}}">
                            </div>
                            <input type="text" name="otp" class="form-control" placeholder="Please enter OTP">
                        </div>

                        <div class="enter-name">
                            <div class="input-svg">
                                <img src="{{url('image/exchange/svg-2.svg')}}">
                            </div>
                            <input type="text" name="password" class="form-control" placeholder="Please enter transaction password">
                        </div>
                    </div>
                    <div class="register-query">The transaction password must be composed of
                        6 digits only</div>

                    <input class="auth-btn" type="submit" value="Confirm" />
                </form>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
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
                initialCountry: "auto"
                , separateDialCode: true
                , utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            , });

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
</body>

</html>
