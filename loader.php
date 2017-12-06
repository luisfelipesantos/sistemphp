<?php

// Evitando que o usuário acesse o arquivo diretamente
// redirecionando para index.php
if (basename($_SERVER["PHP_SELF"]) == basename(__FILE__)):
    exit("<script>window.location=('index.php')</script>");
endif;

// FUNÇÕES GLOBAIS QUE PODEM SER UTILIZADAS POR TODAS AS CLASSES ######
// CARREGAMENTO AUTOMATICO DE CLASSES ##################################
/**
 * Função responsável pelo carregamento automatico de classes
 * @param string $classe Armazena o nome da classe
 */
function __autoload($classe) {

    $diretorio = ['auxiliares', 'controller', 'model', 'view']; // Nomes dos diretorios
    $inclusao = null; // Para verificar se a inclusao ocorreu

    /**
     * Explicação:
     * Se arquivo existe e não é um diretorio então e um arquivo de classe
     * tente realizar a inclusão caso contrario informe um erro
     */
    foreach ($diretorio as $nome):

        if (!$inclusao &&
                file_exists(CLASSES . "/{$nome}/{$classe}.class.php") &&
                !is_dir(CLASSES . "/{$nome}/{$classe}.class.php")):
            require_once CLASSES . "/{$nome}/{$classe}.class.php";
            $inclusao = true;
        endif;

    endforeach;

    if (!$inclusao):

        $_SESSION['msg'] = "Não foi possível incluir a classe {$classe}.class.php";
        $_SESSION['CodErro'] = E_USER_ERROR;
        require_once VIEW_ERROS;
        die;
    endif;
}

// TRATAMENTO DE ERROS PELO USUARIO  ##################################
// 
// Sucesso = Personaliza a exibição dos sucessos obtidos no sistema
// É uma função auxiliar para colaborar na depuração do sistema
// $mensagem = Mensagem de sucesso 
function Sucesso($Mensagem, $arquivo) {

    $CssClass = MSG_SUCESSO;
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>SUCESSO</b><br>";
    echo "{$Mensagem}<br><span class=\"ajax_close\"></span>";
    echo "<small>Caminho do Arquivo: {$arquivo}</small></p>";
}

// Carrega a aplicação
$Aplicacao = new ControllerPrincipal($_GET);
$Aplicacao->ObterRota();

if (defined('DEBUG') && DEBUG === true):

    echo '<hr>';
    echo '<center>var_dump da aplicação</center>';
    echo '<center>Exibido apenas durante o desenvolvimento</center>';
    var_dump($Aplicacao);
    echo '<hr>';

endif;


