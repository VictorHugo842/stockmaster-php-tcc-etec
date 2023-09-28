<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';
require_once '../../app/models/vendas.class.php';
require_once '../../app/models/cliente.class.php';

echo $head;
echo $header;
echo $aside;
echo '<div class="content-wrapper">
		<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registrar <small>Vendas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i>Início</a></li>
        <li class="active">Vendas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    ';
    require '../../layout/alert.php';

    # ESSE CÓDIGO OCUPA A TELA TODA, ALTERAR A DIV DO ECHO ABAIXO CASO DECIDA SER O MELHOR.
    #<!-- Small boxes (Stat box) -->
    #<div class="row">
    #  <div class="box box-primary">

    if(!empty($_SESSION['msg'])){
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
      
   }


      echo '<!-- AJUSTA O FORMULÁRIO PARA NAO OCUPAR A TELA INTEIRA-->

            <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="box box-primary">

              
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Venda</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">';

  ?>       

  <!-- Client List -->
  <?php

// Client List
if (isset($_POST['CPF'])) {
    $cliente = new Cliente;
    $resps = $cliente->searchdata($_POST["CPF"]);

    if (is_array($resps) && !empty($resps['data']) && $_POST['CPF'] != NULL) {
        foreach ($resps['data'] as $resp) {
            $_SESSION['CPF'] = $resp['CpfCliente'];
            $_SESSION['Cliente'] = $resp['NomeCliente'];
            $_SESSION['Email'] = $resp['EmailCliente'];
            $_SESSION['Telefone'] = $resp['TelefoneCliente'];
            $_SESSION['cart'] = MD5('@?#' . $resp['CpfCliente'] . '@' . date("d-m-Y H:i:s"));
        }
    } else {
        // Se não houver resultados, você pode definir as variáveis de sessão como vazias ou fazer outra coisa adequada ao seu aplicativo.
        $_SESSION['CPF'] = '';
        $_SESSION['Cliente'] = '';
        $_SESSION['Email'] = '';
        $_SESSION['Telefone'] = '';
        $_SESSION['cart'] = '';
    }

    unset($_POST['CPF']);
}
    ?>
    <!-- Client List -->

    <?php  
            // Client List
            echo '<div class="row">
            <form id="form1" action="index.php" method="post">
              <div class="box-body">
                <div class="col-lg-6">
                  <div class="input-group">
                    <input type="text" class="form-control" id="CpfCliente" name="CPF" placeholder="Pesquisar CPF" autocomplete="off">
                    <span class="input-group-btn"> 
                      <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-floppy-save"></span></button>
                    </span>
                  </div>
                  <div id="Listdata"></div>
                </div>
              </div>
            </form>
          </div><br><br>';

                
              if ($perm != 1 || $perm != 2) {
                echo '<form id="form2" action="../../app/Database/insertvendas.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome do Cliente</label>
                            <input type="text" name="NomeCliente" class="form-control" id="exampleInputnome1" placeholder="Nome Cliente" value="';
                if (isset($_SESSION["Cliente"])) { echo $_SESSION["Cliente"]; }
                echo '" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">CPF do Cliente:</label>
                            <input type="text" name="CpfCliente" class="form-control" id="exampleInputEmail1" placeholder="CPF do Cliente" value="';
                if (isset($_SESSION["CPF"])) { echo $_SESSION["CPF"]; }
                echo '" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail do Cliente:</label>
                            <input type="text" name="EmailCliente" class="form-control" id="exampleInputEmail1" placeholder="E-mail do Cliente" value="';
                if (isset($_SESSION["Email"])) { echo $_SESSION["Email"]; }
                echo '" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telefone do Cliente:</label>
                            <input type="text" name="TelefoneCliente" class="form-control" id="exampleInputEmail1" placeholder="Telefone do Cliente" value="';
                if (isset($_SESSION["Telefone"])) { echo $_SESSION["Telefone"]; }
                echo '" />
                        </div>
                        
                         <!-- Tabela de produtos -->';

                  echo' <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Lista de Produtos</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="row">

                          <div class="form-group col-xs-12 col-sm-4">

                            <input type="number" id="idItem" name="idItem" class="form-control" placeholder="Item">
                          </div>
                          <div class="form-group col-xs-12 col-sm-4">

                            <input type="number" id="qtd" name="qtde" class="form-control" placeholder="Quantidade">
                          </div>

                          <div class="form-group col-xs-12 col-sm-4">
                            <button type="button" id="prodSubmit" name="prodSubmit" onclick="prodSubmit();" value="carrinho" class="btn btn-primary col-xs-12">Adicionar</button>
                          </div>
                        </div>

                          <table class="table table-bordered" id="products-table">

                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Cod.</th>
                              <th>Produto</th>
                              <th>Qtde</th>
                              <th style="width:40px" title="Remover">Del</th>
                            </tr>


                            <tbody id="listable">';
                            if (!isset($_SESSION['itens']) || count($_SESSION['itens']) == 0) {
                              echo '<tr>
                              <td colspan="5">
                              <b>Carrinho Vazio</b>
                              </td>
                              </tr>';
                          } else {
                              $vendas = new Vendas;
                              $cont = 1;
                          
                              foreach ($_SESSION['itens'] as $produtos => $quantidade) {
                                  $nomeProduto = $vendas->itemNome($produtos);
                          
                                  echo '<tr>
                                  <td>' . $cont . '</td>
                                  <td>' . $produtos . '</td>
                                  <td>' . $nomeProduto . '</td>
                                  <td>' . $quantidade . '</td>
                                  <td>
                                  <input type="hidden" id="idItem" name="idItem[' . $produtos . ']" value="' . $produtos . '" />
                                  <input type="hidden" id="qtd" name="qtd[' . $produtos . ']" value="' . $quantidade . '" />
                                  <a title="Remover item ' . $nomeProduto . ' código ' . $produtos . '." href="../../App/Database/remover.php?remover=carrinho&id=' . $produtos . '"><i class="fa fa-trash text-danger"></i></a>
                                  </td>
                                  </tr>';
                                  $cont = $cont + 1;
                              }
                          }

                              echo '
                            </tbody>                  
                          </table>

                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- Tabela de produtos -->



                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-check-circle"></i> Registrar Venda</button>
                    </form>';
            } else {
                echo 'Você não possui acesso para esta página.';
            }
                 echo' </div>
                  <!-- /.box-body -->
                </div>
              </div>
            </div>';
            
            // chama a mensagem , de acordo com a operação efetuada.
            // if(!empty($_SESSION['msg'])){
            //    echo $_SESSION['msg'];
            //    unset($_SESSION['msg']);
               
            // }
echo '</div>
	 
';
echo '</div>';
echo '</section>';
      
       
	  

echo '</div>';

echo  $footer;
echo $javascript;
?>


