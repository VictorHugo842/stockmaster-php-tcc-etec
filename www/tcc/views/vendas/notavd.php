<?php
require_once '../../App/auth.php';

if (isset($_SESSION['notavd']) != NULL) {

  require_once '../../layout/script.php';
  require_once '../../app/Models/cliente.class.php';
  require_once '../../app/Models/vendas.class.php';

  echo $head;
  echo $header;
  echo $aside;

  echo '<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendas
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Vendas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">';

     require '../../layout/alert.php'; 

    if (isset($_SESSION['msg']) != NULL) {
      echo $_SESSION['msg'];
    }
      
      echo' <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="box box-primary">
        
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="box-body">
                <div class="col-xs-12 col-sm-12">';
                  
                  
              echo '</div>
              </div>

              <div id="print" class="row">
              <style type="text/css">
              table {
                width: 100%;
                border: 2px solid #000;
                border-collapse: collapse;

              }

              table tr td {
                border: 1px solid #000;
                border-collapse: collapse;
                text-spacing: 2px;
                line-height: 1.6;
                padding-left: 5px;
              }
            </style>

                <div class="box-body">
                  <div class="col-xs-12 col-sm-12">
                    <div class="table-responsive">
                      <table id="table_notavd" class="table table-bordred table-striped">';
                        $cartvd = $_SESSION['notavd'];

                        $vendas = new vendas;
                        $row = $vendas->notavd($cartvd);


                        $cliente = new cliente;
                        $dados = $cliente->dadoscliente($row[0]['Cliente_idCliente']);

                        echo' </td>
                        </tr>

                        <tr>
                          <td>Cod.</td>
                          <td>Produto</td>
                          <td>Fabricante</td>
                          <td>Quantidade</td>
                          <td>Valor Unitário.</td>
                        </tr>';
                        $soma = 0;

                        foreach ($row as $key) {
                          $vendas = new vendas;
                          $dadosItem = $vendas->dadosItem($key["idItem"]);

                          $nomeProduto = $dadosItem['NomeProduto'];
                          $NomeFabricante = $dadosItem['NomeFabricante'];

                          echo "<tr>";
                          echo '<td>' . $key["idItem"] .    '</td>';
                          echo '<td>' . $nomeProduto .      '</td>';
                          echo '<td>' . $NomeFabricante .   '</td>';
                          echo '<td>' . $key["QuantItens"] . '</td>';
                          echo '<td>';
                          echo $connect->format_moeda($key['Valor']);
                          echo '</td>';
                          echo "</tr>";
                          $soma = $soma + $key["Valor"];
                        }

                        
                        echo '<tr>
                          <td colspan="4">Data:' . date('d M Y H:i:s'); echo' </td>
                          <td>Total: ' . $connect->format_moeda($soma); echo'</td>
                        </tr>';

                        
                       echo' <tr>
                       <td colspan="5">
                         <b>Cliente:</b> ' . $dados['NomeCliente'];  
                         echo' </br><b>CPF:</b> ' . $connect->format_CPF($dados['CpfCliente']);
                         
                      echo '</table>
                    </div><!-- table-responsive -->
                  </div><!-- col-xs-12 col-sm-12 -->
                </div><!-- box-body -->
              </div><!-- Fim print -->

            </div><!-- row -->
          </div> <!-- box-body -->
        </div><!-- box box-primary -->
        
        <div style="text-align: right;">
        <a href="./" style="margin-right: 5px;">
          <button class="btn btn-success">Fechar</button>
        </a>
        <input type="button" class="btn btn-primary" onclick="cont();" value="Imprimir">
      </div>

      </div><!-- row -->
    </section> <!-- section -->
  </div><!-- Fim no codigo -->';

  unset($_SESSION['msg'], $_SESSION['CPF'], $_SESSION['Cliente'], $_SESSION['Email'], $_SESSION['Telefone'],  $_SESSION['Telefone']);

  echo  $footer;
  echo $javascript;
} else {

  header('Location: ../');
  exit();
}

?>