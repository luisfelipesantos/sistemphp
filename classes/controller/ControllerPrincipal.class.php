<?php

/**
 * @projeto: sistemaphp
 * @nome: AplicacaoMVC.class 
 * @Descrição: Classe responsável por definir o controller principal do sistema
 * @copyright (c) 13/11/2017, Iury Gomes - IFTO
 * @autor Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @versao 1.0 - 13/11/2017
 * @metodos 
 */
class ControllerPrincipal {

    private $controller; // Receberá o valor do controlador contido na URL: exemplo.com?controller=home
    private $acao; // Receberá o valor da ação contido na URL: exemplo.com?controller=home&acao=valor
    private $parametros; // Receberá um array dos parâmetros contindo na URL: exemplo.com

    public function __construct(array $GET) {

        
        if (!empty($GET['controller'])):
            $this->controller = $GET['controller'];
        else:
            $this->controller = null;
        endif;

        
        if (!empty($GET['acao'])):
            $this->acao = $GET['acao'];
        else:
            $this->acao = null;
        endif;
    }

    public function ObterRota() {


        if (!empty($this->controller)) :

            //identificando qual view invocar informado
            switch ($this->controller):
                case 'home':
                    require_once VIEW_HOME;
                    break;
                case 'produtos':
                    require_once VIEW_PRODUTOS;
                    break;
                case 'categorias':
                    require_once VIEW_CATEGORIAS;
                    break;
                default:
                    $_SESSION['msg'] = "Controller não encontrado";
                    $_SESSION['CodErro'] = E_USER_ERROR;
                    require_once VIEW_ERROS;
            endswitch;

        else:
            // Se nenhum controller for informado o sistema irá chamar a view home
            require_once VIEW_HOME;
        endif;
    }

}

// Fim de AplicacaoMVC




 