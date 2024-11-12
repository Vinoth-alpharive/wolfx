@include('layouts.headerlink')
<body data-aos="fade-left">

    <main class="contain-width p-0">
        <section class="Authentication register">
            <a href="{{url('index')}}" class="auth-logo">
                <img src="{{url('image/light-logo1.png')}}" class="light-logo img-fluid" alt="light-logo">
                <img src="{{url('image/dark-logo1.png')}}" class="dark-logo img-fluid" alt="dark-logo">
            </a>

            <div class="back-div">
                <a href="{{url('/')}}"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>

            <div class="auth-inner-box">
                <h5>Register</h5>
                <p>Enter the details</p>

                <form class="auth-form" method="POST" id="register_user" action="{{ route('register') }}">
                    @csrf

                    <div class="register-inner-box mb-3">

                        <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                        <span class="error" style="color: red;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div>
                            <input type="text" id="username" name="username" class="form-control mt-3" placeholder="Full Name" value="{{ old('username') }}">
                            @error('username')
                            <span class="error" style="color: red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div>
                            <input type="text" id="Password" name="password" class="form-control mt-3" placeholder="Password" value="{{ old('password') }}">
                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        </div>
                        @error('password')
                        <span class="error" style="color: red;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div>
                       <input type="text" id="Password" name="password_confirmation" class="form-control" placeholder=" Password confirmation" value="{{ old('password_confirmation') }}">
                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                        </div>
                        @error('password_confirmation')
                        <span class="error" style="color: red;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        @if(isset($referral_code))
                        <input id="referral_code" type="tel" id="referralid" name="referralid" class="form-control mt-3" placeholder="Enter Referral" @if(@$referral_code !="" ) value="{{@$referral_code}}" @else value="" @endif onchange="referralidcheck()">
                        @else
                        <input id="referral_code" type="tel" id="referralid" name="referralid" class="form-control mt-3" placeholder="Enter Referral" value="{{ old('referralid') }}" onchange="referralidcheck()">
                        @endif
                        <p style="color:red;font-weight: bold;" id="refrral_error"></p>
                        <p style="color:#17b3b5;font-weight: bold;" id="referral_name"></p>

                        <input type="tel"  name="phone_no" class="form-control tel" placeholder="Eg: 9850012500" value="{{ old('phone_no') }}">
                        @error('phone_no')
                        <span class="error" style="color: red;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="register-query">You have account already <a href="{{url('login')}}">Log In</a></div>
                    <input class="auth-btn" type="submit" value="Register" />

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

        function referralidcheck() {
            var rid = document.getElementById("referral_code").value;
            var url = "{{ url('/form_referral') }}";

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , type: "POST"
                , url: url
                , data: 'referral_code=' + rid
                , async: true
                , cache: false
                , success: function(data) {
                    if (data.status == true) {
                        $("#refrral_error").html('');
                        $("#referral_name").html(data.res);
                    } else {
                        $("#referral_name").html('');
                        $("#refrral_error").html(data.res);
                    }
                }
            });
        }

    </script>


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <script>
        // Set Toastr options
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
            error ')}}');
        @endif

        @if(session('success'))
        toastr.success('{{ session('
            success ') }}');
        @endif

        @if(session('status'))
        toastr.success('{{ session('
            status ') }}');
        @endif

    </script>
</body>
</html>
