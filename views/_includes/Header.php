<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de Estoque</title>
    <link href="<?php echo BOOTSTRAP;?>" rel="stylesheet">
    <link href="<?php echo ESTILO;?>" rel="stylesheet">
</head>

<body>

    <?php // DEPURAÇÃO DE CODIGO
$server = $_SERVER['SERVER_NAME'];

$endereco = $_SERVER ['REQUEST_URI'];

echo "http://" . $server . $endereco;
//?>
    
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Controle de Estoque</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo VIEW_HOME;?>">Controle de Estoque</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo VIEW_CATEGORIAS;?>">Categorias</a></li>
                <li><a href="<?php echo VIEW_PRODUTOS;?>">Produtos</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="container">