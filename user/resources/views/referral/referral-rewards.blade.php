@include('layouts.headerlink')

<body class="referral">

    <main class="contain-width">
    @include('layouts.header')
        <div class="referral-head">
            <div class="back-div">
                <a href="profile"><img src="{{url('image/previous-arrow.svg')}}" alt="previous-arrow"></a>
                <div class="ref-head">Referrals reward</div>
            </div>
        </div>

        <ul class="profile-inner-links">
            <li class="ref-table-head"><div>Date</div> <div class="reward">Reward <span>{{@$total_rewards_count}}</span></div></li>
            @if(isset($total_rewards) && $total_rewards != "")
                @foreach($total_rewards as $reward)
                    <li>
                        <a href="#">
                            <div class="link-key">{{date('d M Y',strtotime($reward->created_at))}}</div>
                            <div>{{$reward->price}}</div>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
  
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
    $(".payx").click(function() {
        // add alert class
        $(".about-payx").addClass("alert");
        // $("main").addClass("blur");
        // Close all open windows
        $(".about-payx").stop().slideUp(300);
        // Toggle this window open/close
        $(this).next(".about-payx").stop().slideToggle(300);
        //hitter test// 
        $(".hitter").show()
    });

    $(".hitter").click(function() {
        // Close all open windows
        $(".about-payx").stop().slideUp(300);
    });
    // remove alert class
    $(".btn-close").click(function() {
        $(".about-payx").stop().slideUp(300);
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