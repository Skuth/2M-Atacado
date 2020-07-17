let getUrl = window.location
let baseUrl = getUrl.protocol + "//" + getUrl.host + "/"

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
    location.href = baseUrl+"admin/produtos?s="+value
  }
}