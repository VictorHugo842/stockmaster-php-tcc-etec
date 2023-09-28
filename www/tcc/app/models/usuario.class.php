<?php

/*
 Class Usuario
*/

 require_once 'connect.php';

 class Usuario extends Connect
 {

    // Lista todos os usuários cadastrados.
    public function index($perm){

        if ($perm == 1){
            $this->query = "SELECT * FROM `usuario`";
            $this->result = mysqli_query($this->SQL,$this->query) or die(mysql_error($this->SQL));

            while($row[] = mysqli_fetch_array($this->result));
            return json_encode($row);
            
            
        }else{
            return 0;
        }
    }

    // Faz a inserção de novo usuário.
    public function InsertUsuario($username, $email, $password,  $nomeimagem, $permissao)
    {
        $this->query = "INSERT INTO `usuario`(`idUser`,`Username`,`Email`,`Password`,`Imagem`,`Dataregistro`,`Permissao`)VALUES (NULL, '$username', '$email', '$password', '$nomeimagem' , CURRENT_TIMESTAMP , '$perm' )";
        
        $this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
    
        if($this->result){
            $insert_id = mysqli_insert_id($this->SQL);
    
            if($insert_id){
                header('Location: ../../views/usuario/index.php?alert=1');
            }else{
                header('Location: ../../views/usuario/index.php?alert=0');
            }
        }else{
            header('Location: ../../views/usuario/index.php?alert=0');
        }
    }


    public function EditUsuario($id){
        
        $query = "SELECT * FROM `usuario` WHERE `idUser` = '$id'";
        $this->result = mysqli_query($this->SQL, $query) or die(mysqli_error($this->SQL));
    
        if ($row = mysqli_fetch_array($this->result)) {
            return array('Usuario' => $row['Username'], 'Email' => $row['Email'], 'Permissao' => $row['Permissao'], 'Imagem' => $row['Imagem']);
        }
        
    }

    public function UpdateUsuario($idUser,$username,$email,$nomeimagem,$permissao = NULL){

        if($permissao  != NULL){
            $Permissao = ", Permissao = $permissao";
        }else{
            $Permissao = "";
        }

        $username = mysqli_real_escape_string($this->SQL, $username);
        $email = mysqli_real_escape_string($this->SQL, $email);


        $this->query = "UPDATE `usuario` SET `Username`='$username',`Email`='$email',`Imagem`='$nomeimagem' $Permissao WHERE `idUser`='$idUser'";
        
        $this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));

        if($this->result){
                header('Location: ../../views/usuario/index.php?alert=1');
            }else{
                header('Location: ../../views/usuario/index.php?alert=0');
            }

    }

    public function trocaSenha($passAtual,$password, $idUsuario){

                
        $query = "SELECT * FROM `usuario` WHERE `idUser` = '$idUsuario'";
        $this->result = mysqli_query($this->SQL, $query) or die(mysqli_error($this->SQL));
    
        if ($row = mysqli_fetch_array($this->result)) {
            $passAtual = md5($passAtual);

            if(!strcmp($passAtual,$row['Password'])){

                $id = $row['idUser'];

                $password = md5($password);
                $up = "UPDATE `usuario` SET `Password` = '$password' WHERE `idUser` = '$id'";
                $this->result = mysqli_query($this->SQL, $up) or die(mysqli_error($this->SQL));
                
                header('Location: ../../views/usuario/profile.php?alert=1');
                
            }
            header('Location: ../../views/usuario/profile.php?alert=0');
        }
        header('Location: ../../views/usuario/profile.php?alert=0');
    }


}

 $usuario = new Usuario;