function login(email, password) {
  var myHeaders = new Headers();
  myHeaders.append("Accept", "application/json");
  myHeaders.append("Content-Type", "application/json");


  var raw = JSON.stringify({
    "email": email,
    "password": password
  });

  var requestOptions = {
    method: 'POST',
    headers: myHeaders,
    body: raw,
    redirect: 'follow'
  };

  loading();

  fetch(url + 'login', requestOptions)
    .then(response => response.json())
    .then(result => {
      Swal.close();
      guardarToken(result);
    })
    .catch(error => {
      console.log('error', error);
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Ocorreu um erro ao realizar o login'
      });
    });
}


function Vendedorcreate(email, senha, nome) {

  var myHeaders = new Headers();
  myHeaders.append("Accept", "application/json");
  myHeaders.append("Content-Type", "application/json");
  myHeaders.append("Authorization", "Bearer " + localStorage.getItem('token'));

  var raw = JSON.stringify({
    "email": email,
    "password": senha,
    "name": nome,
  });

  var requestOptions = {
    method: 'POST',
    headers: myHeaders,
    body: raw,
    redirect: 'follow'
  };

  loading();

  fetch(url + 'user', requestOptions)
    .then(response => response.json())
    .then(result => validacreate(result, email, senha))
    .catch(error => console.log('error', error));
}


function validacreate(result, email, senha) {
  Swal.close();
  if (result.message == "criado") {
    Swal.fire({
      icon: 'success',
      title: 'Sucesso',
      text: 'Cadastro realizado você será redirecionado para a tela de login'

    });
    setTimeout(function () {
      login(email, senha);
    }, 2000);
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: result.message
    });
  }
}



function guardarToken(result) {
  // verifica se o token existe
  if (result.token) {
    localStorage.setItem('token', result.token);
    window.location.href = "dashbord.html";
  } else {
    if (result.message == "Unauthorized") {
      Swal.fire({
        icon: 'info',
        title: 'Oops...',
        text: 'Email ou senha incorretos'
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: result.message
      });
    }
  }
}

