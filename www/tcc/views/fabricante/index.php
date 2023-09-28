<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';
require_once '../../app/models/fabricante.class.php';

echo $head;
echo $header;
echo $aside;
echo '<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Fabricante
  </h1>
  <ol class="breadcrumb">
    <li><a href="../"><i class="fa fa-dashboard"></i>Início</a></li>
    <li class="active">Fabricante</li>
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

      <h3 class="box-title">Lista de Fabricante</h3>

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
      <ul class="todo-list not-done">';

        if(isset($_POST['public']) != NULL){               

          $value = $_POST['public']; 
          if($value == 1){
            $public = 0;
            $button_name = "Inativos";

          }else{
            $public = 1;
            $button_name = "Publicados";
          }     

        }else{
          $value = 1;
          $public = 0;
          $button_name = "Inativos";
        }

        if($perm == 1){

        $fabricante->index($value);

        echo '</ul>
        <br/>
        <!-- /.box-body -->
        <div class="left">
         <form action="index.php" method="post">

         <button name="public" type="submit" value="'.$public.'" class="btn btn-default pull-left"><i class="fa fa-plus"></i> '.$button_name.'</button></div></form>

           <a href="addfabricante.php" type="button" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Adicionar Fabricante</a>
         </div>
       </div>
       ';
        }else{
          echo "Você não possui acesso para esta página.";
        }
        
       echo '</div>';
       echo '</section>';
       echo '</div>';

       echo  $footer;
       echo $javascript;
       ?>

