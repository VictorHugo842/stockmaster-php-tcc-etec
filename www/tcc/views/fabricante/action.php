<?php
require_once '../../app/auth.php';
require_once '../../app/models/fabricante.class.php';

	if( isset( $_POST['status'])){

		$id = $_POST['id'];
		$value = $_POST['status'];
		$fabricante->ItensAtivo($value, $id);

	}
	