<?php
require_once '../auth.php';
require_once '../models/fabricante.class.php';

if(isset($_POST['update']) == 'Cadastrar'){

$idFabricante = $_POST['idFabricante'];

$fabricante->DeleteFabricante($idFabricante,$perm);

}else{
	header('Location: ../../views/fabricante/index.php');
}

?>