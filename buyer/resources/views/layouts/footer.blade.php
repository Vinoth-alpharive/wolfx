<?php
if(isset($atitle)){ 
    switch($atitle){
      case 'dashboard':
      $active = "dashboard";
      break;
      case 'exchange':
      $active = "exchange";
      break;
      case 'history':
      $active = "history";
      break;
      case 'profile':
      $active = "profile";
      break;
    }
}else{
	$active = "";
}
?>
<footer>
    <div class="nav-bars">
        <ul>
            <li class="nav-item">
                <div class="nav-direct-page">
                    <div class="home-svg @if($active == 'dashboard') active @endif">
                        <a href="{{url('dashboard')}}" class="nav-link">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_137_502)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.35288 7.82617C4 8.56983 4 9.41585 4 11.1079V16.3923C4 18.7421 4 19.9171 4.75315 20.6471C5.46843 21.3404 6.59771 21.3752 8.78613 21.377V15.1462C8.78613 13.8764 9.83913 12.9 11.0718 12.9H14.929C16.1617 12.9 17.2147 13.8764 17.2147 15.1462V21.377C19.4026 21.3752 20.5317 21.3403 21.2468 20.6471C22 19.9171 22 18.7421 22 16.3923V11.1079C22 9.41585 22 8.56983 21.6471 7.82617C21.2942 7.08251 20.6315 6.53193 19.3061 5.43077L18.0204 4.36259C15.6247 2.37225 14.4268 1.37708 13 1.37708C11.5732 1.37708 10.3753 2.37225 7.97961 4.36259L6.6939 5.43077C5.36847 6.53193 4.70576 7.08251 4.35288 7.82617ZM15.2147 21.3771V15.1462C15.2147 15.0394 15.1164 14.9 14.929 14.9H11.0718C10.8844 14.9 10.7861 15.0394 10.7861 15.1462V21.3771H15.2147Z" fill="#000" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_137_502">
                                        <rect width="23.173" height="23.173" fill="white" transform="translate(0.955078)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Home</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-direct-page">
                    <div class="home-svg @if($active == 'exchange') active @endif">
                        <a href="{{url('exchange')}}" class="nav-link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.43937 4.35257L4.2727 8.51924M4.2727 8.51924L8.43937 12.6859M4.2727 8.51924L16.7727 8.51924" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.7725 11.0192L20.9392 15.1859M20.9392 15.1859L16.7725 19.3526M20.9392 15.1859L8.43921 15.1859" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Exchange</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-direct-page">
                    <div class="home-svg @if($active == 'history') active @endif">
                        <a href="{{url('exchange-history')}}" class="nav-link">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.2501 10.5417C18.678 10.5417 20.0005 10.9921 21.0834 11.7492V7.66666C21.0834 6.60291 20.2305 5.74999 19.1667 5.74999H15.3334V3.83332C15.3334 2.76957 14.4805 1.91666 13.4167 1.91666H9.58341C8.51966 1.91666 7.66675 2.76957 7.66675 3.83332V5.74999H3.83341C2.76966 5.74999 1.92633 6.60291 1.92633 7.66666L1.91675 18.2083C1.91675 19.2721 2.76966 20.125 3.83341 20.125H11.1934C10.7072 19.1029 10.4877 17.9744 10.5553 16.8446C10.6229 15.7149 10.9755 14.6206 11.5802 13.6638C12.1848 12.7071 13.0219 11.919 14.0133 11.3731C15.0048 10.8271 16.1183 10.5411 17.2501 10.5417ZM9.58341 3.83332H13.4167V5.74999H9.58341V3.83332Z" fill="black" />
                                <path d="M17.2499 12.4583C14.6049 12.4583 12.4583 14.605 12.4583 17.25C12.4583 19.895 14.6049 22.0417 17.2499 22.0417C19.8949 22.0417 22.0416 19.895 22.0416 17.25C22.0416 14.605 19.8949 12.4583 17.2499 12.4583ZM18.8312 19.5021L16.7708 17.4417V14.375H17.7291V17.0488L19.502 18.8217L18.8312 19.5021Z" fill="black" />
                            </svg>
                            Orders</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-direct-page">
                    <div class="home-svg @if($active == 'profile') active @endif">
                        <a href="{{url('profile')}}" class="nav-link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_137_513)">
                                    <path d="M19.9886 20.2682C20.5842 20.1483 20.9373 19.5231 20.6271 19.0007C19.9985 17.9421 19.0263 17.0117 17.79 16.2991C16.1628 15.361 14.169 14.8526 12.1179 14.8526C10.0668 14.8526 8.07304 15.361 6.4458 16.2991C5.20958 17.0117 4.23739 17.9421 3.60878 19.0007C3.29855 19.5231 3.65164 20.1483 4.24727 20.2682C9.44226 21.3139 14.7936 21.314 19.9886 20.2682Z" fill="#1E1E1E" />
                                    <circle cx="12.1179" cy="7.85257" r="6" fill="#1E1E1E" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_137_513">
                                        <rect width="23.173" height="23.173" fill="white" transform="translate(0.34375)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Profile</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</footer>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentPath = window.location.pathname.split("/").pop();

        document.querySelectorAll(".nav-item a").forEach((link) => {
            const linkPath = link.getAttribute('href');

            if (linkPath === currentPath) {

                link.parentElement.classList.add('active');
            }
        });
    });

</script>
