<?php $v->layout("_theme"); ?>
<?php $v->insert("_includes/modal-salvar-conta"); ?>

<div id="alertMessage"></div>

<a href="#" class="btn btn-success mb-2" onclick="cadastrarContas();">
    Nova Conta
</a>

<div class="card card-footer">
    <form method="GET" action="" class="needs-validation" novalidate autocomplete="off">
        <div class="row">
            <div class="col-lg-4 mb-2">
                <label>Descrição da Conta:</label>
                <input type="text" name="descricao" class="form-control" value="<?= $descricao; ?>">
            </div>

            <div class="col-lg-3 mb-2">
                <label>Data Inicial:</label>
                <input type="date" name="data_inicial" id="dataInicial" class="form-control" value="<?= $dataInicial; ?>" onchange="obrigaCampoDataFinal(this.value);">
            </div>

            <div class="col-lg-3 mb-2">
                <label>Data Final:</label>
                <input type="date" name="data_final" id="dataFinal" class="form-control" value="<?= $dataFinal; ?>" onchange="obrigaCampoDataInicial(this.value);">
            </div>

            <div class="col-lg-2 mb-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Procurar
                </button>
            </div>

        </div>
    </form>
</div>

<div class="table-responsive mt-4">
    <?php $v->insert("_includes/table-contas"); ?>
</div>

<?php $v->start("script"); ?>
<script>
    const obrigaCampoDataFinal = value => {
        if (value != "") {
            $("#dataFinal").attr("required", true);
        } else {
            $("#dataFinal").removeAttr("required");
        }
    };

    const obrigaCampoDataInicial = value => {
        if (value != "") {
            $("#dataInicial").attr("required", true);
        } else {
            $("#dataInicial").removeAttr("required");
        }
    };
</script>
<?php $v->end(); ?>