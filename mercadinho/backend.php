<?php
session_start();
require_once 'banco.php';

$acao = $_REQUEST['acao'] ?? 'listarCategoria';

$resultado = '';

switch ($acao) {
    case 'verificar':
        $texto =  file_get_contents('php://input');
        $usuario = json_decode($texto, JSON_FORCE_OBJECT);
        $login = $usuario['login'];
        $senha = $usuario['senha'];
        $resultado = verificar($login, $senha);

    case 'listarCategoria':
        $usuario = $_SESSION['usuario'] ?? false;
        if (!$usuario){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $resultado = listarCategoria();
        }
    break;
    case 'inserirCategoria':
        $usuario = $_SESSION['usuario'] ?? false;
        if (!$usuario || $usuario['regra'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $texto =  file_get_contents('php://input') ;
            $categoria = json_decode($texto, JSON_FORCE_OBJECT);
            $nome = $categoria['nome'];
            $resultado = inserirCategoria($nome);    
        }
    break;
    case 'excluirCategoria':
        $id = $_REQUEST['id'];
        $resultado = excluirCategoria($id);
    break;
    case 'editarCategoria':
        $id = $_REQUEST['id'];
        $texto =  file_get_contents('php://input') ;
        $categoria = json_decode($texto, JSON_FORCE_OBJECT);
        $nome = $categoria['nome'];
        $resultado = editarCategoria($id, $nome);    
    break;  
    case 'listarProdutos':
        $resultado = listarProdutos();
    break;
    case 'inserirProduto':
        $texto =  file_get_contents('php://input') ;
        $produto = json_decode($texto, JSON_FORCE_OBJECT);
        $nome = $produto['nome'];
        $preco = $produto['preco'];
        $categoria = $produto['categoria'];
        $resultado = inserirProduto($nome, $preco, $categoria); 
    break;
    case 'excluirProduto':
        $id = $_REQUEST['id'];
        $resultado = excluirProduto($id);
    break;
    case 'editarProduto':
        $id = $_REQUEST['id'];
        $texto =  file_get_contents('php://input') ;
        $produto = json_decode($texto, JSON_FORCE_OBJECT);
        $nome = $produto['nome'];
        $preco = $produto['preco'];
        $categoria = $produto['categoria'];
        $resultado = editarProduto($id, $nome, $preco, $categoria);
    break;
    case 'listarUsuarios':
        $resultado = listarUsuarios();
    break;
}

echo json_encode($resultado);

?>