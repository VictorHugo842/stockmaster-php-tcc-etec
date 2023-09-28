<?php
require_once '../../app/auth.php';
require_once '../../app/models/relatorio.class.php';

if(isset($_POST['produto']) != NULL){
	$idProduto = $_POST['produto'];

	$relatorio = new Relatorio();

	return $relatorio->qtdeItensEstoque($perm, $idProdutos);
}
?>
