<?php
require_once 'banco.php';

$acao = $_REQUEST['acao'] ?? 'listarCategoria';

$resultado = '';

switch ($acao) {
    case 'listarCategoria':
        $resultado = listarCategoria();
    break;
    case 'inserirCategoria':
        $texto =  file_get_contents('php://input') ;
        $categoria = json_decode($texto, JSON_FORCE_OBJECT);
        $nome = $categoria['nome'];
        $resultado = inserirCategoria($nome);    
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

}

echo json_encode($resultado);

?>