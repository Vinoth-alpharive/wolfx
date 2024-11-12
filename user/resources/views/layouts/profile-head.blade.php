<section class="profile-head-sctn">
    <div class="welcome-wolfx">
        @if(Auth::user())
        {{-- <h1>{{Auth()->user()->username}}</h1> --}}
        <span>{{Auth()->user()->username ?? ''}}</span>
        <p>{{Auth()->user()->email ?? ''}}</p>
        @endif
    </div>
    <div class="profile-upload">
        <img src="{{url('image/landing/profile-pic.png')}}">
    </div>
</section>
