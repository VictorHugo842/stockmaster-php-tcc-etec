<?php
require_once '../auth.php';
require_once '../models/fabricante.class.php';

if(isset($_POST['upload']) == 'Cadastrar'){

$NomeFabricante = $_POST['NomeFabricante'];

//---Fabricante---//
$CNPJFabricante = $_POST['CNPJFabricante'];
$EmailFabricante = $_POST['EmailFabricante'];
$EnderecoFabricante = $_POST['EnderecoFabricante'];
$TelefoneFabricante = $_POST['TelefoneFabricante'];
$Public = $_POST['Public'];
$status = $_POST['status'];

//--Representante--//


$iduser = $_POST['iduser'];

if($iduser == $idUsuario && $NomeFabricante != NULL){

		if (!isset($_POST['idFabricante'])){

			$NomeRepresentante = $_POST['NomeRepresentante'];
			$TelefoneRepresentante = $_POST['TelefoneRepresentante'];
			$EmailRepresentante = $_POST['EmailRepresentante'];
			$fabricante->InsertFabricante($NomeFabricante, $CNPJFabricante, $EmailFabricante, $EnderecoFabricante, $TelefoneFabricante, $idUsuario,  $NomeRepresentante, $TelefoneRepresentante, $EmailRepresentante, $status,$perm);
		

	}else{

		// o update não é feito por aqui , é feito pelo updatefabricante.php !!!!
			$idFabricante = $_POST['idFabricante'];
			$fabricante->UpdateFabricante($idFabricante, $NomeFabricante, $CNPJFabricante, $EmailFabricante, $EnderecoFabricante, $TelefoneFabricante, $Public, $idUsuario,$perm);		
			
		}
	}else{
			header('Location: ../../views/fabricante/index.php?alert=3');
		}
		
	
 }else{
	header('Location: ../../views/fabricante/index.php');
}