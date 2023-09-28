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

	if (!isset($_POST['idCliente'])){ // se não existir , e está vindo pelo addcliente, adiciona um novo.

		$cliente->InsertCliente($NomeCliente,$CpfCliente,$EmailCliente,$TelefoneCliente,$idUsuario,$perm);

        // se inserir o usuário , exibe mensagem de sucesso
        header('Location: ../../views/cliente/addcliente.php?alert=1');
		

	}else{ // UPDATE É FEITO PELO ARQUIVO updatecliente.php // pode remover futuramente.
			$idCliente = $_POST['idCliente'];
			$cliente->UpdateCliente($idCliente, $NomeCliente, $CpfCliente, $EmailCliente, $TelefoneCliente, $StatusCliente, $idUsuario,$perm);	
			
			 // se atualizar , exibe mensagem de sucesso e volta para index.
			 header('Location: ../../views/cliente/index.php?alert=1');
			
	}

}else{
        header('Location: ../../views/cliente/addcliente.php?alert=11'); // alerta de todos campos obrigatórios.
}

		
}else{
	header('Location: ../../views/cliente/addcliente.php');
}