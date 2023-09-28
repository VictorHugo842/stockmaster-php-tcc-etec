<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';
require_once '../../app/models/itens.class.php';
 
echo $head;
echo $header;
echo $aside;
echo '<div class="content-wrapper">
		<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Totais dos Itens
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i> Início</a></li>
        <li class="active">Itens</li>
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
              <h3 class="box-title">Itens de Produto</h3>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">';


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
         echo' <ul class="todo-list">';
               $itens->totalitens($value);
         echo '</ul>';     
        echo ' </div>
            <!-- /.box-body -->
           
            <div class="box-footer clearfix no-border">
              
              <a href="index.php" type="button" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Voltar</a>
            </div>
          </div>
	 
';
echo '</div>';
echo '</section>';
      
       
	  

echo '</div>';

echo  $footer;
echo $javascript;
?>