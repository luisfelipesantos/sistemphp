<?php

/**
 * @project: 5_Aulas_de_PHP
 * @name: Delete.class 
 * @Description:Exemplo de CRUD, classe responsável pela ação de Delete,
 * ou seja, deletar cadastros no Banco de Dados.
 * @copyright (c) 25/10/2017, Iury Gomes - IFTO
 * @author Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @version 1.0 
 */
class Delete extends ConexaoBD {

    private $Tabela;        // Tabela a ser usada no delete no banco
    private $Parametros;    // Parâmetros para realizar o delete no banco
    private $Valores;       // Valores quer serão substituídos na string da sql
    private $Resultado;     // Armazena o resultado das operações no banco 

    /** @var PDOStatement */
    private $sql_preparado;

    /** @var PDO */
    private $Conexao;

    /**
     * ExecutarRead: Executa uma leitura simplificada com Prepared Statments. Basta informar o nome da tabela,
     * os termos da seleção e os valores a serem lidos para executar.
     * @param STRING $Tabela = Nome da tabela
     * @param STRING $Parametros = WHERE coluna = :link AND.. OR..
     * @param STRING $Valores = Valores que serão substituidos na string da sql
     */
    public function ExecutarDelete($Tabela, $Parametros, $Valores) {

        $this->Tabela = (string) $Tabela;
        $this->Parametros = (string) $Parametros;

        if ($this->AlterarValores($Valores)):
            $this->getSintaxe();
            $this->Executar();
        else:
            echo "Não foi possível substituir os valores";
        endif;
    }

    public function getResultado() {
        return $this->Resultado;
    }

    /**
     * getLinhasAlteradas: Retorna o número de registros alterados pela sql executado!
     * @return INT $this->sql_preparado->rowCount() = Quantidade de registros alterados
     */
    public function getLinhasAlteradas() {
        return $this->sql_preparado->rowCount();
    }

    /**
     * AlterarValores: Altera apenas os valores que precisam ser substituidos
     * sem necessidade de alterar o sql montado anteriormente em getSintaxe
     */
    public function AlterarValores($Valores) {

        if (!empty($Valores)):
            // Coloca uma string em um array
            parse_str($Valores, $this->Valores);
            return true;
        else:
            return false;
        endif;
    }

    public function VerObjeto() {

        var_dump($this);
        echo '<hr>';
    }

    // MÉTODOS PRIVADOS ############################
    //Obtém o PDO e Prepara a query
    private function Connect() {

        // Obtendo conexão com o banco de dados
        $this->Conexao = parent::ObterConexao();

        // Preparando o SQL para ser executado pelo Banco
        $this->sql_preparado = $this->Conexao->prepare($this->sql_preparado);
    }

    //Cria a sintaxe da sql para usar o Prepared Statements
    private function getSintaxe() {

        $this->sql_preparado = "DELETE FROM {$this->Tabela} {$this->Parametros}";
    }

    //Obtém a Conexão e a Syntax, executa a query!
    private function Executar() {

        $this->Connect();

        try {

            $this->sql_preparado->execute($this->Valores);
            $this->Resultado = true;
        } catch (PDOException $e) {
            $this->Resultado = null;
            trigger_error("Erro ao cadastrar",$e->getCode());
        }
    }

}
