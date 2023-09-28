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
        Adicionar <small>Produtos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Produtos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->';

echo '
        <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Produto</h3>
            </div>
            <!-- /.box-header -->
            ';

            if($perm == 1){
              echo' <!-- form start -->
              <form role="form" action="../../app/Database/insertprod.php" method="POST">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome do Produto</label>
                    <input type="text" name="NomeProduto" class="form-control" id="exampleInputEmail1" placeholder="Nome Produto">
                  </div>
                  <input type="hidden" name="iduser" value="'.$idUsuario.'">
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" name="update" class="btn btn-primary" value="Cadastrar">Cadastrar</button>
                  <a class="btn btn-danger" href="../../views/prod">Cancelar</a>
                </div>
              </form>';
            }else{
              echo "Você não possui acesso para esta página.";
            }
         echo ' </div>
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