@include('layouts.headerlink')

<body data-aos="fade-left">

    <main class="contain-width p-0">
        <section class="Authentication login">
        <a href="{{url('index')}}" class="auth-logo">
                <img src="{{url('image/light-logo.png')}}" class="light-logo img-fluid" alt="light-logo">
                <img src="{{url('image/dark-logo.png')}}" class="dark-logo img-fluid" alt="dark-logo">
        </a>

            <div class="back-div">
                <a href="{{('verify-code')}}"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>

            <div class="auth-inner-box">
                <h5>+91 9876543210</h5>
                <p>Please enter your exclusive invitation code to
                get better rewards</p>

                <form class="auth-form">
                    <div class="mb-3">
                        <input type="text" id="invite code" name="invite code" class="form-control invite-input" placeholder="invite code (optional)">
                    </div>
                </form>

                <button type="button" class="btn auth-btn" data-bs-toggle="modal" data-bs-target="#registerConfirm">
                    Confirm
                </button>

                <!-- Modal -->
                <div class="modal fade invite" id="registerConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <a href="{{url('index')}}" class="auth-logo">
                            <img src="{{url('image/light-logo.png')}}" class="light-logo img-fluid" alt="light-logo">
                            <img src="{{url('image/dark-logo.png')}}" class="dark-logo img-fluid" alt="dark-logo">
                    </a>
                       
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to Registration?</h1>
                    </div>
                    <div class="modal-footer mt-3 mb-4 justify-content-center">
                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <form action="authwelcome" method="POST">
                            <input class="auth-btn" type="submit" value="Confirm" />
                        </form>
                        <!-- <button type="button" class="btn auth-btn">Confirm</button> -->
                    </div>
                    </div>
                </div>
                </div>
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