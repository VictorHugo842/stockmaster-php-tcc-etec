<?php
require_once '../app/auth.php';
require_once '../layout/script.php';
require_once '../app/models/relatorio.class.php';

echo $head;
echo $header;
echo $aside;
echo '<div class="content-wrapper">'; // CONTEÚDO


echo '<section class="content" style="height: auto !important; min-height: 0px !important;">
';

if($perm == 1){
  echo'
      <!-- Small boxes (Stat box) -->     

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3>';
            $relatorio = new Relatorio();
            $produtos = $relatorio->cardProdutos($perm);
            echo $produtos;
           echo'</h3>

              <p>Produtos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="'.$url.'prod/" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>';   
              $relatorio = new Relatorio();
              $r = $relatorio->qtdeItensEstoqueTotal($perm);
              echo $r;

              echo'</h3>

              <p>Itens em Estoque</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="'.$url.'relatorio/" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <h3>';
            $relatorio = new Relatorio();
            $usuarios = $relatorio->cardUsuarios($perm);
            echo $usuarios;
            
           echo'</h3>

              <p>Usuários</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="'.$url.'usuario/" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">

           <h3>';
           $relatorio = new Relatorio();
           $clientes = $relatorio->cardClientes($perm);
           echo $clientes;
           
          echo'</h3>

              <p>Clientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="'.$url.'cliente/" class="small-box-footer">Ver lista <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->';

}
echo '
      <!-- Main row -->
       <!-- Image and text center -->
      <div class="row">

        <div class="col-md-12 text-center">
          <img class="rounded" style="max-width:60%;" src="dist/img/logo.png" alt="logo" /> 
        </div>
        <div class="col-md-12 text-center">  
        <h1 style="text-align:center" > Olá <b>'.$username.'</b>, seja bem vindo <br> ao Controle de estoque em PHP!</h1>       

        <div class="g-ytsubscribe" data-channel="ftptiago" data-layout="default" data-count="hidden"></div>
        
        </div>
      </div>

      <!-- Image and text center -->

    </section>

</div>
';


echo '</div>';

echo $footer;
echo $javascript;

?>