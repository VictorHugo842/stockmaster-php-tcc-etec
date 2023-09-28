<?php
 require_once 'connect.php';

 class Relatorio extends Connect
 {
	 
	public function qtdeItensEstoqueTotal($perm)
	{
		if ($perm == 1) {

			$query = "SELECT SUM(`QuantItens`) AS QuantItens , SUM(`QuantItensVend`) AS QuantItensVend FROM `itens`";

			$result = mysqli_query($this->SQL, $query);

			if ($row = mysqli_fetch_assoc($result)) {

				$qi = $row['QuantItens'];
				$qiv = $row['QuantItensVend'];
				$r = $qi - $qiv;
				return $r;
			}
		}
	}


    public function qtdeItensEstoque($perm, $status = null, $idProduto = null)
	{
		if ($perm == 1) {

			if ($idProduto != null) {
				$AND = "AND `Produto_CodRefProduto` = '$idProduto' AND `Ativo` = '$status'";
			} elseif ($status != null) {
				$AND = "AND `Ativo` = '$status'";
			} else {
				$AND = "";
			}


			$query = "SELECT `Produto_CodRefProduto`, `NomeProduto`, SUM(`QuantItens`) AS QuantItens , SUM(`QuantItensVend`) AS QuantItensVend FROM `itens`, `produtos`
				WHERE `Produto_CodRefProduto` = `CodRefProduto`
				$AND
				GROUP BY `Produto_CodRefProduto`";

			$result = mysqli_query($this->SQL, $query);

			while ($row[] = mysqli_fetch_assoc($result));
			return json_encode($row);
		}
	}

    public function selectProduto($perm, $status = null)
	{
		if ($perm == 1) {

			if ($status != null) {
				$where = "WHERE `Ativo` = '$status'";
			} else {
				$where = "";
			}

			$query = "SELECT `CodRefProduto`,`NomeProduto` FROM `produtos` $where";
			$result = mysqli_query($this->SQL, $query);
			while ($row[] = mysqli_fetch_assoc($result));

			return json_encode($row);
		}
	}

	public function cardClientes($perm)
	{
		if ($perm == 1) {
			$query = "SELECT COUNT(*) as totalClientes FROM `cliente`"; // Consulta para obter a contagem de clientes
			$result = mysqli_query($this->SQL, $query);
			$row = mysqli_fetch_assoc($result);
			
			$totalClientes = (int)$row['totalClientes']; // Converter o valor para inteiro
			
			return json_encode($totalClientes); // Retorna apenas a contagem de clientes como um JSON sem aspas
		}
	}

	public function cardUsuarios($perm)
	{
		if ($perm == 1) {
			$query = "SELECT COUNT(*) as totalUsuarios FROM `usuario`"; // Consulta para obter a contagem de clientes
			$result = mysqli_query($this->SQL, $query);
			$row = mysqli_fetch_assoc($result);
			
			$totalUsuarios = (int)$row['totalUsuarios']; // Converter o valor para inteiro
			
			return json_encode($totalUsuarios); // Retorna apenas a contagem de clientes como um JSON sem aspas
		}
	}

	public function cardProdutos($perm)
	{
		if ($perm == 1) {
			$query = "SELECT COUNT(*) as totalProdutos FROM `produtos`"; // Consulta para obter a contagem de clientes
			$result = mysqli_query($this->SQL, $query);
			$row = mysqli_fetch_assoc($result);
			
			$totalProdutos = (int)$row['totalProdutos']; 
			
			return json_encode($totalProdutos); 
		}
	}

}


?>