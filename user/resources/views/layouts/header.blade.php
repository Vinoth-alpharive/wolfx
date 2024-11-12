<header>
    <section class="logo-divide">
        <div class="whole-header">
            <div class="wolfx-logo">
                <a href="{{url('dashboard')}}">
                    <img src="{{url('image/light-logo1.png')}}" class="light-logo">
                    <img src="{{url('image/dark-logo1.png')}}" class="dark-logo">
                </a>
            </div>
            <div class="support-part">
                <div class="light-dark">
                    <div>
                        <input type="checkbox" class="checkbox" id="checkbox">
                        <label for="checkbox" class="checkbox-label">
                        <i class="fa-solid fa-moon" style="color:#ffffff;font-size:24px"></i>
                        <i class="fa-solid fa-sun" style="color:#1249ec;font-size:20px; text-align: center;"></i>
                        </label>
                    </div>
                </div>

                <div class="dropdown nofity-down">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-bell" style="font-size:22px"></i>
                    </button>
                    <div class="dropdown-menu nofity-content" aria-labelledby="dropdownMenuButton2">

                        <!-- <div class="notify-head">
                            You have 0 unread mails
                        </div> -->
                        @if($notificationsdt->count())
                        @foreach($notificationsdt as $notification)
                        <div class="notify-message">
                            <div class="notify-message-img">
                                <i class="fa-solid fa-circle-user" style="font-size:24px"></i>
                            </div>
                            <div class="notify-message-detail"><strong>Notification</strong>
                                <p>{{$notification->message}}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>No notifications</p>
                        @endif
                    </div>
                </div>

                <div class="dropdown menu-down">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        <i class="fa-solid fa-circle-user" style="font-size:24px"></i>

                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-end"
                        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 61px);">
                        <li class="dropdown-item"> <a href="{{url('profile')}}">Profile</a></li>
                        <li class="dropdown-item"> <a href="{{url('setting')}}">Settings</a></li>
                        <li class="dropdown-item"> <a href="{{route('logout')}}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </section>

    <div class="pull-to-refresh">
    <div class="spinner-border"></div>
  </div>
  
</header>