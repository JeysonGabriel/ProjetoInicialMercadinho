
document.querySelector('#btn-adicionar').addEventListener('click',() => {
    inserirUsuario();
});

listarUsuarios();


function listarUsuarios() {
    fetch('http://localhost/mercadinho/backend.php?acao=listarUsuarios')
    .then((response) => response.json())
    .then((data) => {
        let html = '';
        data.forEach(usuario => {
            html+= `<tr>
            <td>${usuario.id}</td>
            <td>${usuario.nome}</td>
            <td>${usuario.cargo}</td>
            <button type='button' class='btn btn-danger' onclick='editarUsuario(${usuario.id})'>Editar</button>
            <button type='button' class='btn btn-danger' onclick='excluirUsuario(${usuario.id})'>Excluir</button>
        </tr>`;
        });
        document.querySelector('#tabela > tbody').innerHTML = html;
    });
}


function inserirUsuario() {
    let usuario = {
        nome: document.querySelector('#nome').value,
        cargo: document.querySelector('#cargo').value,
    };
    console.log(usuario);
    
    fetch('http://localhost/mercadinho/backend.php?acao=inserirUsuario', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario)
    })
    .then((response) => response.json())
    .then((resultado) => {
        if (resultado.sucesso) {
            listarUsuarios();
        } else {
            alert('impossivel inserir');
        }
    });

}

function editarCategoria(id) {
    let categoria = {
        nome: document.querySelector('#nome').value
    };

    
    fetch('http://localhost/mercadinho/backend.php?acao=editar&id='+id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(categoria)
    })
    .then((response) => response.json())
    .then((resultado) => {
        if (resultado.sucesso) {
            lerDados();
        } else {
            alert('impossivel editar');
        }
    });

}


function excluirProduto(id) {
    fetch('http://localhost/mercadinho/backend.php?acao=excluirProduto&id='+id)
    .then((response) => response.json())
    .then((data) => {
        if (data.sucesso) {
            lerDados();

        } else {
            alert('deu ruim');
        }
    });

}
function editarProduto(id) {
    let produto = {
        nome: document.querySelector('#nome').value,
        preco: document.querySelector('#preco').value,
        categoria: document.querySelector('#categoria').value
    };

    
    fetch('http://localhost/mercadinho/backend.php?acao=editarProduto&id='+id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(produto)
    })
    .then((response) => response.json())
    .then((resultado) => {
        if (resultado.sucesso) {
            lerDados();
        } else {
            alert('impossivel editar');
        }
    });

}

