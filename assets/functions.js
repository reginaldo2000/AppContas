const URL_BASE = 'http://localhost/AppContas';

const cadastrarCategoria = () => {
    let form = document.querySelector("#modalCadastrarCategoria form");
    form.reset();
    $("#modalCadastrarCategoria").modal("show");
};

const modalOpen = modalId => {
    $(`#${modalId}`).modal("show")
};

const editarCategoria = id => {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${URL_BASE}/categoria/buscar/${id}`,
        beforeSend: () => {

        },
        success: response => {
            setFieldsValues(response.data);
            modalOpen("modalCadastrarCategoria");
        },
        error: (erro) => {
            console.log(erro);
        }
    });
};

const excluirCategoria = id => {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${URL_BASE}/categoria/buscar/${id}`,
        beforeSend: () => {

        },
        success: response => {
            $("#excluirCategoriaId").val(response.data.categoriaId);
            modalOpen("modalExcluirCategoria");
        },
        error: (erro) => {
            console.log(erro);
        }
    });
};
