<?php
require_once '../auth.php';
require_once '../models/usuario.class.php';

if ($perm == 1){
$username = $_POST['username'];
$email = $_POST['email'];

if (isset($_POST['idUser'])) {
    $idUser = $_POST['idUser'];
} else {
    // Lidar com o caso em que 'idUser' não está definido no array $_POST
    $idUser = ''; // ou outra ação apropriada
}

$permissao = $_POST['permissao'];

# Só é permitido adicionar novo usuário o Administrador
if ($username != NULL && $perm == 1 || $idUser == $idUsuario){


   if (!file_exists($_FILES['arquivo']['name'])){

        // caso o usuário não coloque imagem de perfil, coloca a imagem padrao.png ou se for administrador admin.png
       if($permissao == "1"){
        $nomeimagem = 'dist/img/admin.png';
       }else{
        $nomeimagem = 'dist/img/padrao.png';
       }
       
       $pt_file = '../../views/dist/img/'.$_FILES['arquivo']['name'];

       // se já tiver imagem apenas atualiza.
      if($pt_file != '../../views/dist/img/'){

          $destino = '../../views/dist/img/'.$_FILES['arquivo']['name'];
          $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
         move_uploaded_file($arquivo_tmp, $destino);
         chmod($destino, 0644);

         # adiciona a nova imagem.
         $nomeimagem = 'dist/img/'.$_FILES['arquivo']['name'];
         
        }elseif(isset($_POST['valor']) && $_POST['valor'] != NULL){
            $nomeimagem = $_POST['valor'];
        }
    }

    if($idUser != NULL){
        if($perm  == 1){
            $usuario->UpdateUsuario($idUser,$username,$email,$nomeimagem,$permissao);
        }else{
            $usuario->UpdateUsuario($idUser,$username,$email,$nomeimagem);
        }

    }else{
        $password = md5($_POST['password']);
        $usuario->InsertUsuario($username,$email,$password,$nomeimagem,$permissao);
    }

}
}else{
    header('Location:../../views/usuario/index.php');
}

?>