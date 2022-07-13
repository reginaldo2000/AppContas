<?php $v->layout("_theme"); ?>

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

<table class="table table-bordered table-striped table-hover mt-4">
    <thead>
        <tr>
            <th class="text-uppercase">nome</th>
            <th class="text-uppercase">data criação</th>
            <th class="text-uppercase">data modificação</th>
            <th class="text-uppercase text-center">ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($listaCategorias) > 0): ?>
            <?php foreach ($listaCategorias as $categoria): ?>
                <tr>
                    <td><?= $categoria->nome; ?></td>
                    <td><?= date_fmt($categoria->data_criacao, "d/m/Y H:i"); ?></td>
                    <td><?= date_fmt($categoria->data_modificacao, "d/m/Y H:i"); ?></td>
                    <td class="text-center">

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
