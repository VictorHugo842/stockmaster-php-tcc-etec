<?php

if(isset($_GET['alert'])){

echo '<div class="box-body">';
	switch ($_GET['alert']) {
		case '0':
			echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                <strong>Operação não realizada!</strong>
              </div>';
			break;
			
		case '1':
			echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alerta!</h4>
                <strong>Operação realizada com sucesso!</strong>
              </div>';
			break;

		case '10': // para quando já tem cliente com o mesmo CPF.
			echo '<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-warning"></i> Alerta!</h4>
			<strong>Já existe um cliente com o mesmo CPF!</strong>
		  </div>';
			break;

		case '11': // para quando não preenche os campos necessários.
			echo '<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-warning"></i> Alerta!</h4>
			<strong>Todos os campos são obrigatórios</strong>
			</div>';
			break;
		
		}//switch
	echo'</div>';
}