window.addEventListener("load", () => {
  
  window.addEventListener("scroll", () => {
    let scrollTop = window.pageYOffset
    let nav = document.querySelector(".navigation")
    if(scrollTop >= 400) {
      nav.classList.remove("banner")
    } else {
      nav.classList.add("banner")
    }
  })

})