let preLoader = $(".preloader")
let preloaderBar = $(".preloader #bar")
let load = Math.floor(Math.random() * 70)

let body = $("body")
body.scrollTop(0)
body.css("overflow", "hidden")

preloaderBar.css("width", `${load}%`)

window.addEventListener("load", () => {
  registerSW()
  setTimeout(() => {
    preloaderBar.css("width", "100%")
    window.scroll(0, 0)
    setTimeout(() => {
      preLoader.fadeOut()
      body.removeAttr("style")
      navCheck()
    }, 1000);
  }, 1000)
})

async function registerSW() {
  if ("serviceWorker" in navigator) {
    try {
      await navigator.serviceWorker.register("./sw.js")
    } catch (e) {
      console.log("SW registration falied")
    }
  }
}

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
  })
}

const pickUpDate = (date) => {
  const btn = document.querySelector("#checkout-btn")
  btn.setAttribute("data-pickupdate", date)
}

const checkout = (btn) => {
  const addressId = btn.getAttribute("data-addressId")
  const pType = btn.getAttribute("data-paymenttype")
  const pickUpDate = btn.getAttribute("data-pickupdate")

  $.ajax({
    type: "POST",
    url: baseUrl+"checkout/order",
    data: {
      "addressId": addressId,
      "pType": pType,
      "pickUpDate": pickUpDate
    },
    success: function (r) {
      let res = JSON.parse(r)

      if(res.status == "success") {
        $.ajax({
          type: "POST",
          url: baseUrl+"api/notification/update",
        })
      }

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
  })
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
  })
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
  })
}

const productSearch = (value, e) => {
  if (e.keyCode === 13) {
    value = value.replace(/\//g, "-")
    value = encodeURI(value)
    value = value.toLowerCase()

    console.log(value)

    if (value.length > 0) {
      location.href = baseUrl+"produtos/pesquisa/"+value
    }
  }
}

const openSub = (box, e) => {
  if (e.path[0] != $(box).children("ul").children("li").children("input")[0]) {
    $(box).children("ul").fadeToggle()
  }
}

const switchForm = (box, e) => {
  const target = e.target
  const targetAttr = target.getAttribute("id")
  const form1 = $("#form-0")
  const form2 = $("#form-1")

  const btns = box.children

  if (target.getAttribute("id") != null) {

    if (targetAttr == 0) {
      $(form1).addClass("form-active")
      $(form2).removeClass("form-active")
    } else {
      $(form1).removeClass("form-active")
      $(form2).addClass("form-active")
    }
  
    for (let i = 0; i < btns.length; i++) {
      const e = btns[i]
      const attr = e.getAttribute("id")
      $(e).removeClass("btn-blue")
  
      if (attr == targetAttr) {
        $(e).addClass("btn-blue")
      }
    }

  }
  
}

const clientRegister = (e, form) => {
  e.preventDefault()

  let values = {}

  $(form).serializeArray().map((v) => {
    values[v["name"]] = v["value"]
  })

  $.ajax({
    type: "POST",
    url: baseUrl+"cliente/cadastrar",
    data: {
      "data": values
    },
    success: function (res) {
      let r = JSON.parse(res)
      Swal.fire({
        title: 'Cadastro',
        icon: r.status,
        text: r.message,
        onClose: () => {
          if (r.status == "success") {
            location.href = baseUrl+"cliente/login"
          }
        }
      })
    }
  })
}

const setImage = (box) => {

  let imageBox = document.getElementById("product-image")
  let mainImgBox = imageBox.children[0]
  let imgSrc = box.getAttribute("src")

  mainImgBox.setAttribute("src", imgSrc)

}

const verifyCep = (cep) => {
  if(cep.length == 8) {
    const cepBox = document.querySelector("#cep")

    const cidade = document.querySelector("#cidade")
    const bairro = document.querySelector("#bairro")
    const rua = document.querySelector("#rua")

    let apiUrl = (cep) => `https://viacep.com.br/ws/${cep}/json/`

    $.ajax({
      type: "GET",
      url: apiUrl(cep),
      beforeSend: () => {
        cepBox.disabled = true
      },
      complete: () => {
        cepBox.disabled = false
      },
      success: (res) => {
        if (!res.erro) {
          if(res.uf == "RJ") {
            cidade.value = res.localidade
            bairro.value = res.bairro
            rua.value = res.logradouro
          } else {
            cepBox.value = ""
            cidade.value = ""
            bairro.value = ""
            rua.value = ""
            Swal.fire({
              icon: "error",
              title: "Endereço",
              text: "O endereço cadastrado precisa ser do Rio de Janeiro."
            })
          }
        }
      }
    })
  }
}

const clientAddressRegister = (e, form) => {
  e.preventDefault()

  let values = {}
  
  $(form).serializeArray().map((v) => {
    values[v["name"]] = v["value"]
  })

  $.ajax({
    type: "POST",
    url: baseUrl+"cliente/address/novo",
    data: {
      "values": values
    },
    success: (res) => {
      let r = JSON.parse(res)
      Swal.fire({
        title: 'Endereço',
        icon: r.status,
        text: r.message,
        onClose: () => {
          if (r.status == "success") {
            location.href = baseUrl+"cliente/dashboard"
          }
        }
      })
    }
  })
}

const updateNav = () => {
  var nav = $(".navigation")
  var navTop = $(".slide").height()

  if($(nav).hasClass("banner")) {
    $(nav).css("position", "absolute")
    $(nav).css("top", navTop + "px")
    navCheck(nav, navTop, "banner")
    $(document).scroll(() => {
      navCheck(nav, navTop, "banner")
    })
  }
}

$(window).resize(() => {
  if($(window).width() >= 1200) {
    updateNav()
  }
})

if($(window).width() >= 1200) {
    
  $(window).on("load", () => {
    updateNav()
  })

}

$(document).ready(() => {

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