<div class="modal fade" tabindex="-1" id="modalExcluirCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url("/categoria/excluir"); ?>" 
                  autocomplete="off" class="ajax-form" onsubmit="sendFormAjax(this);"
                  alert-target="alertMessage">

                <div class="modal-body">
                    <input type="text" name="_method" value="DELETE" hidden>
                    <input type="text" name="id" id="excluirCategoriaId" hidden>
                    <p>Deseja realmente excluir a categoria?</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Excluir
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>