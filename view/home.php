<?php $v->layout("_theme"); ?>

<?php openAlertMessage(); ?>

<div class="row">
    <div class="col-lg-6 mb-3">
        <div id="graficoMeses"></div>
    </div>
    <div class="col-lg-6 mb-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">Últimas Contas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaContas as $conta) : ?>
                    <tr>
                        <td><?= $conta->descricao; ?></td>
                        <td><?= "R$ " . number_format($conta->valor, 2, ",", "."); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-3">
        <div id="graficoMediaGastos"></div>
    </div>

    <div class="col-lg-4 mb-3">
        <div id="graficoCategorias"></div>
    </div>

    <div class="col-lg-4 mb-3">
        <div id="graficoSaldoGasto"></div>
    </div>
</div>