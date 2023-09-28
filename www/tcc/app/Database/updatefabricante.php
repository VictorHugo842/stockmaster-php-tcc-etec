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
$Ativo = $_POST['Ativo'];

$iduser = $_POST['iduser'];

	// tem quer ser o mesmo id user
    if($iduser == $idUsuario){
		/// Se o nome do fabricante for vazio , da erro, se não, atualiza no banco..
		if (empty($NomeFabricante)) {
            header('Location: ../../views/fabricante/index.php?alert=0');
            exit;
        }
		if (isset($_POST['idFabricante'])){
			$idFabricante = $_POST['idFabricante'];
			$fabricante->UpdateFabricante($idFabricante, $NomeFabricante, $CNPJFabricante, $EmailFabricante, $EnderecoFabricante, $TelefoneFabricante,$Ativo,$idUsuario,$perm);		
			
		}else{
			header('Location: ../../views/fabricante/index.php?alert=3');
		}
}


 }else{
	header('Location: ../../views/fabricante/index.php');
}