@php $title = "Select Bank Account"; $atitle ="exchange"; @endphp
@include('layouts.headerlink')

<body class="reset-trans-pwd exchange-history bank-history">

    <main class="contain-width">
    @include('layouts.header')
        <div class="whole-bank-accnt">
            <section class="Authentication login">
                <div class="back-div">
                    <a href="{{url('sellcrypto')}}"><i class="fa-solid fa-arrow-left"></i></a>
                    <h5>Select Bank Account</h5>
                </div>
            </section>

            @forelse($bank as $data )
            <section class="select-bank">
                <div class="accnt-select">
                    <div class="acccnt-select">
                        <div class="whole-acctn-detail">

                            <div class="profile-icon-img">
                                <img src="{{url('image/exchange/profile-icon.png')}}" />
                            </div>

                            <div class="accnt-information">
                                <p><strong>Account No: {{$data->account_no ?? ''}}</strong></p>
                                <p>IFSC: {{$data->swift_code ?? ''}}</p>
                                <p>Account Name: {{$data->account_name ?? ''}}</p>
                            </div>
                        </div>
                            <div class="select-checkbox">
                                <input type="checkbox" class="setPrimary" value="{{$data->id ?? ''}}" />
                            </div>
                    </div>

                    <div class="create-time">
                        <label>Create time: {{$data->created_at}}</label>
                    </div>


                </div>
            </section>
            @empty
            <div class="no-record-cnt">
                <img src="{{'image/exchange/no-record-img.png'}}" />
                <p>No more data</p>
            </div>
            @endforelse
        </div>
        <div class="add-bank-acctn">
            <a href="{{url('add-bank')}}">
                Add bank account
            </a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.setPrimary').change(function() {
                if (this.checked) {
                    $.ajax({
                        url: 'set-primary-account'
                        , type: 'POST'
                        , data: {
                            accountId: $(this).val()
                            , _token: '{{ csrf_token() }}'
                        }
                        , success: function(data) {
                            if (data.success) {
                                window.location.href = data.redirectPath;
                            } else {
                                console.log('Failed to set as primary. Please try again.', data);
                            }
                        }
                        , error: function(xhr, status, error) {
                            console.log('AJAX Error: ' + status + error);
                        }
                    });
                }
            });
        });

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
</body>
</html>
