<?php
require_once HEADER;

// Acessando o Array com os resultados da consulta
$id=array_column($_SESSION['resultado'], 'id');
$value=array_column($_SESSION['resultado'], 'nome');
$value=$value[0];
$id=$id[0];

?>
<div class="row">
    <div class="col-md-12">
        <h2>Editar Categoria</h2>
    </div>
</div>
<form action="<?php echo LINK_CATEGORIAS_INSERIDO."&id=".$id; ?>" method="post">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input name="nome" type="text" value="<?php echo $value ?>" class="form-control" placeholder="Nome da Categoria">
            </div>
            <input type="submit" class="btn btn-success btn-block" value="Salvar">
        </div>
    </div>
</form>
<?php require_once FOOTER; ?>
