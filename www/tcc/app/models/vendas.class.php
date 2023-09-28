<?php

/*
 Class Vendas
*/

require_once 'connect.php';

class Vendas extends Connect
{

    public function itensVerify($iditem, $quant, $perm){

        if($perm < 1 || $perm > 2){
          $_SESSION['msg'] =  'Erro - Você não tem permissão!'; 
          header('Location: ../../views/vendas/index.php');
          exit();
        }
    
        $this->query = "SELECT * FROM `itens`, `produtos` WHERE `idItens` = '$iditem' AND `Produto_CodRefProduto` = `CodRefProduto`";
        $this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
        $total = mysqli_num_rows($this->result);
    
        if($total > 0){
    
          if($row = mysqli_fetch_array($this->result)){
    
            $q = $row['QuantItens'];
            $v = $row['QuantItensVend'];
            $quantotal = $v + $quant;
    
            if($q >= $quantotal){
    
              return array('status' => '1', 'NomeProduto' => $row['NomeProduto'], );
            }else{
              $estoque = $q - $v;
              return array('status' => '0', 'NomeProduto' => $row['NomeProduto'], 'estoque'=> $estoque);
            }
          }
        }else{
    
          $_SESSION['msg'] =  '<div class="alert alert-warning">
          <strong>Ops!</strong> Produto ('.$iditem.') não encontrado!</div>';
          
          header('Location: ../../views/vendas/index.php');
          exit;
        }
      }



    public function ItensVendidos($idItem,$quant,$NomeCliente,$EmailCliente,$CpfCliente,$TelefoneCliente,$cart,$idUsuario,$perm){

        $this->query = "SELECT * FROM `itens` WHERE `idItens` ='$idItem'";
        $this->result = mysqli_query($this->SQL,$this->query) or die(mysqli_error($this->SQL));

        // Verifica se a consulta retornou algum resultado
        if ($this->result && mysqli_num_rows($this->result) > 0) {
            // A consulta retornou resultados, podemos prosseguir

            // Restante da lógica aqui...

            if ($row = mysqli_fetch_array($this->result)) {

                $q = $row['QuantItens'];
                $v = $row['QuantItensVend'];

                $quant_total = $v + $quant;

                if($q >= $quant_total){
                    
                    $valor =  ($row ['ValVendItens'] * $quant);

                    // verifica se já existe o cliente 
                    $this->verifica_cliente = "SELECT * FROM `cliente` WHERE `CpfCliente` = '$CpfCliente'";

                    if ($this->result_cliente = mysqli_query($this->SQL, $this->verifica_cliente) or die(mysqli_error($this->SQL))) {
                        if ($row = mysqli_fetch_array($this->result_cliente)) {
                            $idCliente = $row['idCliente'];
                            echo "Cliente com CPF: ".$CpfCliente." já cadastrado.";

                            
                        } else {
                            //  se não existir cliente, faz o cadastro.
                            $this->novo_cliente = "INSERT INTO `cliente`(`idCliente`, `NomeCliente`, `EmailCliente`, `CpfCliente`,`TelefoneCliente`, `StatusCliente`, `Usuario_idUser`) 
                            VALUES (NULL,'$NomeCliente','$EmailCliente','$CpfCliente','$TelefoneCliente','1','$idUsuario')";
                    
                            if (mysqli_query($this->SQL, $this->novo_cliente) or die(mysqli_error($this->SQL))) {
                                $idCliente = mysqli_insert_id($this->SQL);
                            }
                    
                            echo "Novo cliente cadastrado.";
                        }
                    } else {
                        // tratamento de erro ao executar a consulta
                        // ...
                    }   

                // faz o insert na tabela vendas
                $this->query = "INSERT INTO `vendas` (`idVendas`,`QuantItens`,`Valor`,`idItem`,`cart`,`Cliente_idCliente`,`idUsuario`) VALUES (NULL,'$quant','$valor','$idItem','$cart','$idCliente','$idUsuario')";
                $this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));

                if ($this->result) {
                    // Query de atualização da tabela "itens"
                    $this->query = "UPDATE `itens` SET `QuantItensVend` = '$quant_total' WHERE `idItens` = '$idItem'";
                    $this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));

                    if ($this->result) {

                        # tamanho maior da mensagem
                        #<div class="col-md-12 mx-auto">

                        $_SESSION['notavd'] = $cart;
                        $_SESSION['msg'] = '<div class="row">
                        <div class="col-md-12 mx-auto">
                        <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Venda efetuada com sucesso !
                        </div>
                        </div>
                        </div>';
                        
                        // redireciona para a página de vendas
                        header('Location:../../views/vendas/notavd.php');

                        // limpas os campos após a venda.
                        unset($_SESSION["Cliente"],$_SESSION["CPF"],$_SESSION["Email"],$_SESSION["Telefone"],$_SESSION["itens"],);

                    } else {
                        // Erro ao atualizar a tabela "itens"
                        $_SESSION['msg'] = '<div class="row">
                        <div class="col-md-6 mx-auto">
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Não foi possível efetuar a venda
                        </div>
                        </div>
                        </div>';

                        header('Location: ../../views/vendas/');
                    }
                }

                }else{

                    $estoque = $row['QuantItens'] - $row['QuantItensVend'];
                    
                    $_SESSION['msg'] = '<div class="row">
                    <div class="col-md-6 mx-auto">
                    <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Quantidade digitada excede o total em estoque: ' . '<b>'.$estoque.'</b>
                    </div>
                    </div>
                    </div>';

                    header('Location:../../views/vendas/');
                  
                }

            }


        }else{
            $_SESSION['msg'] = '<div class="row">
                        /<div class="col-md-6 mx-auto">
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        O ID do item não existe
                        </div>
                        </div>
                         </div>';

                        header('Location:../../views/vendas/');
        }
    }


      //----------itemNome

      public function itemNome($idItens) {
        $query = "SELECT * FROM `produtos` WHERE `CodRefProduto` IN (SELECT `Produto_CodRefProduto` FROM `itens` WHERE `idItens` = '$idItens')";
    
        $result = mysqli_query($this->SQL, $query) or die (mysqli_error($this->SQL));
    
        $row = mysqli_fetch_array($result);
    
        if ($row !== null && isset($row['NomeProduto'])) {
            $resp = $row['NomeProduto'];
        } else {
            $resp = NULL;
        }
    
        return $resp;
    }
      
      //--itemNome

      //--notavd
      public function notavd($cart)
      {
    
        $query = "SELECT * FROM `vendas` WHERE `cart` = '$cart' ";
    
        if ($result = mysqli_query($this->SQL, $query)  or die(mysqli_error($this->SQL))) {
    
          while ($row = mysqli_fetch_array($result)) {
            $out[] = $row;
          }
        }
    
        return $out;
      } //--notavd


    //---dadosItem 
    public function dadosItem($idItem)
    {

        $query = "SELECT * FROM `fabricante`, `produtos`, `itens` WHERE `idItens` = '$idItem' AND `Produto_CodRefProduto` = `CodRefProduto` AND `Fabricante_idFabricante` = `idFabricante`";

        if ($result = mysqli_query($this->SQL, $query)  or die(mysqli_error($this->SQL))) {

        $row = mysqli_fetch_array($result);

        return $row;
        }
    } //---dadosItem


}