<div class="modal fade" tabindex="-1" id="modalSalvarConta">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salvar Conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= url("/categoria/cadastrar"); ?>" 
                  autocomplete="off" class="ajax-form needs-validation" onsubmit="sendFormAjax(this);"
                  alert-target="alertMessage" novalidate>
                <input type="text" name="id" id="categoriaId" hidden>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-lg-12 mb-3">
                            <label>Descrição:</label>
                            <input type="text" name="descricao" id="contaDescricao" class="form-control" required>
                        </div>
                        
                        <div class="col-lg-12 mb-3">
                            <label>Categoria:</label>
                            <select name="categoria" id="contaCategoria" class="form-control" required>
                                <option value="">Selecione uma categoria</option>
                                <?php foreach ($listaCategorias as $categoria): ?>
                                    <option value="<?= $categoria->id; ?>"><?= $categoria->nome; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-lg-6">
                            <label>Valor:</label>
                            <input type="text" name="valor" id="contaValor" class="form-control" onkeyup="maskMoney(this);" required>
                        </div>
                        
                        <div class="col-lg-6">
                            <label>Data da Conta:</label>
                            <input type="date" name="data_conta" id="contaDataConta" class="form-control" required>
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
