<?php
// Inicia sessões, para assim poder destruí-las
session_start();

// Destrói todas as variáveis de sessão, isso é necessário para garantir que o usuário está deslogado corretamente
session_destroy();

// Redireciona o usuário para a página do index.php da views, onde faz a autenticação e retorna ao login por está deslogado.
header("Location: index.php");

?>