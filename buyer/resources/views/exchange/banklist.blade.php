@php $title = "Select Bank Account"; $atitle ="exchange"; @endphp
@include('layouts.headerlink')

<body class="reset-trans-pwd exchange-history bank-history">

    <main class="contain-width">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
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
</body>
</html>
