<?php

// Evitando que o usuário acesse o arquivo diretamente
// redirecionando para index.php
if (basename($_SERVER["PHP_SELF"]) == basename(__FILE__)):
    exit("<script>window.location=('index.php')</script>");
endif;

/**
 * Configurações gerais do sistema
 */

// CAMINHOS PARA ACESSO A DIVERSAS PASTAS DO SISTEMA ###################################
define( 'RAIZ', __DIR__ ); // Obter o caminho da raiz do sistema
define( 'UPLOADS', RAIZ . '/views/_uploads' ); // Caminho para a pasta de uploads
define( 'IMAGENS', RAIZ . '/views/_imagens' ); // Caminho para a pasta de imagens
define( 'CSS', RAIZ . '/views/_css' ); // Caminho para a pasta de CSS
define( 'INCLUDES', RAIZ . '/views/_includes' ); // Caminho para a pasta de includes
define( 'JS', RAIZ . '/views/_js' ); // Caminho para a pasta de javascript
define( 'CLASSES', RAIZ . '/classes' ); // Caminho para a pasta de classes

// CAMINHOS DE DIVERSAS VIEWS DO SISTEMA #################################################
define('NOTFOUND', RAIZ . '/views/notfound/NotFound.php'); // Caminho para a view notfound
define('HOME', RAIZ . '/views/home/Home.php'); // Caminho para a view Home
define('FOOTER', INCLUDES. '/Footer.html'); // Caminho para o footer do template
define('HEADER', INCLUDES. '/Header.html'); // Caminho para o header do template

// CAMINHOS PARA ELEMENTOS UTILIZADOS PELAS VIEWS DO SISTEMA #############################
define('BOOTSTRAP', CSS. '/bootstrap.min.css'); // Caminho para o bootstrap
define('ESTILO', CSS. '/estilo.css'); // Caminho para o estilo da pagina
define('ERROS', CSS. '/erros.css'); // Caminho para o estilo dos erros
 
// CONFIGURAÇÕES PARA CONEXÃO COM O BANCO DE DADOS ############################
define('HOST', 'localhost');  // Local onde o banco de dados está armazenado
define('USUARIO', 'usuario'); // Usuário de acesso ao banco de dados
define('SENHA', '12345');     // Senha de acesso ao banco de dados
define('BANCO', 'estoque');   // Nome do Banco de Dados
define( 'CHARSET', 'utf8' );  // Charset da conexão PDO

// TRATAMENTO DE ERROS #################################################
define('MSG_SUCESSO', 'sucesso');
define('MSG_DEPRECATED', 'deprecated');
define('MSG_INFO', 'notice');
define('MSG_ALERTA', 'warning');
define('MSG_ERRO', 'error');

// ENDEREÇO BASE DO SITE ##############################################
define('BASE', 'http://sistemaphp.com.br');

// Se você estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );
 
// Carrega o loader, que vai carregar a aplicação inteira
require_once RAIZ.'/loader.php';
?>
