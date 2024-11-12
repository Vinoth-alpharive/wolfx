
@include('layouts.headerlink')
 <body>
 <main class="contain-width p-0">
    <section class="Authentication email-full">
    <a href="{{url('dashboard')}}" class="auth-logo">
                <img src="{{url('image/light-logo1.png')}}" class="light-logo img-fluid" alt="light-logo">
                <img src="{{url('image/dark-logo1.png')}}" class="dark-logo img-fluid" alt="dark-logo">
            </a>

            <div class="auth-inner-box">

            <h5>{{ __('Reset Password') }}</h5>
   
                <!-- <div class="card-header">{{ __('Reset Password') }}</div> -->

                <div class="email-reset-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="auth-form mt-4">
                        @csrf

                   
                            <label for="email" class="col-form-label"><strong>{{ __('Email Address') }}</strong></label>

                      
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         
                      

                    
                            <div class="send-link-btn mt-4">
                                <input type="submit" class="auth-btn" value="{{ __('Send Password Reset Link') }}"/>
                                    
                               
                            </div>
                     
                    </form>
                </div>
                </div>
    


    </section>
 </main>
 </body>

 </html>
