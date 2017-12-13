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

        if (empty($GET)):

            $this->URL['controller'] = null;
            $this->URL['acao'] = null;
            $this->URL['id'] = null;

        else:
            $this->URL = $GET;
        endif;
    }

    public function ProcessarRequisicao(array $POST) {

        // HOME ################################################################################
        // Para o caso da primeira execução do sistema
        // ou
        // Se o usuario clicar no link CONTROLE DE ESTOQUE no menu principal
        if (($this->URL['controller'] == 'home') || ( empty($this->URL['controller']) )):

            $this->ExibirHome();
            return $this->URL;

        endif;
        // FIM HOME ################################################################################
        // 
        // 
        // CATEGORIAS ########################################################################
        if ($this->URL['controller'] == 'categorias'):

            // EXIBIR VIEW CATEGORIAS -------------------------------------------------------------
            // Quando o usuario clicar no link CATEGORIAS no menu principal, ja lista direto
            if ($this->URL['acao'] == 'listar'):

                $this->ObterCategorias("id, nome", "categorias");
                $this->ExibirCategorias();
                return $this->URL;

            endif;

            // EXIBIR VIEW NOVAS CATEGORIAS -------------------------------------------------------------
            // Quando o usuario clica no botão CRIAR NOVA CATEGORIA no menu categorias
            if ($this->URL['acao'] == 'inserir'):

                require_once VIEW_CATEGORIAS_INSERIR;
                return $this->URL;

            endif;

            // INSERIR CATEGORIAS -------------------------------------------------------------
            if ($this->URL['acao'] == 'inserido'):

                if (!empty($this->URL['id'])):

                    // $update->ExecutarUpdate('siteviews_agent', $Dados, "WHERE agent_id = :id", 'id=15');
                    // Quando o usuario clica no botão SALVAR de EDITAR CATEGORIA
                    $Dados = ['nome' => $POST['nome']];
                    $this->AtualizarCategorias('categorias', $Dados, "WHERE id = :id", "id={$this->URL['id']}");
                  
                else:

                    // Quando o usuario clica no botão SALVAR de NOVA CATEGORIA    
                    $this->InserirCategorias($POST);

                endif;
                
                $this->ObterCategorias("id, nome", "categorias");
                $this->ExibirCategorias();
                return $this->URL;

            endif;

            // EXIBIR VIEW EDITAR CATEGORIAS -------------------------------------------------------------
            // Quando o usuario clica no botão EDITAR na VIEW_CATEGORIAS
            if ($this->URL['acao'] == 'editar'):

                $this->ObterCategorias("id, nome", 'categorias', 'WHERE id = :id', "id={$this->URL['id']}");
                require_once VIEW_CATEGORIAS_EDITAR;
                return $this->URL;

            endif;



        endif;
        // FIM CATEGORIAS ########################################################################
        // 
        //
        // PRODUTOS ########################################################################   
        if (( $this->URL['controller'] == 'produtos')):

            // Quando o usuario clicar no link PRODUTOS no menu principal
            if ($this->URL['acao'] == 'listar'):

                $this->ExibirProdutos();
                return $this->URL;

            endif;
        endif;
        // FIM PRODUTOS ######################################################################## 
    }

    // FIM PROCESSAR REQUISIÇÃO ################################################################

    private function AtualizarCategorias(string $Tabela, array $Dados, string $Parametros, $Valores) {

        $this->Categorias->Atualizar($Tabela, $Dados, $Parametros, $Valores);
    }

    private function InserirCategorias(array $POST, $Tabela) {

        $Dados = ['nome' => $POST['nome']];

        // EXECUTANDO MODEL 
        $this->Categorias->Inserir($Tabela, $Dados);
        // FIM DE EXECUÇÃO DO MODEL 
    }

    private function ObterCategorias(string $Colunas, string $Tabela, string $Termos = null, string $Valores = null) {

        // EXECUTANDO MODEL 
        $_SESSION['resultado'] = $this->Categorias->Buscar($Colunas, $Tabela, $Termos, $Valores);
        // FIM DE EXECUÇÃO DO MODEL 
    }

    private function ExibirHome() {

        $this->URL['controller'] = 'home';
        $this->URL['acao'] = 'exibir view home';
        require_once VIEW_HOME;
    }

    private function ExibirCategorias() {

        require_once VIEW_CATEGORIAS;
    }

    private function ExibirProdutos() {

        require_once VIEW_PRODUTOS;
    }

}

// Fim do Controller




 