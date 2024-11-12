<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wolfx | Landing </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{url('css/common.css?v=2.4.10')}}">
    <link rel="stylesheet" href="{{url('css/style.css?v=2.4.10')}}">
    <link rel="stylesheet" href="{{url('css/custom.css?v=2.4.10')}}">

    <link rel="icon" type="image/x-icon" href="{{url('favicon/favicon.png')}}">
</head>
<header>
    <section class="logo-divide">
        <div class="whole-header">

            <div class="header-left">
                <button type="button" class="waves-effect" onclick="openNav()">
                    <i class="fa-solid fa-layer-group" style="color:var(--primary-btn-clr) !important;border: unset !important;"></i> </button>
                <!-- <div class="wolfx-logo">
                    <a href="index">
                        <img src="{{url('image/light-logo.png')}}" class="light-logo">
                        <img src="{{url('image/dark-logo.png')}}" class="dark-logo">
                    </a>
                </div> -->
            </div>
            <div class="support-part">

                <div class="header-right">
                    <div class="head-class">
                        <span></span>
                    </div>
                    <div class="head-price">
                        Price
                        <span>{{Auth::user()->price}}</span>
                    </div>
                    <div class="light-dark">
                        <div>
                            <input type="checkbox" class="checkbox" id="checkbox">
                            <label for="checkbox" class="checkbox-label">
                                <!-- <img src="{{url('image/moon-outline.gif')}}" class="fa-moon"> -->
                                <i class="fa-solid fa-moon" style="color:#ffffff;font-size:20px; text-align: center;"></i>
                                <i class="fa-solid fa-sun" style="color:#1249ec;font-size:20px; text-align: center;"></i>
                                <!-- <img src="{{url('image/sun.gif')}}" class="fa-sun"> -->

                            </label>
                        </div>
                    </div>
                    <div class="dropdown nofity-down">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-bell" style="font-size:22px"></i>
                        </button>
                        <div class="dropdown-menu nofity-content" aria-labelledby="dropdownMenuButton2">

                            {{-- <div class="notify-head">
                                You have 0 unread mails
                            </div> --}}

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
                            <div class="notify-message">
                                <div class="notify-message-detail"><strong></strong>
                                    <p>No Notification</p>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>


                    <div class="dropdown menu-down">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user" style="font-size:24px"></i>

                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="dropdown-item"> <a href="{{url('profile')}}">Profile</a></li>
                            <li class="dropdown-item"> <a href="{{url('setting')}}">Settings</a></li>
                            <li class="dropdown-item"> <a href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>
                    </div>

                    </li>
                    </ul>
                </div>


            </div>
            <!-- <div class="setting support-link">
                    <a href="setting"><i class="fa-solid fa-gear"></i></a>
                </div>
                <div class="support-link">
                    <a href="support" target="_blank"><i class="fa-solid fa-headset"></i></a>
                </div> -->
        </div>

        </div>

    </section>

    <div class="pull-to-refresh">
    <div class="spinner-border"></div>
  </div>
</header>
