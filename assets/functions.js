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

const cadastrarContas = () => {
    $("#modalSalvarConta").modal("show");
    document.querySelectorAll("form").forEach(item => {
       item.reset(); 
    });
};

const editarConta = id => {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${URL_BASE}/conta/buscar/${id}`,
        success: response => {
            setFieldsValues(response.data);
            $("#modalSalvarConta").modal("show");
        }, 
        error: e => {
            console.log(e);
        }
    });
}

const maskMoney = element => {
    let valor = $(element).val();
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${URL_BASE}/conta/formatar-valor/${valor}`,
        success: response => {
            $(element).val(response.valorFormatado);
        }, 
        error: e => {
            console.log(e);
        }
    });
};