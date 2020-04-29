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