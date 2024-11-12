@php $title = "Exchange"; $atitle ="exchange"; @endphp
@include('layouts.headerlink')

<body class="exchange-full">
    <main class="contain-width">
        @include('layouts.header')
        @include('layouts.profile-head')
        <section class="platform-price">
            <div class="platform-price-head">
                <h1>Platform price</h1>
                <!-- <div class="refresh-btn" id="refreshButton">
                    <i class="fa-solid fa-rotate-right"></i>
                </div> -->
            </div>
            <div class="platform-exchange">
                @forelse($category as $data)

                <div class="adv-card">
                    <div class="full-support">
                        <button type="button" class="btn btn-outline-dark">{{$data->name ?? ''}}</button>
                        <!-- <i class="fa-solid fa-circle-info" style="cursor:pointer;"></i> -->
                        <!-- <div class="sell-price-hover text-end">
                            <span>Sell price</span>
                        </div> -->
                        <!-- <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Sell price" style="background: transparent; border: none;">
                            <i class="fa-solid fa-circle-info" style="cursor:pointer;"></i>  
                        </button> -->
                        <i class="fa-solid fa-circle-info" style="cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{strip_tags($data->info) ?? ''}}"></i>
                    </div>

                    <div class="full-support">
                        <div class="platform-cnt">
                            <h5>{{$data->price ?? ''}}</h5>
                            <p><span>1 USDT= {{$data->price ?? ''}}</span></p>
                        </div>
                        <button type="button" value={{$data->type}} class="btn btn-outline-dark select-button">Select</button>
                    </div>
                </div>

                @empty
                <div class="full-support">
                    <div class="platform-cnt">
                        <p><span>1 USDT=</span></p>
                    </div>
                    <button type="button" class="btn btn-outline-dark">Select</button>
                </div>
                @endforelse

            </div>

            <div class="platform-exchange">
                {{-- <div class="adv-card">
                    <div class="full-support">
                        <div class="platform-cnt">

                            <h5>Exchanges(S)</h5>
                            <p><span>1075.27</span> and <span>2150.57</span></p>
                        </div>

                        <div class="platform-cnt">
                            <h5>Price</h5>
                            <p>930+.25</p>
                        </div>

                    </div>
                </div> --}}
                @if($showPopup)
                <div id="sell-btn" class="sell-btn">
                    <button id="sellBtn" disabled>Sell USDT</button>
                </div>
                @else
                <div class="sell-btn">
                    <a href="{{url('sellcrypto')}}">
                        <button id="sellBtn" disabled>Sell USDT</button>
                    </a>
                </div>
                @endif
            </div>

        </section>

        <section class="dep-with">
            <div class="deposit-withdraw-col">
                <div class="deposit-box">
                    <a href="{{url('deposit')}}">
                        <div class="dep-img">
                            <img src="{{('image/exchange/deposit-1.svg')}}">
                        </div>
                        Deposit
                    </a>
                </div>
                <div class="deposit-box">
                    <a href="{{url('withdraw')}}">
                        <div class="dep-img">
                            <img src="{{('image/exchange/deposit-2.svg')}}">
                        </div>
                        Withdraw
                    </a>
                </div>
                <div class="deposit-box">
                    <a href="{{url('invite-friends')}}">
                        <div class="dep-img">
                            <img src="{{('image/exchange/deposit-3.svg')}}">
                        </div>
                        Invite
                    </a>
                </div>
            </div>

        </section>

        <div class="set-password-box">
            <div class="transaction-head">
                <div class="mobile-tab-buy-sell-close-btn"><i class="fa-solid fa-xmark"></i></div>
                <div class="set-up-img">
                    <img src="{{url('image/exchange/set-up.svg')}}">
                </div>
                <h3>Set up transaction Password </h3>
            </div>
            <p>After getting transaction password you can more conviently carry out withdrawal, Sell USDT and other
                business operations</p>
            <div class="set-up">
                <a href="{{url('transaction-password')}}">Set up now</a>
            </div>
        </div>
        <div class="policy-box">
            <div class="transaction-head">
                <div class="mobile-tab-buy-sell-close-btn"><i class="fa-solid fa-xmark"></i></div>
                <h3>What is tiered price policy?</h3>
            </div>
            <p>In order to help users maximize their profits in the shortest possible time, we will launch a tiered
                exchange price discount policy.</p>
            <div class="set-up">
                <a href="">Yes, I Know</a>
            </div>
        </div>
        @include('layouts.footer')
    </main>
    @include('layouts.footerlink')
    <script>
        // Initialize tooltips
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(tooltip => {
            new bootstrap.Tooltip(tooltip);
        });

    </script>

    <script>
        //     $(document).ready(function() {
        //     $('.select-button').on('click', function() {
        //         $('.adv-card').toggleClass('active');
        //     });
        // });


        $(document).ready(function() {
            $('.select-button').on('click', function() {
                // Remove the active class from all adv-cards
                $('.adv-card').removeClass('active');

                // Add the active class to the parent adv-card of the clicked button
                $(this).closest('.adv-card').addClass('active');
            });
        });

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectButtons = document.querySelectorAll('.select-button');
            const sellBtn = document.getElementById('sellBtn');

            selectButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Enable the Sell USDT button when any "Select" button is clicked
                    sellBtn.disabled = false;
                });
            });
        });

    </script>
</body>

</html>
