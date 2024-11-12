@php $title = "Seller Support";
$atitle = "seler support"; @endphp
@include('layouts.headerlink')

<body class="take-it-page">

    <main class="contain-width p-0">
        <section class="take-it">
            <!-- <a href="{{url('/')}}" class="auth-logo">
                <img src="assets/image/light-logo.png" class="light-logo img-fluid" alt="light-logo">
                <img src="assets/image/dark-logo.png" class="dark-logo img-fluid" alt="dark-logo">
        </a> -->

            <div class="back-div support-back">
                <a href="{{url('/')}}"><img src="{{ url('image/previous-arrow.svg') }}" alt="previous-arrow"></a>
            </div>
            <div class="acc-details-card network-box deposit-value seller-details" id="card-to-copy">
                <div class="acc-details-card-content">
                    <p>John Doe</p>
                    <p>2345 5678 1234 3040</p>
                    <p>IFSC98765</p>
                    <p>500000 INR</p>
                </div>
                <div class="copy-icon" onclick="copyToClipboard()">
                    <i class="fa-regular fa-copy"></i>

                </div>
            </div>
            <div class="seller-payment-option">
                <select>
                    <option value="google-pay">Google Pay</option>
                    <option value="paytm">Paytm</option>
                    <option value="phonepe">Phonepe</option>

                </select>
            </div>
            <input type="text" class="transaction-id" required placeholder="Transaction Id">
            <div class="upload-screen-shot">
                <label for="file-input">
                    <input id="file-input" type="file" />
                    <img id="img-preview" onload="showToast()" src="{{ url('image/image-uplad-bg.png') }}" />
                    <div class="auth-btn upload-ss-btn">Upload screenshot <span> <i
                                class="fa-solid fa-upload"></i></span></div>
                </label>

            </div>

            <div class="submit-btn">
                <button class="take-it-btn">Submit</button>
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
    const fileInput = document.getElementById("file-input");
    const imagePreview = document.getElementById("img-preview");
    const toast = document.getElementById("toast");

    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length) {
            const src = URL.createObjectURL(e.target.files[0]);
            imagePreview.src = src;
            showToast();
        }
    });

    function showToast() {
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 3000);
    }
    </script>

   <script>
    
    document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("checkbox");
            const body = document.body;

            // Retrieve mode from localStorage, default to dark mode
            let isDarkMode = localStorage.getItem("darkMode");
            if (isDarkMode === null) {
                isDarkMode = true; // Default to dark mode
                localStorage.setItem("darkMode", isDarkMode);
            } else {
                isDarkMode = (isDarkMode === "true");
            }

            // Apply the mode based on the retrieved or default value
            if (isDarkMode) {
                body.classList.add("dark");
                checkbox.checked = true;
            } else {
                body.classList.remove("dark");
                checkbox.checked = false;
            }

            checkbox.addEventListener("change", () => {
                const isChecked = checkbox.checked;

                if (isChecked) {
                    body.classList.add("dark");
                } else {
                    body.classList.remove("dark");
                }

                // Update localStorage
                localStorage.setItem("darkMode", isChecked);
                console.log(`Mode changed to: ${isChecked ? "dark" : "light"}`); // Debugging line
                // Send update to the server
                update_mode(isChecked ? "dark" : "light");
            });

            function update_mode(mode) {
        $.ajax({
            url: "" + mode
            , type: "GET"
            , async: true
            , cache: false
        });
            }
        });
  
   </script>
</body>

</html>