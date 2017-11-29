<?php

/**
 * @projeto: sistemaphp
 * @nome: HomeController.class 
 * @Descrição: Este é o controlador padrão que é carregado quando nenhum controller especifico é informado pela URL. 
 * Por padrão, ele não tem nenhum model, apenas views.
 * @copyright (c) 13/11/2017, Iury Gomes - IFTO
 * @autor Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @versao 1.0 - 28/11/2017
 * @metodos Index()
 */
class HomeController extends PrincipalController {

    /**
     * Carrega a página "/views/home/home.php"
     */
    public function index() {
        
        // Título da página
        //$this->title = 'Home';
        // Parametros da função
        //$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
        // Essa página não precisa de modelo (model)

        /** Carrega os arquivos do view * */
        require_once HOME;

        // FIM INDEX
    }

// FIM HomeController
}
