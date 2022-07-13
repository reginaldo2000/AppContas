<?php $v->layout("_theme"); ?>
<?php $v->insert("_includes/modal-cadastrar-categoria"); ?>
<?php $v->insert("_includes/modal-excluir-categoria"); ?>

<?php openAlertMessage(); ?>

<div id="alertMessage"></div>

<a href="#" class="btn btn-success mb-3" onclick="cadastrarCategoria();">
    Cadastrar Novo
</a>

<div class="card card-footer">
    <form method="GET" action="" class="needs-validation" novalidate autocomplete="off">
        <div class="row">
            <div class="col-lg-6 mb-2">
                <label>Nome da Categoria:</label>
                <input type="text" name="nome_categoria" class="form-control" value="<?= (!empty($nomeCategoria) ? $nomeCategoria : ""); ?>">
            </div>
            <div class="col-lg-3 mb-2 d-flex align-items-end">
                <button class="btn btn-primary">
                    <i class="bi bi-search"></i> Procurar
                </button>
            </div>
        </div>
    </form>
</div>

<div id="tableCategorias" class="table-responsive">
    <?php $v->insert("_includes/table-categorias"); ?>
</div>
