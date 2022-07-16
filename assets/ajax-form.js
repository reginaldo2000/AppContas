
const setFieldsValues = (responseData) => {
    Object.keys(responseData).forEach(item => {
        $(`#${item}`).val(responseData[item]);
    });
};

const setHtml = (elementId, content) => {
    document.getElementById(elementId).innerHTML = content;
};

const alertMessage = (message, target, type) => {
    let element = document.getElementById(target);
    let alert = `
    <div class="alert ${type} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;
    element.innerHTML = alert;
};

const sendFormAjax = form => {
    let dadosForm = new FormData(form);
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: $(form).attr("action"),
        data: dadosForm,
        processData: false,
        cache: false,
        contentType: false,
        beforeSend: () => {
//            modalOpen("");
        },
        success: response => {
            console.log(response);
            if (response.message != "") {
                alertMessage(response.message, $(form).attr("alert-target"), "alert-success");
            }
            if (response.data.content != "") {
                setHtml(response.data.elementId, response.data.content);
            }
            if (response.data.reset) {
                form.reset();
                $(".modal").modal("hide");
                $(form).removeClass("was-validated");
            }
        },
        error: erro => {
            alert("erro");
            console.log(erro);
        }
    });
};


$(document).ready(() => {
    let forms = document.querySelectorAll(".ajax-form");
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            event.stopPropagation();
            event.preventDefault();
        });
    });
});

(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()