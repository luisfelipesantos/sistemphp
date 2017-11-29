<?php

// Evitando que o usuário acesse o arquivo diretamente
// redirecionando para index.php
if (basename($_SERVER["PHP_SELF"]) == basename(__FILE__)):
    exit("<script>window.location=('index.php')</script>");
endif;

// Inicia a sessão
// Explicar melhor sobre o uso de sessão
session_start();

// Verifica o modo para debugar
if (!defined('DEBUG') || DEBUG === false):

    // Esconde todos os erros
    error_reporting(0);
    ini_set("display_errors", 0);
else:

    // Mostra todos os erros
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
endif;

// Funções globais
require_once RAIZ . '/globais/funcoes.php';

// Carrega a aplicação
$Aplicacao = new AplicacaoMVC();

if (defined('DEBUG') && DEBUG === true):

    echo '<hr>';
    echo '<center>var_dump da aplicação</center>';
    echo '<center>Exibido apenas durante o desenvolvimento</center>';
    var_dump($Aplicacao);
    echo '<hr>';

endif;


