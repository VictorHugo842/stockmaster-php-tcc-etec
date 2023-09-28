<?php 

require_once 'connect.php';

class Cliente extends Connect
{

    function index($value){

        if($value == NULL){
            $value = 1;
        }
      
           $this->query = "SELECT * FROM `cliente` WHERE `Public` = '$value'";
           $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));
      
            if($this->result){
            
                while ($row = mysqli_fetch_array($this->result)) {
                    
                    if($row['StatusCliente'] == 0){ $c ='class="label-warning"'; }else{ $c =" ";}
                    echo '<li '.$c.'>
                
                            <!-- drag handle -->
                                <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                </span>
                            <!-- checkbox -->
                        
                            <form class="label" name="ativ'.$row['idCliente'].'" action="../../app/Database/action.php" method="post">
                            <input type="hidden" name="id" id="id" value="'.$row['idCliente'].'">
                            <input type="hidden" name="status" id="status" value="'.$row['StatusCliente'].'">
                            <input type="hidden" name="tabela" id="tabela" value="cliente">                  
                            <input type="checkbox" id="status" name="status" ';
                            if($row['StatusCliente'] == 1){ echo 'checked'; } 
                            echo ' value="'.$row['StatusCliente'].'" onclick="this.form.submit();" /></form>
                            
                            <!-- todo text -->
                            <span class="text"> '.$row['NomeCliente'].' </span>
                            <div class="tools right">
                            <a href="editcliente.php?id='.$row['idCliente'].'"><i class="fa fa-edit"></i></a> 
                            <!-- Button trigger modal -->
                            <a href="" data-toggle="modal" data-target="#myModal'.$row['idCliente'].'">';
                            if($row['Public'] == 0){echo '<i class="glyphicon glyphicon-remove" aria-hidden="true"></i>';}else{ echo '<i class="glyphicon glyphicon-ok" aria-hidden="true"></i>';}
                            echo '</a> </div>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal'.$row['idCliente'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <form id="delCliente'.$row['idCliente'].'" name="delCliente'.$row['idCliente'].'" action="../../app/Database/deletecliente.php" method="post" style="color:#000;">

                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Você tem certeza que deseja alterar o status deste item na sua lista?</h4>
                            </div>
                            <div class="modal-body">
                                Nome: '.$row['NomeCliente'].'
                            </div>
                            <input type="hidden" id="idCliente" name="idCliente" value="'.$row['idCliente'].'">
                            <div class="modal-footer">
                                <button type="submit" value="Cancelar" class="btn btn-default">Não</button>
                                <button type="submit" name="update" value="Cadastrar" class="btn btn-primary">Sim</button>
                            </div>
                            </div>
                        </div>
                        
                        </form>
                        </div>
                        </li>';

                }
        }
    }// fim index.

    // atualiza o cliente
    function UpdateCliente($idCliente,$NomeCliente,$CpfCliente,$EmailCliente,$TelefoneCliente,$StatusCliente,$idUsuario){

        // retorna somente os números
        $CpfCliente = connect::limpaCPF_CNPJ($CpfCliente);

        // verifica se o cliente já foi cadastrado através do CPF (tem função pra isso , mas o filtro e alert é diferente.)
        // nesse caso é preciso adicionar AND `idCliente` != '$idCliente', pois so verifica o cpf dos outros cliente(não do que está sendo editado).
        $this->verifica_cliente = "SELECT * FROM `cliente` WHERE `CpfCliente` = '$CpfCliente' AND `idCliente` != '$idCliente'";
    
        if ($this->result_cliente = mysqli_query($this->SQL, $this->verifica_cliente) or die(mysqli_error($this->SQL))) {
            if ($row = mysqli_fetch_array($this->result_cliente)) {
                $idCliente = $row['idCliente'];
                
                // se existir cliente com o mesmo CPF , exibe mensagem.
                header('Location: ../../views/cliente/editcliente.php?id=' . $idCliente . '&alert=10');
                exit; // Encerra a execução do código após o redirecionamento.
            }
        }

        // não deixa passar códigos maliciosos para o banco de dados (SEGURANÇA!! REPLICAR EM TODAS PARTES DO CÓDIGO)
        $NomeCliente = mysqli_real_escape_string($this->SQL, $NomeCliente);
        $CpfCliente = mysqli_real_escape_string($this->SQL, $CpfCliente);
        $EmailCliente = mysqli_real_escape_string($this->SQL, $EmailCliente);
        $TelefoneCliente = mysqli_real_escape_string($this->SQL, $TelefoneCliente);

        $this->query = "UPDATE `cliente` 
        SET `NomeCliente`='$NomeCliente',`CpfCliente` = '$CpfCliente',`EmailCliente` = '$EmailCliente',`TelefoneCliente` = '$TelefoneCliente',`StatusCliente` = '$StatusCliente',`Usuario_idUser` = '$idUsuario' 
        WHERE `idCliente`='$idCliente'";

        $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));
            
        if($this->result){
            return 1;
        }else{
            return 0;
        }

        mysqli_close($this->SQL);
    }

    // mostra os dados do cliente para pode fazer o update no editcliente.php.
    function EditCliente($idCliente){

        $this->query = "SELECT *FROM `cliente` WHERE `idCliente` = '$idCliente'";
        if($this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL))){
    
          if($row = mysqli_fetch_array($this->result)){
    
            $NomeCliente = $row['NomeCliente'];
            $CpfCliente = $row['CpfCliente'];
            $EmailCliente = $row['EmailCliente'];
            $TelefoneCliente = $row['TelefoneCliente'];
            $StatusCliente = $row['StatusCliente'];
            $Usuario_idUser  = $row['Usuario_idUser'];
    
              $array = array('Cliente' => [ 'NomeCliente' => $NomeCliente, 'CpfCliente' => $CpfCliente, 'EmailCliente'=> $EmailCliente,'TelefoneCliente' => $TelefoneCliente, 'StatusCliente' => $StatusCliente, 'Usuario' => $Usuario_idUser,]);
              return $array;
          }
    
        }else{
          return 0;
        }
    
    }

    // Ativa desativa status do cliente.
    function Ativo($value, $id){

        if($value == 0){ $v = 1; }else{ $v = 0; };
        
        $this->query = "UPDATE `cliente` 
        SET `StatusCliente`='$v'
        WHERE `idCliente`='$id'";

        $this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
        
        header('Location: ../../views/cliente/');

    }

    // seta como publicado ou desativado.
    function DeleteCliente($idCliente, $perm){

        $this->query = "SELECT * FROM `cliente` WHERE `idCliente` = '$idCliente'";
        $this->result = mysqli_query($this->SQL, $this->query);
        if($row = mysqli_fetch_array($this->result)){

            $id = $row['idCliente'];
            $public = $row['Public'];

            if($public == 1){
                $p = 0;
            }else{
                $p = 1;
            }

            mysqli_query($this->SQL, "UPDATE `cliente` SET `Public` = '$p' WHERE `idCliente` = '$id'") or die(mysqli_error($this->SQL));
            header('Location: ../../views/cliente/index.php?alert=1');
        }else{
            header('Location: ../../views/fabricante/index.php?alert=0');
        } 
        
    }

    // faz o insert do cliente 
    function InsertCliente($NomeCliente, $CpfCliente, $EmailCliente, $TelefoneCliente, $idUsuario, $perm) {

        // retorna somente os números do CPF
        $CpfCliente = connect::limpaCPF_CNPJ($CpfCliente);
    
        // verifica se o cliente já foi cadastrado através do CPF
        Cliente::VerificaCliente($CpfCliente, $NomeCliente);
    
        // não deixa passar códigos maliciosos para o banco de dados (SEGURANÇA!! REPLICAR EM TODAS PARTES DO CÓDIGO)
        $NomeCliente = mysqli_real_escape_string($this->SQL, $NomeCliente);
        $EmailCliente = mysqli_real_escape_string($this->SQL, $EmailCliente);
        $CpfCliente = mysqli_real_escape_string($this->SQL, $CpfCliente);
        $TelefoneCliente = mysqli_real_escape_string($this->SQL, $TelefoneCliente);
    
        $query = "INSERT INTO `cliente`(`idCliente`, `NomeCliente`, `EmailCliente`, `CpfCliente`, `TelefoneCliente`, `StatusCliente`, `Usuario_idUser`,`Public`) 
                  VALUES (NULL,'$NomeCliente','$EmailCliente','$CpfCliente','$TelefoneCliente','1','$idUsuario','1')";
    
        $this->result = mysqli_query($this->SQL, $query) or die(mysqli_error($this->SQL));
    
        if ($this->result) {
            return 1; 
        } else {
            return 0; 
        }
    
        mysqli_close($this->SQL);
    }
    
     // verifica se já existe o cliente com o CPF fornecido
    function VerificaCliente($CpfCliente, $NomeCliente) {
        $this->verifica_cliente = "SELECT * FROM `cliente` WHERE `CpfCliente` = '$CpfCliente'";
    
        if ($this->result_cliente = mysqli_query($this->SQL, $this->verifica_cliente) or die(mysqli_error($this->SQL))) {
            if ($row = mysqli_fetch_array($this->result_cliente)) {
                $idCliente = $row['idCliente'];
                // Redireciona para a página de adicionar cliente com um alerta indicando que o cliente já existe.
                header('Location: ../../views/cliente/addcliente.php?alert=10');
                exit; // Encerra a execução do código após o redirecionamento.
            }
        }
    
        return false;
    }


    function search($value){

        if(isset($value))  
        {  
          //$output = '';  
          $query = "SELECT * FROM `cliente` WHERE `CpfCliente` LIKE '".$value."%' OR `NomeCliente` LIKE '".$value."%' LIMIT 5";  
          $result = mysqli_query($this->SQL, $query); 

          if(mysqli_num_rows($result) > 0)  
          {  

           while($row = mysqli_fetch_array($result))  
           {  
              
            $output[] = $row; 
          } 

          return array('data' => $output);

        }else{

          return 0;
        }  

      }
    }

    function searchdata($value){
        
        $value = explode(' ', $value);
        $valor = str_replace("." , "" , $value[0] ); // Primeiro tira os pontos
        $valor = str_replace("-" , "" , $valor); // Depois tira o taço
        $value = $valor;

        if(isset($value))  
        {  
            //$output = '';  
            $query = "SELECT * FROM `cliente` WHERE `CpfCliente` = '$value'";  
            $result = mysqli_query($this->SQL, $query);  
            if(mysqli_num_rows($result) > 0)  
            {  

            if($row = mysqli_fetch_array($result))  
            {  
                $output[] = $row; 
            }  
            return array('data' => $output); 
            }else{
            return $value;
            } 
        }
      }//----searchdata-----

      public function dadoscliente($idCliente){

        $this->client = "SELECT * FROM `cliente` WHERE `idCliente` = '$idCliente'";

            if($this->resultcliente = mysqli_query($this->SQL, $this->client)  or die (mysqli_error($this->SQL))){

                $row = mysqli_fetch_array($this->resultcliente);
                return $row;
            }
    }

    }//------

    

$cliente = new Cliente;

?>