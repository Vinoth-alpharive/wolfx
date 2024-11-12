// dark mod anf light mode

const checkbox = document.getElementById("checkbox")
checkbox.addEventListener("change", () => {
  document.body.classList.toggle("dark")
})

// header open close menu


$(document).ready(function() {
    $('a.close-menu').click(function() {
        $(this).parent('.collapse').removeClass('show');
    });
    $('li.drop-down-menu-exch a').click(function() {
        $(this).siblings('.drop-down-list-exch').slideDown(200);
    });
    $('li.exch-close-menu-list a').click(function() {
        $('li.exch-close-menu-list').parent('.drop-down-list-exch')
            .slideUp(200);
    });
    $('li.drop-down-menu-clone a').click(function() {
        $(this).siblings('.drop-down-list-clone').slideDown(200);
    });
    $('li.clone-close-menu-list').click(function() {
        $('li.clone-close-menu-list').parent('.drop-down-list-clone')
            .slideUp(200);
    });
});

// tab section landing

$(".tab-link").click(function () {
    var tabID = $(this).attr("data-tab");

    $(this).addClass("active").siblings().removeClass("active");

    $("#tab-" + tabID)
      .addClass("active")
      .siblings()
      .removeClass("active");
  });

//   owl carousel


$(function() {
    // Owl Carousel
    var owl = $(".owl-carousel");
    owl.owlCarousel({
      items: 3,
      margin: 10,
      loop: true,
      nav: false,
       autoplay: true,
      responsive: {
                  0: {
                      items: 1
                  },
                  600: {
                      items: 2
                  },
                  1024: {
                      items: 3
                  },
                  1366: {
                      items: 4
                  }
              }
    });
  });
  
//   owlcarousel two

var owl = $(".owl-carousel");
owl.owlCarousel({
  items: 4,
  // items change number for slider display on desktop

  loop: true,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 3000,
  autoplayHoverPause: true,
});