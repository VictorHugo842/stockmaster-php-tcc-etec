<?php
// Inicia a sessão para armazenar dados do usuário logado
session_start();

// Recupera o valor do campo "username" do formulário de login enviado por POST
$username = $_POST['username'];

// Recupera o valor do campo "password" do formulário de login enviado por POST e criptografa com MD5
$password = md5($_POST['password']);

// Inclui o arquivo "connect.php" que contém a classe "connect" que assim pode ser chamado na linha de baixo.
require_once 'models/connect.php';

// Cria um objeto da classe "connect" e chama o método "login" passando os valores de "username" e "password" como parâmetros
$connect -> login($username, $password);
?>