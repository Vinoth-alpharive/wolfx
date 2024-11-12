@include('layouts.headerlink')

<body data-aos="fade-left">

    <main class="contain-width p-0">

        <section class="Authentication login">
        <a href="index" class="auth-logo">
                <img src="{{url('image/light-logo.png')}}" class="light-logo img-fluid" alt="light-logo">
                <img src="{{url('image/dark-logo.png')}}" class="dark-logo img-fluid" alt="dark-logo">
        </a>

            <div class="back-div">
                <a href="{{url('/register')}}"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>

            <div class="auth-inner-box">
                <h5>Enter the 6-digit code we texted to your Mobile Number</h5>
                <p>This extra step shows it’s really you trying to sign in</p>

                <form action="{{url('verify-otp-num')}}" method="POST">
                        @csrf
                        <div class="verfify-input">
                            <div class="otp-wrapper mb-4">
                                <input type="text" class="otps otp-input text-[32px] text-center form-input form-control">
                                <input type="text" class="otps otp-input text-[32px] text-center form-input form-control">
                                <input type="text" class="otps otp-input text-[32px] text-center form-input form-control">
                                <input type="text" class="otps otp-input text-[32px] text-center form-input form-control">
                                <input type="text" class="otps otp-input text-[32px] text-center form-input form-control">
                                <input type="text" class="otps otp-input text-[32px] text-center form-input form-control">
                                <input type="hidden" name="verificationcode" id="verificationcode"/>
                                {{-- <input type="hidden" name="mailidverify" id="mailidverify" value="{{auth()->user()->email}}"/> --}}
                                <input type="hidden" name="useremail" value="{{@$email}}"/>
                            </div>
                        </div>
                    <input class="auth-btn" type="submit" value="Confirm" />
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>

<script>
    // const checkbox = document.getElementById("checkbox")
    // checkbox.addEventListener("change", () => {
    //   document.body.classList.toggle("dark")
    // })

    $(".otps").on('input',function(){
        
        var otpverify = $(this).val();
        var otpverifys = "";

        $(".otps").each(function(){
            otpverifys += $(this).val();
        })

        $("#verificationcode").empty().val(otpverifys);
    })

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


<script>
    document.querySelectorAll('.otp-input').forEach((element, index, array) => {
        element.addEventListener('input', function(event) {
            let inputValue = event.target.value;
            inputValue = inputValue.replace(/[^0-9]/g, '');
            inputValue = inputValue.slice(0, 1);
            event.target.value = inputValue;

            if (inputValue !== '') {
                // Move focus to the next input field
                if (index < array.length - 1) {
                    array[index + 1].focus();
                }
            } else {
                // Move focus to the previous input field
                if (index > 0) {
                    array[index - 1].focus();
                }
            }
        });

        // Add a blur event listener to handle cases where the user clicks or tabs away
        element.addEventListener('blur', function() {
            // If the input is empty, move focus to the previous input field
            if (element.value === '' && index > 0) {
                array[index - 1].focus();
            }
        });
    });
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<script>
    // Set Toastr options
    toastr.options = {
        "positionClass": "toast-top-right"
        , "closeButton": true
        , "timeOut": 1000
        , "showMethod": "fadeIn"
    , };

    

    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}');
    @endforeach
    @endif

    @if(session('error'))
    toastr.error('{{ session('error')}}');
    @endif

    @if(session('success'))
    toastr.success('{{ session('success') }}');
    @endif

    @if(session('status'))
    toastr.success('{{ session('status') }}');
    @endif

    setTimeout(() => {
       $("#toast-container").css('display','none') ;
    }, 3000);

</script>


</body>

</html>