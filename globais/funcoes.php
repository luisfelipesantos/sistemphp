<?php

// Evitando que o usuário acesse o arquivo diretamente
// redirecionando para index.php
if (basename($_SERVER["PHP_SELF"]) == basename(__FILE__)):
    exit("<script>window.location=('index.php')</script>");
endif;

// CARREGAMENTO AUTOMATICO DE CLASSES ##################################
/**
 * Função responsável pelo carregamento automatico de classes
 * @param string $classe Armazena o nome da classe
 */
function __autoload($classe) {

    $diretorio = ['aplicacao', 'auxiliares','controller','model']; // Nomes dos diretorios
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
            include_once CLASSES . "/{$nome}/{$classe}.class.php";
            $inclusao = true;
        endif;

    endforeach;

    if(!$inclusao):
        trigger_error("Não foi possível incluir a classe {$classe}.class.php ", E_USER_ERROR);
        die;
    endif;

}

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

/**
 * Verifica chaves de arrays
 *
 * Verifica se o Indice existe no Vettor e se ela tem algum valor.
 * Obs.: Essa função está no escopo global, pois, será bem utilizada.
 * @param array  $Vetor O array
 * @param string $Indice   A chave do array
 * @return string|null  O valor da chave do array ou nulo
 */
function VerificarVetor ( $Vetor, $Indice ) {
    
	// Verifica se a chave existe no array
	if ( isset( $Vetor[ $Indice ] ) && ! empty( $Vetor[ $Indice ] ) ) {
		// Retorna o valor da chave
		return $Vetor[ $Indice ];
	}
	
	// Retorna nulo por padrão
	return null;
}
