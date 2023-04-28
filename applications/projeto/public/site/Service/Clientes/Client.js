loadingcliente();
function loadingcliente() {

    var myHeaders = new Headers();
    myHeaders.append("Accept", "application/json");
    myHeaders.append("Authorization", "Bearer " + getToken());

    var requestOptions = {
        method: 'get',
        headers: myHeaders,
        redirect: 'follow'
    };

    loading();

    fetch(url + 'clientes', requestOptions)
        .then(response => response.json())
        .then(result => inserthtml(result))
        .catch(error => console.log('error', error));

}


function inserthtml(result) {
    Swal.close();
    var html = '';
    result.forEach(element => {
        var email = element.email;
        var email = email.substring(0, 18) + '...';
        var param = "'" + element.id + "','" + element.nome + "','" + element.email + "'";
        html += '<li class="adobe-product"> <div class="products">' + element.nome + '</div>'
        html += '<span class="status"><span class="status-circle green"></span>' + email + '</span>'
        html += '<div class="button-wrapper">'
        html += '<button  onclick="editarmodal(' + param + ' )" class="content-button status-button open">Editar</button>'
        html += '<button  onclick="excluirmodal(' + element.id + ')" class="content-button status-button open">Excluir</button>'
        html += '<div class="menu">'
        html += '</div></div></li>'
    });

    document.getElementById('clientes').innerHTML = html;
}

function editar(id, nome, email) {

    var myHeaders = new Headers();
    myHeaders.append("Accept", "application/json");
    myHeaders.append("Content-Type", "application/json");
    myHeaders.append("Authorization", "Bearer " + getToken());

    var raw = JSON.stringify({
        "id": id,
        "nome": nome,
        "email": email
    });

    var requestOptions = {
        method: 'PUT',
        headers: myHeaders,
        body: raw,
        redirect: 'follow'
    };

    loading();


    fetch(url + 'clientes', requestOptions)
        .then(response => response.json())
        .then(result => validacaoedicao(result))
        .catch(error => console.log('error', error));
}

function validacaoedicao(result) {
    Swal.close();
    if (result.message == "atualizado") {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cliente Atualizado',
            showConfirmButton: false,
            timer: 1500
        })
        loadingcliente();
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: result.message
        });
    }
}


function editarmodal(id, nome, email) {
    const { value: formValues } = Swal.fire({
        icon: 'info',
        title: 'Editar Cliente: ' + nome,
        html:
            '<input id="swal-input1" placeholder="Nome" value=' + nome + ' class="swal2-input">' +
            '<input id="swal-input2" placeholder="Email" value=' + email + ' class="swal2-input">',
        focusConfirm: false,
        confirmButtonText: 'Editar',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        preConfirm: () => {
            editar(id, document.getElementById('swal-input1').value, document.getElementById('swal-input2').value);
        }
    })

    if (formValues) {
        Swal.fire(JSON.stringify(formValues))
    }
}

function excluirmodal(id) {
    Swal.fire({
        title: 'Deletar?',
        text: " Você tem certeza que deseja deletar este cliente?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, Delete!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            excluir(id);
        }
    })
}

function excluir(id) {
    var myHeaders = new Headers();
    myHeaders.append("Accept", "application/json");
    myHeaders.append("Content-Type", "application/json");
    myHeaders.append("Authorization", "Bearer " + getToken());

    var raw = JSON.stringify({
        "id": id
    });

    var requestOptions = {
        method: 'DELETE',
        headers: myHeaders,
        body: raw,
        redirect: 'follow'
    };

    loading();

    fetch(url + 'clientes', requestOptions)
        .then(response => response.json())
        .then(result => validacaoexclusao(result))
        .catch(error => console.log('error', error));
}

function validacaoexclusao(result) {
    Swal.close();
    if (result.message == "deletado") {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cliente excluido',
            showConfirmButton: false,
            timer: 1500
        })
        loadingcliente();
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: result.message
        });
    }
}


function Criarmodalclient() {
    const { value: formValues } = Swal.fire({
        icon: 'info',
        title: 'Criar Cliente: ',
        html:
            '<input id="swal-input11" placeholder="Nome"  class="swal2-input">' +
            '<input id="swal-input22" placeholder="Email"  class="swal2-input">',
        focusConfirm: false,
        confirmButtonText: 'Criar',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        preConfirm: () => {
            Clientecreate(document.getElementById('swal-input11').value, document.getElementById('swal-input22').value);
        }
    })

    if (formValues) {
        Swal.fire(JSON.stringify(formValues))
    }
}

function Clientecreate(nome, email) {
    var myHeaders = new Headers();
    myHeaders.append("Accept", "application/json");
    myHeaders.append("Content-Type", "application/json");
    myHeaders.append("Authorization", "Bearer " + getToken());

    var raw = JSON.stringify({
        "nome": nome,
        "email": email
    });

    var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: raw,
        redirect: 'follow'
    };

    loading();

    fetch(url + 'clientes', requestOptions)
        .then(response => response.json())
        .then(result => validacaocriacao(result))
        .catch(error => console.log('error', error));
}

function validacaocriacao(result) {
    Swal.close();
    if (result.message == "cadastrado") {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cliente cadastrado',
            showConfirmButton: false,
            timer: 1500
        })
        loadingcliente();
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: result.message
        });
    }
}
