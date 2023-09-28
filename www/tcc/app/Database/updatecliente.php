<?php
require_once '../auth.php';
require_once '../models/cliente.class.php';

if(isset($_POST['upload']) == 'Cadastrar'){

$NomeCliente = $_POST['NomeCliente'];
$CpfCliente = $_POST['CpfCliente'];
$EmailCliente = $_POST['EmailCliente'];
$TelefoneCliente = $_POST['TelefoneCliente'];
$StatusCliente = $_POST['StatusCliente'];

$iduser = $_POST['iduser'];

$cliente = new Cliente;

if($iduser == $idUsuario && $NomeCliente != NULL && $CpfCliente != NULL && $EmailCliente != NULL && $TelefoneCliente != NULL){

    $idCliente = $_POST['idCliente'];
    $cliente->UpdateCliente($idCliente, $NomeCliente, $CpfCliente, $EmailCliente, $TelefoneCliente, $StatusCliente, $idUsuario,$perm);	
    
    // se atualizar , exibe mensagem de sucesso e volta para index.
    header('Location: ../../views/cliente/index.php?alert=1');

}else{
    $idCliente = $_POST['idCliente'];
    header('Location: ../../views/cliente/editcliente.php?id='.$idCliente.'&alert=11'); // alerta de todos campos obrigatórios.
}

		
}else{
	header('Location: ../../views/cliente/editcliente.php');
}