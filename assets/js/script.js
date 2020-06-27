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

const handleQuantity = (o) => {
  let itemBox = document.querySelector("#product-quantity")
  let itemCount = Number(itemBox.innerHTML)
  let maxItems = itemBox.getAttribute("data-stock")

  if (o == "+" || o == "-") {
    if (o == "+") {
      if (itemCount >= maxItems) {
        if (maxItems == 0) {
          itemBox.innerHTML = 0
        } else {
          itemBox.innerHTML = maxItems
        }
      } else {
        itemBox.innerHTML = itemCount + 1
      }
    }

    if (o == "-") {
      if (itemCount <= 1) {
        if (maxItems == 0) {
          itemBox.innerHTML = 0
        } else {
          itemBox.innerHTML = 1
        }
      } else {
        itemBox.innerHTML = itemCount - 1
      }
    }
  }

}

let getUrl = window.location
let baseUrl = getUrl.protocol + "//" + getUrl.host + "/"

const clienteLogin = (e) => {
  e.preventDefault()

  const login = document.getElementById("login").value
  const password = document.getElementById("password").value
  
  $.ajax({
    type: "POST",
    url: baseUrl+"cliente/login",
    data: {
      "login": login,
      "password": password
    },
    success: function (r) {
      console.log(r)
      res = JSON.parse(r)
      Swal.fire({
        icon: res.status,
        text: res.message,
        onClose: () => {
          if (res.status == "success") {
            location.reload()
          }
        }
      })
    }
  });
}

const checkout = (btn) => {
  const addressId = btn.getAttribute("data-addressId")

  $.ajax({
    type: "POST",
    url: baseUrl+"checkout/order",
    data: {
      "addressId": addressId
    },
    success: function (r) {
      let res = JSON.parse(r)
      Swal.fire({
        icon: res.status,
        text: res.message,
        onClose: () => {
          if (res.status == "success") {
            location.href = baseUrl+"cliente/dashboard"
          }
        }
      })
    }
  });
}

const addCart = (id) => {
  let itemBox = document.querySelector("#product-quantity")
  let quantity = Number(itemBox.innerHTML)
  let add = {
    "id": id,
    "quantity": quantity
  }

  $.ajax({
    type: "POST",
    url: baseUrl+"addcart/add",
    data: {
      "data": add
    },
    success: function (res) {
      Swal.fire({
        icon: 'success',
        text: 'Produto adicionado ao carrinho de compras!',
        allowOutsideClick: false,
        onClose: () => {
          location.href = baseUrl+"carrinho"
        }
      })
    }
  });
}

const removeCart = (id) => {
  $.ajax({
    type: "POST",
    url: baseUrl+"addcart/remove",
    data: {
      "id": id
    },
    success: function (res) {
      Swal.fire({
        icon: 'success',
        text: 'Produto removido do carrinho de compras!',
        onClose: () => {
          location.reload()
        }
      })
    }
  });
}

const productSearch = (value, e) => {
  if (e.keyCode === 13) {
    location.href = baseUrl+"produtos/pesquisa/"+value
  }
}

const openSub = (box, e) => {
  if (e.path[0] != $(box).children("ul").children("li").children("input")[0]) {
    $(box).children("ul").fadeToggle()
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

  if($(window).width() <= 960) {
    const mobileBtn = $("#mobile")
    const nav = $("#mobileNav")
    $(mobileBtn).click(() => {
      $(nav).slideToggle()
    })

    $(".navigation .submenu").click(function() {
      $(this).toggleClass("active")
    })
  } else {
    $(".navigation .submenu").hover(function() {
      $(this).toggleClass("active")
    })
  }

  $(window).resize(() => {
    if($(window).width() > 960) {
      const nav = $("#mobileNav")
      $(nav).removeAttr("style")
    }
  })
  
  $(".products-container-sidebar .sidebar-box span").click(function(e) {
    
    $(this).parent().toggleClass("open")

    let h = this.parentElement.children[1].scrollHeight

    if($(this).parent().hasClass("open")) {
      $(this).parent().children(".sidebar-items").css("max-height", h)
    } else {
      $(this).parent().children(".sidebar-items").removeAttr("style")
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