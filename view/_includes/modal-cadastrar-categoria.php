<div class="modal fade" tabindex="-1" id="modalCadastrarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salvar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url("/categoria/cadastrar"); ?>" 
                  autocomplete="off" class="ajax-form" onsubmit="sendFormAjax(this);"
                  alert-target="alertMessage">
                <input type="text" name="id" id="categoriaId" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Nome da Categoria:</label>
                            <input type="text" name="nome" id="categoriaNome" class="form-control" value="<?= (!empty($categoriaObj) ? $categoriaObj->nome : ""); ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>