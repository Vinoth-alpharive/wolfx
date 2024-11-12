


@include('layouts.headerlink')

<body>
<main class="contain-width p-0">
  <section class="Authentication reset-full">
  <a href="{{url('dashboard')}}" class="auth-logo">
                <img src="{{url('image/light-logo1.png')}}" class="light-logo img-fluid" alt="light-logo">
                <img src="{{url('image/dark-logo1.png')}}" class="dark-logo img-fluid" alt="dark-logo">
            </a>

  <div class="back-div">
                <a href="{{url('reset')}}"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
            </div>
       
            <div class="auth-inner-box">
            <h5>{{ __('Reset Password') }}</h5>
                <!-- <div class="card-header">{{ __('Reset Password') }}</div> -->

            
                    <form method="POST" action="{{ route('password.update') }}" class="auth-form mt-4">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                    
                            <label for="email" class="col-form-label text-md-end"><strong>{{ __('Email Address') }}</strong></label>

                          
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                      

              
                            <label for="password" class="col-form-label text-md-end"><strong>{{ __('Password') }}</strong></label>

                           
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror pass" name="password" required autocomplete="new-password" placeholder="Password">
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                       

                       
                            <label for="password-confirm" class="col-form-label text-md-end"><strong>{{ __('Confirm Password') }}</strong></label>

                     
                                <input id="password-confirm" type="password" class="form-control pass" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                <i class="hide-password fa fa-fw fa-eye-slash"></i>
                

                      
                            <div class="send-link-btn mt-4">
                                <input type="submit" class="auth-btn" value="{{ __('Reset Password') }}"/>
                                    
                                
                            </div>
                       
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
            input = $(this).parent().find("input.pass");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(".hide-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input.pass");
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
</body>




