@include('layouts.headerlink')

<body class="support-full">




    <section class="message-head">

        <div class="contain-width">
            <div class="head-direct">
                <div class="messenger__head__title"><span class="start-chat-icon"></span>Online Chat</div>
                <div class="close-bar">
                    <a class="btn" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i
                            class="fa-solid fa-xmark"></i></a>
                </div>
            </div>

        </div>



    </section>

    <section class="chat-space">
        <div class="contain-width">
            <div class="chat-message system-message information">
                <div class="message-text">
                    <div class="chat-time">
                        <div class="info-icon">
                            <i class="fa-solid fa-info"></i>
                        </div>
                        <p class="message-time">10:39 AM</p>
                    </div>


                    <p>Dear Valued Clients,

                        We are excited to Inform you our mobile Application has been updated with new features and
                        improvements and you can use the same user credentials to login.</p>

                    <p> Now Enjoy the latest version of our website, please Use our website from the following link:</p>

                    <a href="#" target="_blank">https://web.wolfx.com/</a>

                    <p class="thank-note">Thank For Your continued support!</p>
                </div>
            </div>
            <div class="chat-message system-message information">
                <div class="message-text">
                    <div class="chat-time">
                        <div class="info-icon">
                            <i class="fa-solid fa-info"></i>
                        </div>
                        <p class="message-time">10:49 AM</p>
                    </div>


                    <p>Call accepted by operator Sid. Currently in room: Guest #21, Sid..</p>

                </div>
            </div>

            <div class="ai-chat">
                <div class="chat-profile">
                    <img src="{{url('image/support-profile.jpg')}}">
                </div>
                <div class="sid-chat">
                    <p>Sid <span>10:40 AM</span></p>
                    <p>Hi there!!<br>

                        I am Sid<br>
                        from<br>
                        the customer service of WolfX.<br>

                        How may I help you?</p>
                </div>
            </div>
        </div>
    </section>


    <section class="chat-footer">
        <div class="contain-width">
        <div class="room__part-bottom">
            <div class="message-input-area">
                <div class="message-wrapper">
                    <div class="message-input-area__text"><textarea type="text" rows="1" class="custom-scroll"
                            tabindex="0" placeholder="Type your message here" aria-label="Type your message here"
                            style="height: 44px;"></textarea>

                    </div>
                </div>
                <div class="message-input-area__send-button"><button
                        class="btn message-input-area__send-message outline enabled-false" aria-label="Send the message"
                        title="Send the message" disabled="" tabindex="0">Send</button><i
                        class="fa-regular fa-paper-plane"></i></div>
            </div>
        </div>
        <div class="chat-option">
            <div class="option-icon">
                <i class="fa-solid fa-paperclip"></i>
            </div>
            <div class="option-icon">
                <i class="fa-solid fa-print"></i>
            </div>
            <div class="option-icon">
                <i class="fa-regular fa-envelope"></i>
            </div>
            <div class="option-icon">
                <i class="fa-solid fa-volume-high"></i>
            </div>
        </div>
        </div>
    </section>








    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper(".slide-content", {
        slidesPerView: 2,
        spaceBetween: 10,
        loop: true,
        autoplay: true,
        centerSlide: "true",
        fade: "true",
        grabCursor: "true",
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            0: {
                slidesPerView: 2,
            },
            520: {
                slidesPerView: 2,
            },
            950: {
                slidesPerView: 3,
            },
        },
    });
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
            url: "" + mode,
            type: "GET",
            async: true,
            cache: false
        });
    }
    </script>
    <script>
    // ---- ---- Const ---- ---- //
    let inputBox = document.querySelector('.search-box'),
        searchIcon = document.querySelector('.search'),
        closeIcon = document.querySelector('.close-icon');

    // ---- ---- Open Input ---- ---- //
    searchIcon.addEventListener('click', () => {
        inputBox.classList.add('open');
    });
    // ---- ---- Close Input ---- ---- //
    closeIcon.addEventListener('click', () => {
        inputBox.classList.remove('open');
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBox = document.querySelector('.search-box');
        const searchIcon = searchBox.querySelector('.search-icon');
        const closeIcon = searchBox.querySelector('.close-icon');
        const searchInput = searchBox.querySelector('.search-input');

        searchIcon.addEventListener('click', function() {
            searchBox.classList.add('active');
            searchInput.focus();
        });

        closeIcon.addEventListener('click', function() {
            searchBox.classList.remove('active');
            searchInput.value = ''; // Optional: Clear the input field when closing
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pills-home").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>


</body>


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered chat-modal">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                You are leaving the chat.
                Enter your email below if you wish to receive the chat transcript.

                <div class="email-input">
                    <input placeholder="Enter email address" type="email">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Leave</button>
                <button class="btn btn-primary" data-bs-target="" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered second-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">How did we do <span><i
                            class="fa-solid fa-question"></i></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="rate-box">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <span>Politeness:</span>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    <input disabled checked class="rating__input rating__input--none" name="rating3"
                                        id="rating3-none" value="0" type="radio">
                                    <label aria-label="1 star" class="rating__label" for="rating3-1"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
                                    <label aria-label="2 stars" class="rating__label" for="rating3-2"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
                                    <label aria-label="3 stars" class="rating__label" for="rating3-3"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
                                    <label aria-label="4 stars" class="rating__label" for="rating3-4"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">
                                    <label aria-label="5 stars" class="rating__label" for="rating3-5"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <span>Proficiency:</span>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    <input disabled checked class="rating__input rating__input--none" name="rating3"
                                        id="rating3-none" value="0" type="radio">
                                    <label aria-label="1 star" class="rating__label" for="rating3-1"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio">
                                    <label aria-label="2 stars" class="rating__label" for="rating3-2"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio">
                                    <label aria-label="3 stars" class="rating__label" for="rating3-3"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio">
                                    <label aria-label="4 stars" class="rating__label" for="rating3-4"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio">
                                    <label aria-label="5 stars" class="rating__label" for="rating3-5"><i
                                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio">
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <span>Why you rated this way:</span>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <textarea class="Comments"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered second-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Thank you!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="rate-box">
                    <p>We greatly appreciate your feedback</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="" data-bs-toggle="modal" data-bs-dismiss="modal">Close
                    Window</button>
            </div>
        </div>
    </div>
</div>


</html>