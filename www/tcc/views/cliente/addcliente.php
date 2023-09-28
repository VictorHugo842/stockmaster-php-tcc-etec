<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';

echo $head;
echo $header;
echo $aside;
echo '<div class="content-wrapper">';
echo '<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Adicionar <small>Cliente</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Cliente</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    ';
    require '../../layout/alert.php';
    echo '
      <!-- Small boxes (Stat box) -->';

echo '
<div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cliente</h3>
            </div>
            <!-- /.box-header -->';


            if($perm == 1){ 
            echo '<!-- form start -->
            <form role="form" action="../../app/Database/insertcliente.php" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nome do Cliente</label>
                  <input type="text" name="NomeCliente" class="form-control" id="exampleInputEmail1" placeholder="Nome do Cliente">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">CPF do Cliente</label>
                  <input type="text" name="CpfCliente" class="form-control" id="exampleInputEmail1" placeholder="Cpf do Cliente">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">E-mail do Cliente</label>
                  <input type="text" name="EmailCliente" class="form-control" id="exampleInputEmail1" placeholder="E-mail do Cliente">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Telefone do Cliente</label>
                  <input type="text" name="TelefoneCliente" class="form-control" id="exampleInputEmail1" placeholder="Telefone do Cliente">
                </div>
                
            <input type="hidden" name="iduser" value="'.$idUsuario.'">
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="upload" class="btn btn-primary" value="Cadastrar">Cadastrar</button>
                <a class="btn btn-danger" href="../../views/cliente">Cancelar</a>
              </div>
            </form>';
            }else{
              echo "Você não possui acesso para esta página.";
            }

      echo '</div>
          <!-- /.box -->
          </div>
</div>';

echo '</div>';
echo '</div>';
echo '</section>';
echo '</div>';
echo  $footer;
echo $javascript;
?>