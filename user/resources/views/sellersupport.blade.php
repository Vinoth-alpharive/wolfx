<?php include('define.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOLFX | Register</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- intl-tel-input CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/common.css">
    <link rel="stylesheet" href="assets/css/user_new.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="seller-support-page">

    <main class="contain-width p-0">
        <section class="seller-support">

            <div class="back-div support-back">
                <a href="index"><img src="{{ url('image/previous-arrow.svg') }}" alt="previous-arrow"></a>
            </div>

            <div class="sell-support-blocks">
                <div class="seller-support-block network-box deposit-value">
                    <div class="seller-support-left seller-details">
                        <h3 class="seller-name">John Doe</h3>
                        <p>**** **** **** 3040</p>
                        <p>IFSC*****</p>
                        <p>500000 INR</p>

                    </div>
                    <div class="seller-support-right">
                        <a class="take-it-btn" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Take
                            it</a>
                    </div>
                </div>
                <div class="seller-support-block network-box deposit-value">
                    <div class="seller-support-left seller-details">
                        <h3 class="seller-name">John Doe</h3>
                        <p>**** **** **** 3040</p>
                        <p>IFSC*****</p>
                        <p>500000 INR</p>

                    </div>
                    <div class="seller-support-right">
                        <a class="take-it-btn" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Take
                            it</a>
                    </div>
                </div>
                <div class="seller-support-block network-box deposit-value">
                    <div class="seller-support-left seller-details">
                        <h3 class="seller-name">John Doe</h3>
                        <p>**** **** **** 3040</p>
                        <p>IFSC*****</p>
                        <p>500000 INR</p>

                    </div>
                    <div class="seller-support-right">
                        <a class="take-it-btn" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Take
                            it</a>
                    </div>
                </div>
            </div>

        </section>
    </main>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered take-it-popup">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="seller-details">
                        <h3 class="seller-name">John Doe</h3>
                        <p>**** **** **** 3040</p>
                        <p>IFSC*****</p>
                        <p>500000 INR</p>

                    </div>
                </div>
                <div class="modal-footer">
                    <a class="take-it-btn" href="take-it">Confirm</a>
                </div>
            </div>
        </div>
    </div>


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



    <!-- Custom JavaScript -->


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>


    <script>
    const input = document.querySelector("input");
    const preview = document.querySelector(".preview");
    const para = document.querySelector(".no-pic");
    const image = document.querySelector(".profile-img");
    input.addEventListener("change", updateImageDisplay);

    function updateImageDisplay() {
        para.style.display = "none";
        const curFiles = input.files;
        image.src = URL.createObjectURL(curFiles[0]);
        image.style.opacity = 1;
    }
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

</body>

</html>