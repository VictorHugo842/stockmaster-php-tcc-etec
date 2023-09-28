<?php
session_start(); //Iniciando a sessão

// Verifica se as variáveis de sessão idUsuario e usuario não estão definidas, Isset serve para saber se uma variável está definida.
if(!isset($_SESSION["idUsuario"]) || !isset($_SESSION["usuario"])){

 	// Redireciona o usuário para a página de login
 	header('Location: ../login.php');
}
else{

	// Se as variáveis de sessão estiverem definidas, as atribui para as variáveis locais
	$idUsuario = $_SESSION["idUsuario"]; 
	$usuario   = $_SESSION["usuario"];
	$username   = $_SESSION["usuario"];
	$perm	   = $_SESSION["perm"];
	$foto	   = $_SESSION["foto"];
	$dataregistro = $_SESSION['dataregistro'];


}
?>