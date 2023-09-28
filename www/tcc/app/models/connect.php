<?php

/**
 * Classe Connect para conexão com o banco de dados
 */
class Connect
{
	// Definição das variáveis de conexão com o banco de dados
	var $localhost = "localhost";
	var $root = "root";
	var $passwd = "";
	var $database = "stockmaster";
	var $SQL;
	
	/**
	 * Construtor da classe, cria uma conexão com o banco de dados
	 */
	public function __construct()
	{
		// Conecta ao MY SQL usando as variáveis definidas, necessário a porta pois não é o padrão 3306
		$this->SQL = mysqli_connect($this->localhost, $this->root, $this->passwd,$this->database,3307);
		
		// Seleciona o banco de dados
		mysqli_select_db($this->SQL, $this->database);
		
		// Verifica se ocorreu um erro na conexão com o banco de dados
		if(!$this->SQL){
			//DIE para o script imediatamente e a mensagem de erro é exibida na tela do usuário.
			die("Conexão com o banco de dados falhou!:" . mysqli_connect_error($this->SQL)); 
		}
	}

	
	// Função para fazer o login do usuário
	function login($username, $password)
	{
		// Query para selecionar o usuário com o nome de usuário correspondente
		$this->query  = "SELECT * FROM `usuario` WHERE `Username` = '$username'";
		
		// Executa a query e armazena o resultado em $result
		$this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
		
		// Obtém o número de linhas retornadas
		$this->total  = mysqli_num_rows($this->result);

		// Verifica se o número de linhas é maior que zero
		if($this->total){
			// Obtém os dados do usuário
			$this->dados = mysqli_fetch_array($this->result);
			
			// Verifica se a senha informada é igual à senha do usuário,strcmp compara se as strings são iguais ou diferentes,por padrão é 0, se for diferente de 0 é igual, se não, é 1(diferente).
			if(!strcmp($password, $this->dados['Password'])){

				// Define as variáveis de sessão do usuário, o session armazena as informações do usuário em especifico.
				$_SESSION['idUsuario'] = $this->dados['idUser']; //  $this->dados (dados da tabela do DB.)
				$_SESSION['usuario']   = $this->dados['Username'];
				$_SESSION['perm']      = $this->dados['Permissao'];
				$_SESSION['foto']      = $this->dados['Imagem'];
				$_SESSION['dataregistro']   = $this->dados['Dataregistro'];

				// Redireciona o usuário para a página de destino
				header("Location: ../views/");
			}else{
				// Redireciona o usuário para a página de login com um alerta caso a senha esteja errada.
				header("Location: ../login.php?alert=2"); // cria o parametro alert, que é chamada através do GET em login.php
			}											// o ? indica o inicio do parametro.
		}else{
			// Redireciona o usuário para a página de login com um alerta caso o usuário esteja errado.
			header("Location: ../login.php?alert=1");
		}
	}

	function limpaCPF_CNPJ($valor){

		$valor = trim($valor);
		$valor = str_replace(".","",$valor);
		$valor = str_replace(",","",$valor);
		$valor = str_replace("-","",$valor);
		$valor = str_replace("/","",$valor);
		return $valor;
	}

	function format_CPF($nbr_cpf)
	{

		$parte_um     = substr($nbr_cpf, 0, 3);
		$parte_dois   = substr($nbr_cpf, 3, 3);
		$parte_tres   = substr($nbr_cpf, 6, 3);
		$parte_quatro = substr($nbr_cpf, 9, 2);

		$monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

		return $monta_cpf;
	}

	function format_moeda($valor)
	{
		return 'R$' . number_format($valor, 2, ',', '.');
	}
}

// Cria uma nova instância da classe Connect e armazena em $connect
$connect = new Connect;
?>