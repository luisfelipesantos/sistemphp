<?php

/**
 * @projeto: sistemaphp
 * @nome: AplicacaoMVC.class 
 * @Descrição: Classe responsável por carregar o controller e executa a ação que irá incluir o model e view
 * @copyright (c) 13/11/2017, Iury Gomes - IFTO
 * @autor Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @versao 1.0 - 13/11/2017
 * @metodos ObterDadosURL(), 
 */
class AplicacaoMVC {

    private $controlador; // Receberá o valor do controlador contido na URL: exemplo.com/controlador/acao
    private $acao; // Receberá o valor da ação contido na URL: exemplo.com/controlador/acao
    private $parametros; // Receberá um array dos parâmetros contindo na URL: exemplo.com/controlador/acao/param1/param2/param50
    private $not_found; // Receberá o caminho da página não encontrada

    /**
     * Construtor para essa classe
     *
     * 1 - O construtor da classe carrega o método ObterDadosURL();
     * 2 - O primeiro parâmetro é o controlador. Se nenhum controlador for indicado na URL, a ação index() do controlador “Home” será executada;
     * 3 - O segundo parâmetro é a ação. Por ação, me refiro a um método que existe dentro do controller para carregar o(s) model(s) e view(s);
     * 4 - Se nenhuma ação for indicada na URL, a classe irá buscar a ação index(); Se essa ação não existir, a página de erro 404 é incluída;
     * 5 - Do terceiro parâmetro em diante, a classe irá considerar os valores como parâmetros, e enviará os dados para o seu controlador.
     * 6 - Tudo isso é executado no construtor da nossa classe.
     */

    public function __construct() {

        //Carregando caminho de pagina não encontrada
        $this->not_found = NOTFOUND;

        // Obtém os valores do controlador, ação e parâmetros da URL.
        // E configura as propriedades da classe.

        $this->ObterDadosURL();

        /**
         * Verifica se um controlador foi definido na URL. Caso contrário, adiciona o
         * controlador padrão HomeController.php e chama o método index().
         */
        if (!$this->controlador):

            // Cria o objeto do controlador "HomeController"
            // Este controlador deverá ter uma classe chamada HomeController
            $this->controlador = new HomeController();

            // Executa o método index()
            $this->controlador->index();

            // FIM :)
            return;
        endif;
//
//        // Se o arquivo do controlador não existir, exibe pagina não encontrada
//        if (!file_exists(ABSPATH . '/controllers/' . $this->controlador . '.php')) {
//            // Página não encontrada
//            require_once ABSPATH . $this->not_found;
//
//            // FIM :)
//            return;
//        }
//
//        // Inclui o arquivo do controlador
//        require_once ABSPATH . '/controllers/' . $this->controlador . '.php';
//
//        // Remove caracteres inválidos do nome do controlador para gerar o nome
//        // da classe. Se o arquivo chamar "news-controller.php", a classe deverá
//        // se chamar NewsController.
//        $this->controlador = preg_replace('/[^a-zA-Z]/i', '', $this->controlador);
//
//        // Se a classe do controlador indicado não existir, não faremos nada
//        if (!class_exists($this->controlador)) {
//            // Página não encontrada
//            require_once ABSPATH . $this->not_found;
//
//            // FIM :)
//            return;
//        } // class_exists
//        // Cria o objeto da classe do controlador e envia os parâmentros
//        $this->controlador = new $this->controlador($this->parametros);
//
//        // Remove caracteres inválidos do nome da ação (método)
//        $this->acao = preg_replace('/[^a-zA-Z]/i', '', $this->acao);
//
//        // Se o método indicado existir, executa o método e envia os parâmetros
//        if (method_exists($this->controlador, $this->acao)) {
//            $this->controlador->{$this->acao}($this->parametros);
//
//            // FIM :)
//            return;
//        } // method_exists
//        // Sem ação, chamamos o método index
//        if (!$this->acao && method_exists($this->controlador, 'index')) {
//            $this->controlador->index($this->parametros);
//
//            // FIM :)
//            return;
//        } // ! $this->acao 
//        // Página não encontrada
//        require_once ABSPATH . $this->not_found;
//
//        // FIM :)
//        return;
    }

// Fim do __construct

    /**
     * Obtém parâmetros de $_GET['path']
     *
     * Obtém os parâmetros de $_GET['path'] e configura as propriedades 
     * $this->controlador, $this->acao e $this->parametros
     *
     * A URL deverá ter o seguinte formato:
     * http://www.example.com/controlador/acao/parametro1/parametro2/etc...
     */
    public function ObterDadosURL() {

        // Verifica se o parâmetro path foi enviado
//        echo '<hr>ObterDadosURL';
//        echo "<br>Capturando o valor de".'$_GET[\'path\']: '."{$_GET['path']}";
        
        if (isset($_GET['path'])) {

            // Captura o valor de $_GET['path']
//            $caminho = $_GET['path'];
            
            // Retirando o / do final da string
////            $caminho = rtrim($caminho, '/');
//            
//            echo '<br>Retirando o / do final da string: '."{$caminho}";         
            
            $caminho = filter_var($caminho, FILTER_SANITIZE_URL);
            
//            echo '<br>Removendo caracteres estranhos da URL: '."{$caminho}";

            // Cria um array de parâmetros
            $caminho = explode('/', $caminho);

//            echo '<br>Array de parametros criado:';
//            var_dump($caminho);
            
            // Configurando os atributos $controlador, $acao e $parametros
            $this->controlador = VerificarVetor($caminho, 0);
            $this->controlador .= '-controller'; // Esse formato de nome de controlador pode ser mudado
            
//            echo '<br>Obtendo o controlador: '."{$this->controlador}";
            
            $this->acao = VerificarVetor($caminho, 1);
            
//            echo '<br>Obtendo a ação: '."{$this->acao}";
            
            // Se houver parâmetros, então vamos configurar $parametros
            if ( VerificarVetor($caminho, 2) ) {
                unset($caminho[0]); // Destruindo posição 0 do vetor
                unset($caminho[1]); // Desttuindo posição 1 do vetor

                // Os parâmetros sempre virão após a ação
                $this->parametros = array_values($caminho);
               
//                 echo '<br>Obtendo os parâmetros:';
//                 var_dump($this->parametros);
            }

        }
    }
    // Fim de ObterDadosURL
}
// Fim de AplicacaoMVC




 