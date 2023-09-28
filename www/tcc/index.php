<?php
require_once 'app/auth.php'; # faz a autenticação.

if($usuario && $perm){

	header('Location: views/');  // Caso o usúario esteja logado, sempre vai redirecionar ao home.php da views.
}else{

header('Location: login.php'); // Caso o usuário esteja deslogado, sempra vai redirecionar a tela de login.
}

?>