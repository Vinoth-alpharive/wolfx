
<section class="profile-head-sctn">
    <div class="welcome-wolfx">
        @if(Auth::user())
        <h1>{{Auth()->user()->phone_no}}</h1>
        <span>$ 000</span>
        @endif
    </div>
    <div class="profile-upload">
        <img src="{{url('image/landing/pro-pic.png')}}">
    </div>
</section>
