{{-- footerlink.blade.php --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
<script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

<script>
    function setSellerDetails(element) {
        document.getElementById('sellerId').value = element.getAttribute('data-id');
        document.getElementById('modalSellerName').textContent = element.getAttribute('data-name');
        document.getElementById('modalPrice').textContent = element.getAttribute('data-price');
        // document.getElementById('modalQty').textContent = element.getAttribute('data-qty');
        document.getElementById('modalValue').textContent = element.getAttribute('data-value') + ' INR';
    }

</script>

<script>
    var swiper = new Swiper(".slide-content", {
        slidesPerView: 2
        , spaceBetween: 10
        , loop: true
        , autoplay: true
        , centerSlide: "true"
        , fade: "true"
        , grabCursor: "true"
        , pagination: {
            el: ".swiper-pagination"
            , clickable: true
            , dynamicBullets: true
        , }
        , navigation: {
            nextEl: ".swiper-button-next"
            , prevEl: ".swiper-button-prev"
        , }
        , breakpoints: {
            0: {
                slidesPerView: 1
            , }
            , 520: {
                slidesPerView: 2
            , }
            , 950: {
                slidesPerView: 3
            , }
        , }
    , });

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
            searchInput.value = '';
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

<script>
    function copyToClipboard() {
        const cardContent = document.querySelector('#card-to-copy .acc-details-card-content').innerText;
        const textarea = document.createElement('textarea');
        textarea.value = cardContent;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        alert('Card content copied to clipboard!');
    }

</script>

<script>
    const fileInput = document.getElementById("file-input");
    const imagePreview = document.getElementById("img-preview");

    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length) {
            const src = URL.createObjectURL(e.target.files[0]);
            imagePreview.src = src;
            showToast();
        }
    });

    function showToast() {
        const toast = document.getElementById("toast");
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 3000);
    }

</script>
<script>
    const fileInput = document.getElementById("file-input-2");
    const imagePreview = document.getElementById("img-preview-2");

    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length) {
            const src = URL.createObjectURL(e.target.files[0]);
            imagePreview.src = src;
            showToast();
        }
    });

    function showToast() {
        const toast = document.getElementById("toast");
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 3000);
    }

</script>

<script>
    function setSellerDetails(element) {

        document.getElementById('sellerId').value = element.getAttribute('data-id');
        document.getElementById('modalSellerName').textContent = element.getAttribute('data-name');
        document.getElementById('modalPrice').textContent = element.getAttribute('data-price');
        // document.getElementById('modalQty').textContent = element.getAttribute('data-qty');
        document.getElementById('modalValue').textContent = element.getAttribute('data-value') + ' INR';
    }

</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script>
    // Set Toastr options
    toastr.options = {
        "positionClass": "toast-top-right"
        , "closeButton": true
        , "timeOut": 3000
        , "showMethod": "fadeIn"
    , };

    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}');
    @endforeach
    @endif

    @if(session('error'))
    toastr.error('{{ session('
        error ')}}');
    @endif

    @if(session('success'))
    toastr.success('{{ session('
        success ') }}');
    @endif

    @if(session('status'))
    toastr.success('{{ session('
        status ') }}');
    @endif

</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();

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





<script>
        document.addEventListener('DOMContentLoaded', () => {
            let sectionCount = 1;
            // const maxSections = 2; // Set this to the maximum number of sections you want

            // Function to handle adding a new section
            const addSection = () => {
                sectionCount++;

                // Create a new upload section
                const newSection = document.createElement('div');
                newSection.className = 'upload-screen-shot';
                
                newSection.innerHTML = `
                    <label for="file-input-${sectionCount}">
                        <input id="file-input-${sectionCount}" name="slip1[]" type="file" />
                        <img id="img-preview-${sectionCount}" src="{{ url('image/upload-imgs.png') }}" />
                    </label>
                `;
                
                // Append the new section to the container
                document.getElementById('upload-container').appendChild(newSection);
                
                // Attach an event listener to the new file input
                document.getElementById(`file-input-${sectionCount}`).addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById(`img-preview-${sectionCount}`).src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Hide the button if the maximum number of sections has been reached
                // if (sectionCount >= maxSections) {
                //     document.getElementById('add-upload-section').style.display = 'none';
                // }
            };

            // Add initial file input event listeners
            document.querySelectorAll('input[type="file"]').forEach((input) => {
                input.addEventListener('change', function(event) {
                    const sectionId = event.target.id.split('-').pop();
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById(`img-preview-${sectionId}`).src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Attach click event to the button
            document.getElementById('add-upload-section').addEventListener('click', addSection);
        });
    </script>


<script>
    document.getElementById('refreshButton').addEventListener('click', function () {
        window.location.reload();
    });

</script>



<script>
    const pullToRefresh = document.querySelector('.pull-to-refresh');
let touchstartY = 0;
document.addEventListener('touchstart', e => {
  touchstartY = e.touches[0].clientY;
});
document.addEventListener('touchmove', e => {
  const touchY = e.touches[0].clientY;
  const touchDiff = touchY - touchstartY;
  if (touchDiff > 0 && window.scrollY === 0) {
    pullToRefresh.classList.add('visible');
    e.preventDefault();
  }
});
document.addEventListener('touchend', e => {
  if (pullToRefresh.classList.contains('visible')) {
    pullToRefresh.classList.remove('visible');
    location.reload();
  }
});
</script>