/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var alturaDocumento;
$(document).ready(function () {
    alturaDocumento = $(document).innerHeight();
    $('.modal').css('height', alturaDocumento);
    $('.menu').css('height', alturaDocumento);
    $('#data-pag').mask('99/99/9999');
});
var mostrarMenu = 0;
function fadeMenu() {
    var tela = $(window).innerWidth();
    if (mostrarMenu == 0) {
        if (tela >= 786) {
            $('.btn-menu a').css('left', 'calc(250px - 40px)').css('transition', '0.7s');
            $('.menu').css('left', '0').css('transition', '0.7s');
        } else {
            $('.btn-menu a').css('left', 'calc(50% - 40px)').css('transition', '1s');
            $('.menu').css('left', '0').css('transition', '1s');
        }
        mostrarMenu = 1;
    } else {
        if (tela >= 786) {
            $('.btn-menu a').css('left', '0').css('transition', '0.7s');
            $('.menu').css('left', '-250px').css('transition', '0.7s');
        } else {
            $('.btn-menu a').css('left', '0').css('transition', '0.7s');
            $('.menu').css('left', '-50%').css('transition', '0.7s');
        }
        mostrarMenu = 0;
    }
}

function setData(comp, vencimento, fechamento) {
    if (comp.value === "Fatura") {
        dataAtual = new Date();
        var mes = "";
        var ano = dataAtual.getFullYear();
        if ((dataAtual.getMonth() + 1) < 10 && dataAtual.getDate() < fechamento) {
            mes = "0" + (dataAtual.getMonth() + 1);
        } else if ((dataAtual.getMonth() + 1) < 9 && dataAtual.getDate() >= fechamento) {
            mes = "0" + (dataAtual.getMonth() + 2);
        } else if ((dataAtual.getMonth() + 1) > 9 && dataAtual.getDate() >= fechamento) {
            if (dataAtual.getMonth() + 1 == 12) {
                mes = "01";
                ano = ano + 1;
            } else {
                mes = dataAtual.getMonth() + 2;
            }
        } else {
            mes = "" + dataAtual.getMonth() + 1;
        }
        if(vencimento < 10) {
            vencimento = "0"+vencimento;
        }
        this.cadcontas.data_conta.value = ano + '-' + mes + '-' + vencimento;
    } else {
        this.cadcontas.data_conta.value = "";
    }
}

function buscarContas() {
    var dataInicial = this.consulta.data_inicial.value;
    var categoria = this.consulta.categoria.value;
    $('.dados-table').empty();
    if (dataInicial != "" && categoria != "") {
        $.ajax({
            type: 'post',
            dataType: 'html',
            url: './functions/Contas.php?action=2',
            data: {data: dataInicial, cat: categoria, tela: $(window).innerWidth()},
            success: function (retorno) {
                $('.dados-table').append('<tr>' + retorno + '</tr>');
                valorTotal(dataInicial, categoria);
            }
        });
    }
}

function valorTotal(dataInicial, categoria) {
    $('.valor-total').empty();
    $.ajax({
        type: 'post',
        dataType: 'html',
        url: './functions/Contas.php?action=3',
        data: {data: dataInicial, cat: categoria},
        success: function (retorno) {
            $('.valor-total').append('Valor Total: R$ ' + parseFloat(retorno).toFixed(2).replace(".", ","));
            $('.valor-total').removeClass('ocultar');
        }
    });
}

function tableResponsiva() {
    var largura = $(window).innerWidth();
    if(largura < 786) {
        $('#tabela-consulta').addClass('table-responsive').removeClass('table-striped');
    } else {
        $('#tabela-consulta').removeClass('table-responsive').addClass('table-striped');
    }
    
}

function verificarSenha(confirmSenha) {
    var senha = document.getElementById('senha').value;
    if(confirmSenha !== senha) {
        $('#valida-senha').fadeIn(100);
    } else {
        $('#valida-senha').fadeOut(100);
    }
}


