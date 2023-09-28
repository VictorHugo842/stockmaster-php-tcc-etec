<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';
require_once '../../app/models/fabricante.class.php';

if($perm == 1){
  echo $head;
  echo $header;
  echo $aside;

  echo '<div class="content-wrapper">';
  echo '<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        Editar  <small>Fabricante</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="../"><i class="fa fa-dashboard"></i> Início</a></li>
          <li class="active">Fabricante</li>
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

        $idFabricante = $_GET['id'];
        $resp = $fabricante -> EditFabricante($idFabricante);
          
  echo ' <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Fabricante</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="../../app/Database/updatefabricante.php" method="POST">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nome da Empresa</label>
                    <input type="text" name="NomeFabricante" class="form-control" id="exampleInputEmail1" placeholder="Nome Fabricante" value="'.$resp['Fabricante']['Nome'].'">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CNPJ</label>
                    <input type="text" name="CNPJFabricante" class="form-control" id="exampleInputEmail1" placeholder="CNPJ" value="'.$resp['Fabricante']['CNPJ'].'">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="text" name="EmailFabricante" class="form-control" id="exampleInputEmail1" placeholder="E-mail" value="'.$resp['Fabricante']['Email'].'">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Endereço</label>
                    <input type="text" name="EnderecoFabricante" class="form-control" id="exampleInputEmail1" placeholder="Endereço" value="'.$resp['Fabricante']['Endereco'].'">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telefone</label>
                    <input type="text" name="TelefoneFabricante" class="form-control" id="exampleInputEmail1" placeholder="Telefone" value="'.$resp['Fabricante']['Telefone'].'">
                  </div>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Ativo</label>
                  <select name="Ativo">
                  ';
                      $ativo = $resp['Fabricante']['Ativo'];
                      if($ativo == 1){
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
                  <input type="hidden" name="idFabricante" value="'.$idFabricante.'">
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" name="upload" class="btn btn-primary" value="Cadastrar">Editar</button>
                  <a class="btn btn-danger" href="../../views/fabricante">Cancelar</a>
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
  header('Location: ../../views/fabricante/index.php');
}
?>