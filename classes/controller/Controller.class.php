<?php

/**
 * @projeto: sistemaphp
 * @nome: Controller.class 
 * @Descrição: Classe responsável por definir o controller principal do sistema
 * @copyright (c) 13/11/2017, Iury Gomes - IFTO
 * @autor Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @versao 1.0 - 13/11/2017
 * @metodos 
 */
class Controller {

    // Vetor que contem os elementos da URL que será analisada
    // controller = Receberá o valor do controlador contido na URL: exemplo.com?controller=home
    // acao = Receberá o valor da ação contido na URL: exemplo.com?controller=home&acao=valor
    // parametro = Receberá o valor de algum parêmtro contido na URL: exemplo.com?controller=home&acao=valor&param=valor    
    private $URL = array();
    private $Categorias; // Objeto da classe categorias

    public function __construct(array $GET) {

        $this->Categorias = new Categorias();

        if (!empty($GET['controller'])):

            $this->URL['controller'] = $GET['controller'];
        else:
            $this->URL['controller'] = null;
        endif;


        if (!empty($GET['acao'])):
            $this->URL['acao'] = $GET['acao'];
        else:
            $this->URL['acao'] = null;
        endif;

        if (!empty($GET['param'])):
            $this->URL['parametros'] = $GET['param'];
        else:
            $this->URL['parametros'] = null;
        endif;
    }

    public function ProcessarRequisicao() {

        // Para o caso da primeira execução do sistema
        if (empty($this->URL['controller'])):
            $this->URL['controller'] = 'home';
            $this->URL['acao'] = 'exibir view home';
            $this->URL['parametros'] = 'sem parametros';
            require_once VIEW_HOME;
            return $this->URL;
        endif;

        // HOME ################################################################################
        if ($this->URL['controller'] == 'home'):

            // Executa este if se o usuario clikar no link CONTROLE DE ESTOQUE no menu principal
            if ($this->URL['acao'] == null):

                $this->URL['controller'] = 'home';
                $this->URL['acao'] = 'exibir view home';
                $this->URL['parametros'] = 'sem parametros';
                require_once VIEW_HOME;
                return $this->URL;

            endif;

        endif;
        // FIM HOME ################################################################################
        // 
        // 
        // CATEGORIAS ########################################################################
        if ($this->URL['controller'] == 'categorias'):

            // LISTAR CATEGORIAS -------------------------------------------------------------
            // Quando o usuario clicar no link CATEGORIAS no menu principal, ja lista direto
            if ($this->URL['acao'] == 'listar'):

                // EXECUTANDO MODEL 
                $_SESSION['lista'] = $this->Categorias->Listar('id, nome', 'categoria');
                // FIM DE EXECUÇÃO DO MODEL 

                require_once VIEW_CATEGORIAS;

                $this->URL['parametros'] = null;
                return $this->URL;
            endif;

            // CRIAR CATEGORIAS -------------------------------------------------------------

            if ($this->URL['acao'] == 'criar'):

                // Quando o usuario clica no botão CRIAR NOVA CATEGORIA no menu principal
                if ($this->URL['parametros'] == null):
                    require_once VIEW_CATEGORIAS_CRIAR;
                    return $this->URL;
                endif;

//                // Quando o usuario envia uma nova categoria para ser criada
//                if (empty($this->URL['parametros'])):
//                    // $Dados = ['nome' => 'nome do formulario'];
//                    $this->Categorias->Inserir('categorias', $Dados);
//                endif;

            endif;


        endif;
        // FIM CATEGORIAS ########################################################################
        // 
        //
        // PRODUTOS ########################################################################   
        if (( $this->URL['controller'] == 'produtos')):

            // Quando o usuario clicar no link PRODUTOS no menu principal
            if ($this->URL['acao'] == 'listar'):

                require_once VIEW_PRODUTOS;

                $this->URL['parametros'] = null;
                return $this->URL;
            endif;
        endif;
        // FIM PRODUTOS ######################################################################## 
    }

}

// Fim do Controller




 