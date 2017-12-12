<?php

class Categorias {

    /** @var Read Objeto da Classe READ do CRUD*/
    private $read;
    
    /** @var Create Objeto da Classe CREATE do CRUD*/
    private $create;
    
    /** @var Update Objeto da Classe Update do CRUD*/
    private $update;
    
    /** @var Delete Objeto da Classe Delete do CRUD*/
    private $delete;
    
    function __construct() {
        
        $this->read = new Read();
        $this->create = new Create();
        $this->update = new Update();
        $this->delete = new Delete();
    }

    public function Listar(string $Colunas, string $Tabela, string $Termos = null, string $Valores = null)
    {
        $this->read->ExecutarRead('id, nome', 'categorias');
        $lista = $this->read->getResultado();
        return $lista;
    }
    
    public function Inserir(string $Tabela, array $Dados)
    {
       
        $this->create->ExecutarCreate($Tabela, $Dados);
        $lista = $this->read->getResultado();
        return $lista;
    }
}