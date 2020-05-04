const navCheck = (nav, offsetTop, navClass) => {
  let scrollTop = window.pageYOffset

  if(scrollTop >= offsetTop) {
    $(nav).removeClass(navClass)
    $(nav).css("position", "fixed")
    $(nav).css("top", "initial")
  } else {
    $(nav).addClass(navClass)
    $(nav).css("position", "absolute")
    $(nav).css("top", offsetTop + "px")
  } 
}

$(document).ready(() => {
  
  if($(window).width() >= 1200) {
    let nav = $(".navigation")
    let navTop = $(nav).offset().top

    if($(nav).hasClass("banner")) {
      $(nav).css("position", "absolute")
      $(nav).css("top", navTop + "px")
      navCheck(nav, navTop, "banner")
      $(document).scroll(() => {
        navCheck(nav, navTop, "banner")
      })
    }
  }
  
  $(".navigation .submenu").hover(function() {
    $(this).toggleClass("active")
  })
  
  $(".products-container-sidebar .sidebar-box").click(function() {
    
    $(this).toggleClass("open")
    let h = this.children[1].scrollHeight
    if($(this).hasClass("open")) {
      $(this).children(".sidebar-items").css("max-height", h)
    } else {
      $(this).children(".sidebar-items").removeAttr("style")
    }

  })

  if($(".distributor-slider").length > 0) {
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
  }

  if($(".departments-container").length > 0) {
    $(".departments-container").slick({
      infinite: false,
      slidesToScroll: 3,
      variableWidth: true,
      arrows: false
    })
  }

  if($(".container-header-slider").length > 0) {
    $(".container-header-slider").slick({
      adaptiveHeight: true,
      autoplay: true,
      autoplaySpeed: 3000,
      infinite: true,
      arrows: true,
      prevArrow: document.querySelector(".container .slide .controls").children[0],
      nextArrow: document.querySelector(".container .slide .controls").children[1]
    })
  }

})

const readerSlide = () => {
  $("#reader-pictures").slick({
    infinite: true,
    centerMode: true,
    arrows: false,
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 550,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  })
}