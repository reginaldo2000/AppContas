<table class="table table-bordered table-striped table-hover mt-4">
    <thead>
        <tr>
            <th class="text-uppercase" style="width: 40%;">nome</th>
            <th class="text-uppercase">data criação</th>
            <th class="text-uppercase">data modificação</th>
            <th class="text-uppercase text-center" colspan="2">ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($listaCategorias) > 0): ?>
            <?php foreach ($listaCategorias as $categoria): ?>
                <tr class="align-middle">
                    <td><?= $categoria->nome; ?></td>
                    <td><?= date_fmt($categoria->data_criacao, "d/m/Y H:i"); ?></td>
                    <td><?= date_fmt($categoria->data_modificacao, "d/m/Y H:i"); ?></td>
                    <td class="text-center">
                        <a href="#" class="btn btn-secondary btn-sm" onclick="editarCategoria(<?= $categoria->id; ?>);">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="#" class="btn btn-danger btn-sm" onclick="excluirCategoria(<?= $categoria->id; ?>);">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Nenhuma categoria encontrada!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>