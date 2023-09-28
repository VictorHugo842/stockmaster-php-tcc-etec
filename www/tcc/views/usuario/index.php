<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';
require_once '../../app/models/usuario.class.php';

echo $head;
echo '  <style>
/* Largura da coluna "Foto do Usuário" */
table#example1 th:nth-child(1),
table#example1 td:nth-child(1) {
  width: 4%; /*  */
}
/* Largura da coluna "Editar" */
table#example1 th:nth-child(2),
table#example1 td:nth-child(2) {
  width: 40%; /*  */
}

/* Largura da coluna "Editar" */
table#example1 th:nth-child(4),
table#example1 td:nth-child(4) {
  width: 1%; /* */
}
</style>';
echo $header;
echo $aside;
echo '<div class="content-wrapper">
		<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuários
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i>Início</a></li>
        <li class="active">Usuários</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    ';
    require '../../layout/alert.php';
    echo '
      <!-- Small boxes (Stat box) -->
      <div class="row">
      	<div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Lista de Usuários</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
              <thead>
              <tr>
                <th>Imagem</th>
                 <th>Nome</th>
                 <th>Permissão</th>
                 <th>Editar</th>
              </tr>
              </thead>
              <tbody>';
              
              if($perm == 1){

               $resp = $usuario->index($perm);
               $resps = json_decode($resp,true); 

               foreach($resps as $row){

                      if(isset($row['idUser']) != NULL){

                            echo '<tr>';
                            echo '<td>'; // Adicionando margem à direita
                            echo '<img src="../' . $row['Imagem'] . '" width="50"/>';
                            echo '</td>';
                            echo '<td>';
                            echo $row['Username'];
                            echo '</td>';
                            echo '<td>';
                            if ($row['Permissao'] == 1) {
                                echo "Administrador";
                            } else {
                                echo "Vendedor";
                            }
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="editusuario.php?q=' . $row['idUser'] . '" style="float: right;"><i class="fa fa-edit"></i></a>';
                            echo '</td>';
                            echo '</tr>';
                            
                      }

               }

               echo '
               </tbody>
               </table>
               </div>
               <!-- /.box-body -->
               <div class="box-footer clearfix no-border">
                 <a href="addusuario.php" type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Adicionar Usuários</a>
               </div>
             </div>';
              }else{
                echo "Você não possui acesso para esta página.";
              }

            
echo '</div>';
echo '</section>';
      
       
	  

echo '</div>';

echo  $footer;
echo $javascript;
?>

 