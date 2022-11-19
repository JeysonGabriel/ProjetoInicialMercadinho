document.querySelector("#btn-login").addEventListener('click',() => {
    verificarUsuario();
})

function verificarUsuario(){
    usuario = {
        nome: document.querySelector('#login'),
        senha: document.querySelector('#senha')
    }
    fetch('http://localhost/mercadinho/autenticacao.php?acao=verificar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario)
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.sucesso) {
            
        } else {
            alert('deu ruimmmm');
        }
    });




    
}