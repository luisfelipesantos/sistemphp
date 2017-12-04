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

// CAMINHOS ABSOLUTO DE DIVERSAS PASTAS DO SISTEMA #################################################
define('NOTFOUND', RAIZ . '/views/NotFound.php'); // Caminho para a view notfound
define('HOME', RAIZ . '/views/Home.php'); // Caminho para a view Home
define('CATEGORIAS', RAIZ . '/views/Categorias.php'); // Caminho para a view Categorias
define('PRODUTOS', RAIZ . '/views/Produtos.php'); // Caminho para a view Produtos
define('FOOTER', INCLUDES. '/Footer.php'); // Caminho para o footer do template
define('HEADER', INCLUDES. '/Header.php'); // Caminho para o header do template
 
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

// LINKS DE DIVERSAR PAGINAS DO SISTEMA PARA SEREM UTILIZADOS PELAS VIEWS ###############
define('BASE', 'http://sistemaphp.com.br/'); // Endereço base do sistema
define('BOOTSTRAP', BASE. '/views/_css/bootstrap.min.css'); // Caminho para o bootstrap
define('ESTILO', BASE . '/views/_css/estilo.css'); // Caminho para o estilo padrao da pagina
define('ERROS', BASE. '/views/_css/erros.css'); // Caminho para o estilo dos erros
define('VIEW_HOME', BASE. '/views/Home.php'); // Caminho para o view home
define('VIEW_CATEGORIAS', BASE. '/views/Categoria.php'); // Caminho para o view home
define('VIEW_PRODUTOS', BASE. '/views/Produtos.php'); // Caminho para o view home
define('VIEW_NOTFOUND', BASE. '/views/NotFound.php'); // Caminho para o view home


// Se você estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );
 
// Carrega o loader, que vai carregar a aplicação inteira
require_once RAIZ.'/loader.php';
?>
