<?php
require_once '../../app/auth.php';
if(isset( $_POST['status'])){

	$tabela = $_POST['tabela'];

require_once '../../app/models/'.$tabela.'.class.php';

		$id = $_POST['id'];
		$value = $_POST['status'];		
		
		$ob = new $tabela;
		$ob->Ativo($value, $id);				
	}