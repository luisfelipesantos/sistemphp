<?php

class Categorias extends Read {

//    public $id;
//    public $nome;

    public function Listar(string $Colunas, string $Tabela, string $Termos = null, string $Valores = null)
    {
        $this->ExecutarRead('id, nome', 'categorias');
        $lista = $this->getResultado();
        return $lista;
    }
}