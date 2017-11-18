<?php

echo 'config carregado <br>';
/**
 * Configurações gerais do sistema
 */

// CONFIGURAÇÕES DE ACESSO AS PASTAS DO SISTEMA ###################################
define( 'RAIZ', dirname( __FILE__ ) ); // Obter o caminho da raiz do sistema

// Se raiz não puder ser definida aplicação precisa ser finalizada
if (!defined('RAIZ')):
    echo 'Definição de diretorio raiz não pode ser realizada, verifique com o admin do servidor';
    exit;
endif;

define( 'UPLOADS', RAIZ . '/views/_uploads' ); // Caminho para a pasta de uploads
define( 'IMAGENS', RAIZ . '/views/_imagens' ); // Caminho para a pasta de imagens
define( 'CSS', RAIZ . '/views/_css' ); // Caminho para a pasta de uploads
 
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
define('BASE', 'http://localhost/sistemaphp/');

// Se você estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );
 
// Carrega o loader, que vai carregar a aplicação inteira
require_once RAIZ.'/loader.php';
?>
