<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-10">
              <h3 class="mb-0">Cadastrando pedido</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="/admin/produto/editar" enctype="multipart/form-data">
            <div class="pl-lg-4">

              <div class="row">
                <div class="col-lg-2">
                  <div class="form-group">
                    <input type="number" class="form-control" placeholder="Id do produto" onfocusout="findProduct(value)">
                  </div>
                </div>

                <div class="col-lg-2" id="qnt">
                </div>

                <div class="col-lg-2" id="btn">
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <br><br>

  <script>

  let qntStatus = 0
  let btnStatus = 0

  let product = []
  let productQnt = 0

    function createBtn() {

      let div = document.createElement("div")
      div.classList.add("btn")
      div.classList.add("btn-icon")
      div.classList.add("btn-primary")

      let spanIcon = document.createElement("span")
      spanIcon.classList.add("btn-inner--icon")
      let icon = document.createElement("i")
      icon.classList.add("fas")
      icon.classList.add("fa-plus")
      spanIcon.appendChild(icon)

      let spanText = document.createElement("span")
      spanText.classList.add("btn-inner--text")
      spanText.appendChild(document.createTextNode("Adicionar"))

      div.appendChild(spanIcon)
      div.appendChild(spanText)

      btn.addEventListener("click", () => {btnClickHandler()})

      btnStatus = 1

      return div
    }

    function createQntInput() {

      let div = document.createElement("div")
      div.classList.add("form-group")

      let input = document.createElement("input")
      input.classList.add("form-control")
      input.setAttribute("type", "number")
      input.setAttribute("placeholder", `Quantidade 1 ~ ${product.product_stock}`)
      
      div.appendChild(input)

      div.addEventListener("keyup", e => {setQnt(e)})

      qntStatus = 1

      return div
    }

    function findProduct(value) {
      // qntStatus = 0
      // btnStatus = 0
      // product = []
      // productQnt = 0

      let apiUrl = `${baseUrl}admin/produtos/getById/${value}`
      
      fetch(apiUrl, {method: "POST"})
        .then(res => res.json())
        .then(res => {
          if (qntStatus == 0) {
            let qnt = document.querySelector("#qnt")

            product = res

            qnt.appendChild(createQntInput())
          }
        })
    }

    function setQnt(e) {
      let value = e.target.value

      productQnt = value

      if (btnStatus == 0) {
        let btn = document.querySelector("#btn")

        btn.appendChild(createBtn())
      }
    }

    function btnClickHandler() {
      console.log(product)
      console.log(productQnt)

      if (productQnt < 0 || parseInt(productQnt) > parseInt(product.product_stock)) {
        Swal.fire({
          icon: "error",
          title: "Opss!",
          text: `O estoque desse produto é ${product.product_stock} e você escolheu ${productQnt}`
        })
      } else if (productQnt == 0) {
        Swal.fire({
            icon: "error",
            title: "Opss!",
            text: `A quantidade deve ser maior que 0`
          })
      } else {

      }
    }

  </script>