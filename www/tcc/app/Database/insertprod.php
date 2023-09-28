<?php
require_once '../auth.php';
require_once '../models/produtos.class.php';

	if(isset($_POST['update']) == 'Cadastrar'){

		$NomeProduto = $_POST['NomeProduto'];

		$iduser = $_POST['iduser'];

		if($NomeProduto != NULL){

			if(isset($_POST['id']) != NULL && $idUsuario != NULL){
				$id = $_POST['id'];
				$produtos->UpdateProdutos($id, $NomeProduto, $idUsuario);
			}elseif($iduser == $idUsuario){
				$produtos->InsertProdutos($NomeProduto, $idUsuario);
			}
			


		}else{
			header('Location: ../../views/prod/index.php?alert=0');
		}

	}else{
		header('Location: ../../views/prod/index.php');
	}
