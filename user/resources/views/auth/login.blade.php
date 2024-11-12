@include('layouts.headerlink')

<body>

    <main class="contain-width p-0">
        <section class="Authentication login">
            <a href="{{url('dashboard')}}" class="auth-logo">
                <img src="{{url('image/light-logo1.png')}}" class="light-logo img-fluid" alt="light-logo">
                <img src="{{url('image/dark-logo1.png')}}" class="dark-logo img-fluid" alt="dark-logo">
            </a>
            <div class="back-div">
                <a href="{{url('/')}}"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>
            <div class="auth-inner-box">
                <div class="login-flex">
                <h5>Login account</h5>
                <div class="sign-in">
                <a href="{{url('register')}}">Sign up</a>
                </div>
                </div>
                
                <p>please enter User ID and Password</p>
                @if($msg = Session::get('status'))
                <div class="alert alert-success alert-block">{!! $msg !!}</div>
                @endif

                <form class="auth-form" action="{{url('login')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="email">
                        <input type="password" id="password" name="password" class="form-control login-input mt-3 pass" placeholder="Password">
                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                    </div>
                    <a class="t-blue" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a></br>
                    {{-- <div class="register-query">Do you want to login using number? <a href="{{url('login-phone')}}">Click here</a></div> --}}
                    <input class="auth-btn" type="submit" value="Next" />
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
                url: "" + mode
                , type: "GET"
                , async: true
                , cache: false
            });
        }

    </script>

    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input.pass");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <script>
        toastr.options = {
            "positionClass": "toast-top-right"
            , "closeButton": true
            , "timeOut": 3000
            , "showMethod": "fadeIn"
        , };

        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}');
        @endforeach
        @endif

        @if(session('error'))
        toastr.error('{{ session('
            error ') }}');
        @endif

        @if(session('success'))
        toastr.success('{{ session('
            success ') }}');
        @endif

        // @if(session('status'))
        // toastr.success('{{ session('status') }}');
        // @endif

    </script>

</body>

</html>
