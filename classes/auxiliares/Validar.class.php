<?php

/**
 * @projeto: sistemaphp
 * @nome: Validar.class 
 * @Descrição: Classe responsável por validar e manipular dados no sistema
 * @copyright (c) 13/11/2017, Iury Gomes - IFTO
 * @autor Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @versao 1.0 - 13/11/2017
 * @metodos Email(), Url(), UrlAmigavel(), TimeStamp(), QuantidadeVisitas()
 * @metodos getDadosValidos(), getDadosInvalidos(), VerAtributos()
 */
class Validar {

    private static $DadosInvalidos; // usado para armazenar dados invalidos
    private static $DadosValidos; // usado para armazenar dados validos

    // MÉTODOS ESTATICOS ###################################
    /**
     * Executa validação de formato de e-mail no padrão indicado pela RFC 822
     * a RFC 822 define o formato padrão para mensagens de email e endereço de email
     * @param string $Email Uma conta de e-mail para ser validado
     * @return boleano Retorna true para um email valido, ou false para um email invalido
     */

    public static function Email(string $Email) {

        self::$DadosInvalidos = $Email;

        if (filter_var(self::$DadosInvalidos, FILTER_VALIDATE_EMAIL)):
            self::$DadosValidos = self::$DadosInvalidos;
            return true;
        else:
            return false;
        endif;
    }

    /**
     * Executa validação de formato da URL no padrão indicado pela RFC 2396
     * a RFC 2396 define o formato padrão endereços de internet
     * @param string $endereco Um endereço de URL para ser validado
     * @return boleano Retorna true para uma URL valida, ou false para uma URL invalida
     */
    public static function Url(string $endereco) {

        self::$DadosInvalidos = $endereco;

        if (filter_var(self::$DadosInvalidos, FILTER_VALIDATE_URL)):
            self::$DadosValidos = self::$DadosInvalidos;
            return true;
        else:
            return false;
        endif;
    }

    /**
     *  Transforma URL para um um formato amigável
     * @param string $endereco Uma string que conté uma URL não amigavel
     * @return string $DadosValidos Uma URL no formato amigável
     */
    public static function UrlAmigavel(string $endereco) {

        self::$DadosInvalidos = $endereco;

        // Transdormando DadosValidos para um vetor
        self::$DadosValidos = array();

        // Posição do Vetor que armazenará caracteres estranhos
        self::$DadosValidos['estranhos'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';

        // Posição do Vetor que armazenará caracteres amigaveis
        self::$DadosValidos['amigaveis'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        // Posição do vetor que armazenará o vetor convertido
        self::$DadosValidos['url'] = "";

        self::$DadosValidos['url'] = strtr(utf8_decode(self::$DadosInvalidos), utf8_decode(self::$DadosValidos['estranhos']), self::$DadosValidos['amigaveis']);

        self::$DadosValidos['url'] = strip_tags(trim(self::$DadosValidos['url']));

        self::$DadosValidos['url'] = str_replace(' ', '-', self::$DadosValidos['url']);

        self::$DadosValidos['url'] = str_replace(array('----', '---', '--'), '-', self::$DadosValidos['url']);

        self::$DadosValidos['url'] = strtolower(self::$DadosValidos['url']);

        return self::$DadosValidos['url'];
    }

    /**
     * Transformar uma data no formato brasileiro e uma data no formato timestamp bastante utilizado no MySQL
     * @param string $Data Dados em dia/mes/ano ou dia/mes/ano hora:minuto:segundo
     * @return string $DadosValidos Dados no formato timestamp
     */
    public static function Timestamp(string $Data) {

        // dividindo a string de $data em duas strings
        // separando data e hora em strings diferentes
        self::$DadosInvalidos = explode(' ', $Data);

        // Separando as datas
        $DataSeparada = explode('/', self::$DadosInvalidos[0]);

        // Caso seja informado uma data sem horas
        // a função date obtem a hora atual do servidor
        if (empty(self::$DadosInvalidos[1])):
            self::$DadosInvalidos[1] = date('H:i:s'); // obtendo a hora atual do servidor
        endif;

        self::$DadosValidos = $DataSeparada[2] . '-' . $DataSeparada[1] . '-' . $DataSeparada[0] . ' ' . self::$DadosInvalidos[1];
        return self::$DadosValidos;
    }

    /**
     * Método que informa quantos usuários visitaram o sistema
     * a quantidade é verificada com base nos dados presentes no banco
     * @param string $Tabela Nome da tabela a ser pesquisada no banco
     * @param string $Termos Os parâmetros a serem utilizados na pesquisa no banco
     * @return int Quantidade de usuários que visitou o site
     */
    public static function QuantidadeVisitas(string $Tabela, string $Termos = null) {

        $Visitas = new Read();

        // Se $Termos é igual a null ele fará a leitura de toda a tabela
        // Se $Termos é diferente de null ele fará a leitura até a data e hora informada
        if ($Termos == null):
            $Visitas->ExecutarRead($Tabela);
        else:
            $Visitas->ExecutarRead($Tabela, $Termos);
        endif;
        
        return $Visitas->getResultado();
        
    }

    // MÉTODOS PUBLICOS ###################################

    /**
     * Este método obtem o valor do atributo DadosValidos
     * @return string Retorna o valor do atributo self::$DadosValidos
     */
    public function getDadosValidos(){
        return self::$DadosValidos;
    }
    
    /**
     * Este método obtem o valor do atributo DadosInvalidos
     * @return string Retorna o valor do atributo self::$DadosInvalidos
     */
    public function getDadosInvalidos(){
        return self::$DadosInvalidos;
    }
    
    /**
     * Mostra os valores atuais dos atributos staticos
     * self::$DadosValidos e self::$DadosInvalidos
     */
    public function VerAtributos() {

        echo '<hr>';
        echo 'Atributos <br>';
        echo '$dados Validos';
        var_dump(self::$DadosValidos);
        echo '$dados Invalidos';
        var_dump(self::$DadosInvalidos);
        echo '<hr>';
    }

}
