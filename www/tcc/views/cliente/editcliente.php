<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';
require_once '../../app/models/cliente.class.php';

if($perm == 1){ // VERIFICAR ,E CONTINUAR EDITAR CLIENTE, É O QUE VAI FALTAR. TROCAS fabricante por cliente
  echo $head;
  echo $header;
  echo $aside;
  

  echo '<div class="content-wrapper">';
  echo '<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        Editar  <small>Cliente</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="../"><i class="fa fa-dashboard"></i> Início</a></li>
          <li class="active">Cliente</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->';


  echo '
  <div class="row justify-content-center">
          <!-- left column --> 
  ';

      if(isset($_GET['id'])){

        $idCliente = $_GET['id'];
        $resp = $cliente -> EditCliente($idCliente);
          
  echo ' <div class="col-md-6">';
  require '../../layout/alert.php';
  echo'
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Cliente</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="../../app/Database/updatecliente.php" method="POST">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome do Cliente</label>
                    <input type="text" name="NomeCliente" class="form-control" id="exampleInputEmail1" placeholder="Nome do Cliente" value="'.$resp['Cliente']['NomeCliente'].'">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CPF do Cliente</label>
                    <input type="text" name="CpfCliente" class="form-control" id="exampleInputEmail1" placeholder="CPF do Cliente" value="'.$resp['Cliente']['CpfCliente'].'">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-mail do Cliente</label>
                    <input type="text" name="EmailCliente" class="form-control" id="exampleInputEmail1" placeholder="E-mail do Cliente" value="'.$resp['Cliente']['EmailCliente'].'">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telefone do Cliente</label>
                    <input type="text" name="TelefoneCliente" class="form-control" id="exampleInputEmail1" placeholder="Telefone do Cliente" value="'.$resp['Cliente']['TelefoneCliente'].'">
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Ativo</label>
                  <select name="StatusCliente">
                  ';
                      $StatusCliente = $resp['Cliente']['StatusCliente'];
                      if($StatusCliente == 1){
                        $selected1 = "selected";
                        $select0 = " ";
                      }else{
                        $selected1 = " ";
                        $selected0 = "selected";
                      }
                  echo '<option value="1" '.$selected1.'>Sim</option>
                    <option value="0" '.$selected0.'>Não</option>
                  </select>
                </div>

                  <input type="hidden" name="iduser" value="'.$idUsuario.'">
                  <input type="hidden" name="idCliente" value="'.$idCliente.'">
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" name="upload" class="btn btn-primary" value="Cadastrar">Editar</button>
                  <a class="btn btn-danger" href="../../views/cliente">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.box -->
            </div>
  </div>';
  }

  echo '</div>';
  echo '</div>';
  echo '</section>';
  echo '</div>';
  echo  $footer;
  echo $javascript;
}else{
  header('Location: ../../views/cliente/index.php'); // se não tiver volta para o index que exibe mensagem que não tem permissão.
}
?>