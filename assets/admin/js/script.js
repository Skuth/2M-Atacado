window.addEventListener("load", () => {
  registerSW()
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

let getUrl = window.location
let baseUrl = getUrl.protocol + "//" + getUrl.host + "/"

const showNotification = () => {
  const notification = new Notification("Nova venda", {
    body: "Você acabou de vender um produto! \n Clique para visualizar",
    icon: baseUrl+"assets/icons/android-chrome-192x192.png"
  })

  notification.onclick = (e) => {
    window.location.href = baseUrl + "admin/pedidos/aberto"
  }
}

const verifyNotification = () => {
  $.ajax({
    type: "POST",
    url: baseUrl+"api/notification",
    success: function (r) {
      let res = JSON.parse(r)
      
      if(res.status >= 1) {
        showNotification()

        $.ajax({
          type: "POST",
          url: baseUrl+"api/notification/reset",
        })
      }
    }
  })

  setTimeout(() => {
    verifyNotification()
  }, 1000);
}

if (Notification.permission === "granted") {
  
  verifyNotification()

} else if (Notification.permission !== "denied") {
  Notification.requestPermission().then(permission => {
    console.log(Notification.permission)

    if (permission === "granted") {
      verifyNotification()
    }
    
  })
}

const generateKey = () => {
  const apiUrl = baseUrl+"admin/clientes/chave"

  Swal.queue([{
    title: 'Chave de registro',
    confirmButtonText: 'Gerar link',
    text:
    'Deseja criar uma chave de registro?',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return fetch(apiUrl, {method: "POST"})
      .then(response => response.json())
      .then(data => {
        Swal.fire({
          title: "Chave de registro",
          input: 'text',
          inputValue: data
        })
      })
      .catch(() => {
        Swal.insertQueueStep({
          icon: 'error',
          title: 'Falha ao gerar chave'
        })
      })
    }
  }])
}

const productSearch = (value, e) => {
  if (e.keyCode === 13) {
    value = value.replace(/\//g, "-")
    value = encodeURI(value)
    value = value.toLowerCase()

    console.log(value)

    if (value.length > 0) {
      location.href = baseUrl+"admin/produtos?s="+value
    }
  }
}