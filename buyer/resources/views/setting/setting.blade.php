@include('layouts.headerlink')

<body class="page-animation setting">

    <main class="contain-width">
        @include('layouts.header')
        @include('layouts.sidebar')
        <section class="referral-head">
            <div class="back-div">
                <a href="profile"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
                <div class="ref-head">Setting</div>
            </div>
        </section>

        <section class="p-0">
            <ul class="profile-inner-links">
                <li class="odd"><a href="#">
                        <div class="link-key"><img src="{{url('image/customer-service.svg')}}" alt="customer-service">Customer service</div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
                <li class="even business"><a href="#">
                        <div class="link-key"><img src="{{url('image/business.svg')}}" alt="business-co-operate">Business
                            co-operation
                        </div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
                <li class="odd"><a href="#">
                        <div class="link-key"><img src="{{url('image/version.svg')}}" alt="version">Version</div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
                <li class="even"><a href="reset-transaction-password">
                        <div class="link-key"><img src="{{url('image/reset-trans-pwd.svg')}}" alt="reset-trans-pwd">Reset password</div>
                        <div><img src="{{url('image/arrow-right.svg')}}" alt="arrow-right"></div>
                    </a></li>
            </ul>
        </section>

        <section class="log-out">
            <button class="btn" data-bs-toggle="modal" data-bs-target="#logoutConfirm">Logout</button>
        </section>

        <!-- Modal -->
        <div class="modal fade invite" id="logoutConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="index" class="auth-logo">
                            <img src="{{url('/image/light-logo.png')}}" class="light-logo img-fluid" alt="light-logo">
                            <img src="{{url('/image/dark-logo.png')}}" class="dark-logo img-fluid" alt="dark-logo">
                        </a>

                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you confirm sign out?</h1>
                    </div>
                    <div class="modal-footer mt-3 mb-4 justify-content-center">
                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{url('logout')}}" method="POST">
                            @csrf
                            <input class="auth-btn" type="submit" value="Confirm" />
                        </form>
                        <!-- <button type="button" class="btn auth-btn">Confirm</button> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="about-payx">
            <div class="top-head">
                <button type="button" class="btn-close"></button>
                <h3>Business co-operation </h3>
                <div class="business-link">
                    <a href="#" target="_blank" class="sm-btn tele-btn">Telegram</a>
                    <a href="#" target="_blank" class="sm-btn whatsapp-btn">WhatsApp!</a>
                </div>
                <!-- <form action="https://web.telegram.org/" method="POST">
                    <input class="btn auth-btn wolf-btn" type="button" value="Yes, I know" />
                </form> -->
            </div>
        </div>
    </main>
    @include('layouts.footerlink')
</body>
</html>
