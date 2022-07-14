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
        <?php if (count($listaContas) > 0): ?>
            <?php foreach ($listaContas as $conta): ?>
                <tr class="align-middle">
                    <td><?= $conta->descricao; ?></td>
                    <td><?= $conta->nome; ?></td>
                    <td><?= "R$ ".number_format($conta->valor, 2, ",", "."); ?></td>
                    <td><?= date_fmt($conta->data_conta, "d/m/Y H:i"); ?></td>
                    <td class="text-center">
                        <a href="#" class="btn btn-secondary btn-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="#" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhuma conta encontrada!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>