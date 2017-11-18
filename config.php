
<?php

/**
 *  Arquivos ".inc" são geralmente utilizados com essa nomenclatura para dizer que os
 *  arquivos são de "include", eles estão sendo requeridos ou incluídos em outra página PHP.
 *  Isso ajuda o desenvolvedor a saber quais arquivos são incluídos em outras.
 * 
 */
// ENDEREÇO BASE DO SITE ##############################################
define('BASE', 'http://localhost/sistemaphp/');

// CONFIGURAÇÕES PARA CONEXÃO COM O BANCO DE DADOS #####################
define('HOST', 'localhost'); // Local onde o banco de dados está armazenado
define('USUARIO', 'usuario'); // Usuário de acesso ao banco de dados
define('SENHA', '12345');    // Senha de acesso ao banco de dados
define('BANCO', 'tads');     // Nome do Banco de Dados
// CARREGAMENTO AUTOMATICO DE CLASSES ##################################
function __autoload($classe) {

    if (file_exists("classes/" . $classe . ".class.php")):
        require_once("classes/" . $classe . ".class.php");
    else:
        trigger_error("Erro ao incluir classes/" . $classe . ".class.php", E_USER_ERROR);
        die; // Prevenindo o travamento do código
    endif;
}

// TRATAMENTO DE ERROS #################################################
define('MSG_SUCESSO', 'sucesso');
define('MSG_DEPRECATED', 'deprecated');
define('MSG_INFO', 'notice');
define('MSG_ALERTA', 'warning');
define('MSG_ERRO', 'error');
define('TESTE', 'TESTE PARA O GIT');

// Sucesso = Personaliza a exibição dos sucessos obtidos no sistema
// É uma função auxiliar para colaborar na depuração do sistema
// $mensagem = Mensagem de sucesso 
function Sucesso($Mensagem,$arquivo) {

    $CssClass = MSG_SUCESSO;
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>SUCESSO</b><br>";
    echo "{$Mensagem}<br><span class=\"ajax_close\"></span>";
    echo "<small>Caminho do Arquivo: {$arquivo}</small></p>";

}

// Erros = Personaliza exibição de erros no Sistema
// $CodErro = Código de Erro
// $Mensagem = Mensagem de erro repassada a função
// $arquivo = arquivo onde se encontra o erro
// $Linha = Linha em qual se encontra o erro
function Erros($CodErro, $Mensagem, $arquivo, $Linha) {

    switch ($CodErro):
        case E_USER_NOTICE:
            $CssClass = MSG_INFO;
            echo "<p class=\"trigger {$CssClass}\">";
            echo "<b>NOTICE<br>";
            echo "Erro na Linha {$Linha}: </b> {$Mensagem}<br>";
            echo "<small>Caminho do Arquivo: {$arquivo}</small>";
            echo "<span class=\"ajax_close\"></span></p>";
            break;
        case E_USER_WARNING:
            $CssClass = MSG_ALERTA;
            echo "<p class=\"trigger {$CssClass}\">";
            echo "<b>WARNING<br>";
            echo "Erro na Linha {$Linha}: </b> {$Mensagem}<br>";
            echo "<small>Caminho do Arquivo: {$arquivo}</small>";
            echo "<span class=\"ajax_close\"></span></p>";
            break;
        case E_USER_ERROR:
            $CssClass = MSG_ERRO;
            echo "<p class=\"trigger {$CssClass}\">";
            echo "<b>FATAL ERROR<br>";
            echo "Erro na Linha {$Linha}: </b> {$Mensagem}<br>";
            echo "<small>Caminho do Arquivo: {$arquivo}</small>";
            echo "<span class=\"ajax_close\"></span></p>";
            break;
        case E_USER_DEPRECATED:
            $CssClass = MSG_DEPRECATED;
            echo "<p class=\"trigger {$CssClass}\">";
            echo "<b>DEPRECATED<br>";
            echo "Erro na Linha {$Linha}: </b> {$Mensagem}<br>";
            echo "<small>Caminho do Arquivo: {$arquivo}</small>";
            echo "<span class=\"ajax_close\"></span></p>";
            break;
    endswitch;

    if ($CodErro == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('Erros');

