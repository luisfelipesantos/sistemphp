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

    public function __construct(array $GET) {



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

    public function AnalisarURL() {

        // Para o caso da primeira execução do sistema
        if (empty($this->URL['controller'])):
            $this->URL['controller'] = 'home';
            $this->URL['acao'] = VIEW_HOME;
            $this->URL['parametros'] = null;
            return $this->URL;
        endif;

        // Para o caso do usuario clicar no link CONTROLE DE ESTOQUE no menu principal
        if (( $this->URL['controller'] == 'home') && ($this->URL['acao'] == null)):
            $this->URL['controller'] = 'home';
            $this->URL['acao'] = VIEW_HOME;
            $this->URL['parametros'] = null;
            return $this->URL;

        endif;

        // Para o caso do usuario clicar no link CATEGORIAS no menu principal
        if (( $this->URL['controller'] == 'categorias') && ($this->URL['acao'] == 'listar')):
            
            // EXECUTANDO MODEL
            $Categoria = new Categorias();
            $_SESSION['lista'] = $Categoria->Listar('id, nome', 'categoria');
            // FIM DE EXECUÇÃO DO MODEL

            $this->URL['parametros'] = null;
            return $this->URL;

        endif;
        
        // Para o caso do usuario clicar no link PRODUTOS no menu principal
        if (( $this->URL['controller'] == 'produtos') && ($this->URL['acao'] == 'listar')):
            
            // EXECUTANDO MODEL
            //$Categoria = new Categorias();
            //$_SESSION['lista'] = $Categoria->Listar('id, nome', 'categoria');
            // FIM DE EXECUÇÃO DO MODEL

            $this->URL['parametros'] = null;
            return $this->URL;

        endif;
    }

    public function ChamarView() {


        if (( $this->URL['controller'] == 'home')):

            // Executa este if na primeira execução
            // Executa este if se o usuario clikar no link CONTROLE DE ESTOQUE no meu principal
            if (($this->URL['acao'] == VIEW_HOME)):

                require_once VIEW_HOME;

            endif;

        endif;

        
        if (( $this->URL['controller'] == 'categorias')):

            // Executa este if se o usuario clikar no link CATEGORIAS no menu principal
            if (($this->URL['acao'] == 'listar')):

                require_once VIEW_CATEGORIAS;

            endif;

        endif;
        
        
        if (( $this->URL['controller'] == 'produtos')):

            // Executa este if se o usuario clikar no link PRODUTOS no menu principal
            if (($this->URL['acao'] == 'listar')):

                require_once VIEW_PRODUTOS;

            endif;

        endif;

    }

}

// Fim do Controller




 