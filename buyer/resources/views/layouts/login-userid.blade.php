

@include('layouts.headerlink')

<body>

    <main class="contain-width p-0">
        <section class="Authentication login">
        <a href="index" class="auth-logo">
                <img src="{{url('image/light-logo.png')}}" class="light-logo img-fluid" alt="light-logo">
                <img src="{{url('image/dark-logo.png')}}" class="dark-logo img-fluid" alt="dark-logo">
        </a>

            <div class="back-div">
                <a href="{{url('authwelcome')}}"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>

            <div class="auth-inner-box">
                <h5>Login account</h5>
                <p>please enter User ID and Password</p>

                <form class="auth-form" action="{{url('userlogin')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" id="Username" name="Username" class="form-control" placeholder="Username">
                        <input type="text" id="Password" name="Password" class="form-control login-input mt-3" placeholder="Password">
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                    </div>
                    <!-- <div class="register-query">Already you don't have Account? <a href="">sign up</a></div> -->
                    <div class="register-query">Do you want to login using number? <a href="login">Click here</a></div>

                <!-- <input type="tel" id="phone" name="phone" class="form-control"> -->

                <!-- <button class="auth-btn">Login</button> -->
                    <input class="auth-btn" type="submit" value="Next" />
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

</body>

</html>