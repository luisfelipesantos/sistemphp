<?php

// Evitando que o usuário acesse o arquivo diretamente
// redirecionando para index.php
if (basename($_SERVER["PHP_SELF"]) == basename(__FILE__)):
    exit("<script>window.location=('index.php')</script>");
endif;


session_start();
/**
 * Configurações gerais do sistema
 */
// MONTAGEM DE CAMINHOS ABSOLUTO PARA DIVERSAS PASTAS DO SISTEMA ###################################
define('RAIZ', __DIR__); // Obter o caminho da raiz do sistema
define('CLASSES', RAIZ . '/classes'); // Caminho para a pasta de classes
define('VIEW', CLASSES . '/view'); // Caminho para a pasta de views do sistema
define('MODEL', CLASSES . '/model'); // Caminho para a pasta model do sistema 
define('CONTROLLER', CLASSES . '/controller'); // Caminho para a pasta controller do sistema
define('UPLOADS', VIEW . '/_uploads'); // Caminho para a pasta de uploads
define('IMAGENS', VIEW . '/_imagens'); // Caminho para a pasta de imagens
define('CSS', VIEW . '/_css'); // Caminho para a pasta de CSS
define('INCLUDES', VIEW . '/_includes'); // Caminho para a pasta de includes
define('JS', VIEW . '/_js'); // Caminho para a pasta de javascript

// LINKS PARA REDIRECIONAMENTO DE USUARIOS ################################################
define('BASE', 'http://localhost/sistemaphp/index.php' );
define('BOOTSTRAP', 'http://localhost/sistemaphp/classes/view/_css/bootstrap.min.css'); // Caminho para o bootstrap
define('ESTILO', 'http://localhost/sistemaphp/classes/view/_css/estilo.css'); // Caminho para o estilo padrao da pagina
define('ERROS', 'http://localhost/sistemaphp/classes/view/_css/erros.css'); // Caminho para o estilo dos erros
define('LINK_HOME', 'http://localhost/sistemaphp/index.php?controller=home'); // Link para controller carregar home
define('LINK_CATEGORIAS', 'http://localhost/sistemaphp/index.php?controller=categorias&acao=listar'); // Link para controller carregar categorias
define('LINK_PRODUTOS', 'http://localhost/sistemaphp/index.php?controller=produtos&acao=listar'); // Link para controller carregar produtos

// CAMINHOS PARA DIVERSAS PASTAS DO SISTEMAS  ################################################
define('VIEW_HOME', VIEW . '/Home.php'); // Caminho para o view home
define('VIEW_CATEGORIAS', VIEW . '/Categorias.php'); // Caminho para o view categorias
define('VIEW_PRODUTOS', VIEW . '/Produtos.php'); // Caminho para o view produtos
define('VIEW_NOTFOUND', VIEW . '/NotFound.php'); // Caminho para o view Notfound
define('VIEW_ERROS', VIEW . '/Erros.php'); // Caminho para o view Erros
define('FOOTER', INCLUDES . '/Footer.php'); // Caminho para o footer do template
define('HEADER', INCLUDES . '/Header.php'); // Caminho para o header do template

// CONFIGURAÇÕES PARA CONEXÃO COM O BANCO DE DADOS ############################
define('HOST', 'localhost');  // Local onde o banco de dados está armazenado
define('USUARIO', 'usuario'); // Usuário de acesso ao banco de dados
define('SENHA', '12345');     // Senha de acesso ao banco de dados
define('BANCO', 'estoque');   // Nome do Banco de Dados
define('CHARSET', 'utf8');  // Charset da conexão PDO

// TRATAMENTO DE ERROS #################################################
define('MSG_SUCESSO', 'sucesso');
define('MSG_DEPRECATED', 'deprecated');
define('MSG_INFO', 'notice');
define('MSG_ALERTA', 'warning');
define('MSG_ERRO', 'error');

// Se você estiver desenvolvendo, modifique o valor para true
define('DEBUG', true);

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

// Carrega o loader, que vai carregar a aplicação inteira
require_once 'loader.php';
?>
