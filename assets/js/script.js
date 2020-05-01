const navCheck = (nav, offsetTop, navClass) => {
  let scrollTop = window.pageYOffset

  if(scrollTop >= offsetTop) {
    $(nav).removeClass(navClass)
  } else {
    $(nav).addClass(navClass)
  } 
}

$(document).ready(() => {
  
  if($(window).width() >= 1200) {
    let nav = $(".navigation")
    let navTop = $(nav).offset().top - 20

    if($(nav).hasClass("banner")) {
      navCheck(nav, navTop, "banner")
      $(document).scroll(() => {
        navCheck(nav, navTop, "banner")
      })
    }
  }

  $(".distributor-slider").slick({
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 5,
    slidesToScroll: 2,
    arrows: true,
    prevArrow: document.querySelector(".distributor-controls #left"),
    nextArrow: document.querySelector(".distributor-controls #right"),
    responsive: [
      {
        breakpoint: 1360,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 530,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 425,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  })
  $(".departments-container").slick({
    infinite: false,
    slidesToScroll: 3,
    variableWidth: true,
    arrows: false
  })
  $(".container-header-slider").slick({
    adaptiveHeight: true,
    autoplay: true,
    autoplaySpeed: 3000,
    infinite: true,
    arrows: true,
    prevArrow: document.querySelector(".container .slide .controls").children[0],
    nextArrow: document.querySelector(".container .slide .controls").children[1]
  })
})