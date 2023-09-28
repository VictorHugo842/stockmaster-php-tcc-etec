<?php
require_once '../auth.php';
require_once '../models/cliente.class.php';

if(isset($_POST['update']) == 'Cadastrar'){

$idCliente = $_POST['idCliente'];

$cliente->DeleteCliente($idCliente,$perm);

}else{
	header('Location: ../../views/cliente/index.php');
}

?>