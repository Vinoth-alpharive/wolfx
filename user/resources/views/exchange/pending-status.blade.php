@php $title = "Seller Support";
$atitle = "seler support"; @endphp
@include('layouts.headerlink')
<body class="pending-status-page seller-support-page">
    <main class="contain-width p-0">
        <section class="pending-status">
            <div class="back-div support-back">
                <a href="{{url('/processing')}}"><img src="{{ url('image/previous-arrow.svg') }}" alt="previous-arrow"></a>
            </div>
            <h2>Buyer payment
                processing...</h2>
            <div class="sell-support-blocks">
                @forelse($pending as $data)
                <div class="seller-details network-box deposit-value">
                    <h3 class="seller-name">{{$data->buyername}}</h3>
                    <p>{{$data->account_name}}</p>
                    <p>{{$data->ifsc}}</p>
                    <p>{{$data->account_number}}</p>
                    <span>Processing</span>
                </div>
                @empty
                no record Found
                @endforelse
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
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
                url: "" + mode
                , type: "GET"
                , async: true
                , cache: false
            });
        }

    </script>
</body>
</html>
