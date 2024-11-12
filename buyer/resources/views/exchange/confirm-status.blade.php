@php $title = "Seller Support";
$atitle = "seler support"; @endphp
@include('layouts.headerlink')

<body class="take-it-page confirm-page">

    <main class="contain-width p-0">
        <section class="take-it">


            <div class="back-div support-back">
                <a href="{{url('/')}}"><img src="{{ url('image/previous-arrow.svg') }}" alt="previous-arrow"></a>
            </div>
            <div class="upload-screen-shot">
                <label>
                    <img id="img-preview" onload="showToast()" src="{{ url('image/image-uplad-bg.png') }}" />
                </label>

            </div>
            <div class="acc-details-card seller-details" id="card-to-copy">
                <div class="acc-details-card-content">
                    <p>John Doe</p>
                    <p>2345 5678 1234 3040</p>
                    <p>IFSC98765</p>
                    <p>500000 INR</p>
                </div>

            </div>




            <div class="submit-btn">
                <button class="take-it-btn">Confirm</button>
                <button class="take-it-btn">Deny</button>
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



    <!-- Custom JavaScript -->


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>

    <script>
    function copyToClipboard() {
        const cardContent = document.querySelector('#card-to-copy .acc-details-card-content').innerText;

        // Create a temporary textarea element to hold the text
        const textarea = document.createElement('textarea');
        textarea.value = cardContent;
        document.body.appendChild(textarea);

        // Select the text in the textarea and copy it
        textarea.select();
        document.execCommand('copy');

        // Remove the textarea from the DOM
        document.body.removeChild(textarea);

        alert('Card content copied to clipboard!');
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