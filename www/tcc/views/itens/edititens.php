<?php
require_once '../../app/auth.php';
require_once '../../layout/script.php';
require_once '../../app/models/produtos.class.php';
require_once '../../app/models/fabricante.class.php';
require_once '../../app/models/itens.class.php';

if(isset($_GET['q'])){

 $resp = $itens->editItens($_GET['q']);
  

echo $head;
echo $header;
echo $aside;
echo '<div class="content-wrapper">';

echo '<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar <small>Item</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i>Início</a></li>
        <li class="active">Itens</li>
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
              <h3 class="box-title">Item</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form"  enctype="multipart/form-data" action="../../app/Database/insertitens.php" method="POST">
              <div class="box-body">
              	<div class="form-group">
                  <label for="exampleInputEmail1">Nome do Produto</label>

            <select class="form-control" name="codProduto">
            ';
            $produtos->listProdutos($resp['Itens']['CodRefProduto']);
            echo '</select>
            </div>

            <div class="form-group">
                  <label for="exampleInputEmail1">Fabricante</label>

            <select class="form-control" name="idFabricante">
            ';
            $fabricante->listfabricante($resp['Itens']['idFabricante']);
            echo '</select>
            </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Quantidade de Itens</label>
                  <input type="text" name="QuantItens" class="form-control" id="exampleInputEmail1" placeholder="Quantidade de Itens" value="'.$resp['Itens']['QuantItens'].'">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Valor de Compra</label>
                  <input type="text" name="ValCompItens" class="form-control" id="exampleInputEmail1" placeholder="Valor de Compra" value="'.$resp['Itens']['ValCompItens'].'">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Valor de Venda</label>
                  <input type="text" name="ValVendItens" class="form-control" id="exampleInputEmail1" placeholder="Valor de Venda" value="'.$resp['Itens']['ValVendItens'].'">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Data de Compra</label>
                  <input type="date" name="DataCompraItens" class="form-control" id="exampleInputEmail1" placeholder="Data de Compra" value="'.$resp['Itens']['DataCompraItens'].'">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Data de Vencimento</label>
                <input type="date" name="DataVenci_Itens" class="form-control" id="exampleInputEmail1" placeholder="Data de Vencimento" value="'.$resp['Itens']['DataVenci_Itens'].'">
              </div>

                <div class="form-group">
                <label for="exampleInputEmail1">Imagem do Produto</label><br>';
        
                if(!empty($resp['Itens']['Image'])){
                  echo ' <td><img src="../'.$resp['Itens']['Image'].'" width="100"/></td><br><br>';
                }

               echo '<input type="file" name="arquivo" class="form-control">
              </div>
                <input type="hidden" name="valor" value="'.$resp['Itens']['Image'].'">

                 <input type="hidden" name="iduser" value="'.$idUsuario.'">
                 <input type="hidden" name="idItens" value="'.$resp['Itens']['idItens'].'">


              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="upload" class="btn btn-primary" value="Cadastrar">Editar</button>
                <a class="btn btn-danger" href="../../views/itens">Cancelar</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
          </div>
</div>';

echo '</div>';
echo '</div>';
echo '</section>';
echo '</div>';
echo  $footer;
echo $javascript;
}else{
	//header('Location: ./');
}
?>