<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';
require_once '../../app/models/usuario.class.php';

echo $head;
echo $header;
echo $aside;
echo '<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Perfil</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    ';
    require '../../layout/alert.php';
    echo '

      <div class="row">
        <div class="col-md-3" style="position: absolute; top: 30%; left: 45%;"> 

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="'.$url.'/'.$foto.'" alt="User profile picture">

              <h3 class="profile-username text-center">'.$username.'</h3>

              <p class="text-muted text-center">'; 

              switch($perm){
                    
                    case 0:
                    $perfil = 'Cliente';
                    break;
                    case 1:
                    $perfil = 'Administrador';
                    break;
                    case 2: 
                    $perfil = 'Vendedor';
                    break;
                  }
              echo $perfil; 
              echo'</p>

              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-default">
                Alterar senha
              </button>

              <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Alterar Senha</h4>
              </div>
              <form action="../../app/Database/trocasenha.php" method="post">
              <div class="modal-body">
              <div class="form-group">
              <label for="passAtual">Senha Atual</label> 
                <input type="password" class="form-control" id="passAtual" name="passAtual">
                </div>
                <div class="form-group">
                <label for="password">Nova Senha</label> 
                <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                <label for="rpassword">Repetir nova senha</label> 
                <input type="password" class="form-control" id="rpassword" name="rpassword">
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
             
                    
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>';

echo '</div>';

echo $footer;
echo $javascript;
?>