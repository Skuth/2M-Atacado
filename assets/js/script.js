window.addEventListener("load", () => {

  let nav = document.querySelector(".navigation")
  if(nav.classList.contains("banner")) {
    navCheck(nav, 400, "banner")
    window.addEventListener("scroll", () => {navCheck(nav, 400, "banner")})
  }

})

const navCheck = (nav, offsetTop, navClass) => {
  let scrollTop = window.pageYOffset

  if(scrollTop >= offsetTop) {
    nav.classList.remove(navClass)
  } else {
    nav.classList.add(navClass)
  } 
}

$(document).ready(() => {
  $(".distributor-slider").slick({
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: document.querySelector(".distributor-controls #left"),
    nextArrow: document.querySelector(".distributor-controls #right"),
    responsive: [
      {
        breakpoint: 1360,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
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
        breakpoint: 375,
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
})