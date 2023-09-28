<?php
require_once '../auth.php';
require_once '../models/produtos.class.php';

if(isset($_POST['update']) == 'Cadastrar'){

$id = $_POST['id'];

$produtos->DeleteProdutos($id);

}else{
	header('Location: ../../views/prod/index.php');
}

?>