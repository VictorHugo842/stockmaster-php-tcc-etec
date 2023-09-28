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
        Adicionar <small>Usuário</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Usuários</li>
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
              <h3 class="box-title">Usuário</h3>
            </div>
            <!-- /.box-header -->
            ';

            // só vai exibir se o usuário tiver permissão(administrador), se não da mensagem de não permitido
            if($perm == 1){
              echo'
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" action="../../app/Database/insertusuario.php" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nome do Usuário</label>
                  <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Nome do Usuário">
                </div>

              <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail do usuário">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Senha</label>
                <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Senha do Usuário">
              </div>
            
              <!-- /.box-body -->
            

              <div class="form-group">
              <label for="exampleInputEmail1">Foto de Perfil</label>
              <input id="arquivo" name="arquivo" type="file" class="form-control" id="exampleInputEmail1" placehoder="Imagem">
              </div>

              <div class="form-group">
              <label>Função</label>
              <select name="permissao" class="form-control">
              <option value="1">Administrador</option>
              <option value="2">Vendedor</option>
              </select>
              </div>

              <div class="box-footer">
              <button type="submit" name="update" class="btn btn-primary" value="Cadastrar">Cadastrar</button>
              <a class="btn btn-danger" href="../../views/usuario">Cancelar</a>
              </div>


            </form>

            ';}else{
               echo 'Você não possui acesso para esta página.';
            } 
            echo'  </div>
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