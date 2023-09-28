<?php
require_once '../../app/auth.php';
require_once '../../app/models/vendas.class.php';

if (
    isset($_POST['idItem']) &&
    isset($_POST['qtd']) &&
    isset($_POST['NomeCliente']) &&
    isset($_POST['EmailCliente']) &&
    isset($_POST['CpfCliente']) &&
    isset($_POST['TelefoneCliente']) &&
    !empty($_POST['idItem']) &&
    !empty($_POST['qtd']) &&
    !empty($_POST['NomeCliente']) &&
    !empty($_POST['EmailCliente']) &&
    !empty($_POST['CpfCliente']) &&
    !empty($_POST['TelefoneCliente'])
) {


        $NomeCliente = $_POST['NomeCliente'];
        $EmailCliente = $_POST['EmailCliente'];
        //$CpfCliente = connect::limpaCPF_CNPJ($_POST['Cpfcliente']);
        $CpfCliente = $_POST['CpfCliente'];
        $TelefoneCliente = $_POST['TelefoneCliente'];
        $cart = $_SESSION['cart'];
        
        foreach ($_POST['idItem'] as $key => $error) {
    
            $id = $_POST['idItem'][$key];
            $quant = $_POST['qtd'][$key];
            
            $vendas = new Vendas;
            $result = $vendas->itensVerify($id, $quant, $perm);
        
            if($result['status'] == 0){
        
                $_SESSION['msg'] = '<div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Ops! O produto <b>' . $result['NomeProduto'] . '</b> excede o total em estoque: <b>' . $result['estoque'] . '</b>
                    </div>
                </div>
            </div>';
                header('Location: ../../views/vendas/');
                exit;
        
                
            }
        
        }
        
        
        foreach ($_POST['idItem'] as $key => $error) {
            
            $id = $_POST['idItem'][$key];
            $quant = $_POST['qtd'][$key];
        
            $vendas = new Vendas;
            $vendas->itensVendidos($id, $quant, $NomeCliente, $EmailCliente, $CpfCliente,$TelefoneCliente,$cart, $idUsuario, $perm);
        
        }     

    }else{
        
        $_SESSION['msg'] = '<div class="row">
        <div class="col-md-6 mx-auto">
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Falta preencher alguns campos obrigatórios
        </div>
        </div>
        </div>';
        
        

        header('Location:../../views/vendas/index.php');
    }

?>