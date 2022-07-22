<div class="content_resultado">
    <h3 class="resultado" style="color: #22c;">Renda: <?= "R$ 2850,00"; ?></h3>
    <h3 class="resultado" style="color: #c22;">Débito: <?= "R$ " . number_format($valorTotal, 2, ",", "."); ?></h3>
    <h3 class="resultado" style="color: #2c2;">Saldo: <?= "R$ " . number_format(2850 - $valorTotal, 2, ",", "."); ?></h3>
</div>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th class="text-uppercase">descrição</th>
            <th class="text-uppercase">categoria</th>
            <th class="text-uppercase">valor</th>
            <th class="text-uppercase">data</th>
            <th class="text-uppercase text-center" colspan="2">ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($listaContas) > 0) : ?>
            <?php foreach ($listaContas as $conta) : ?>
                <tr class="align-middle">
                    <td><?= $conta->descricao; ?></td>
                    <td><?= $conta->nome; ?></td>
                    <td><?= "R$ " . number_format($conta->valor, 2, ",", "."); ?></td>
                    <td><?= date_fmt($conta->data_conta, "d/m/Y"); ?></td>
                    <td class="text-center">
                        <a class="btn btn-secondary btn-sm" onclick="editarConta(<?= $conta->id; ?>);">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">Nenhuma conta encontrada!</td>
            </tr>
        <?php endif; ?>
    </tbody>

</table>