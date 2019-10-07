$(function () {
    $("#nmeLogin").mask('999.999.999-99');
    $("#nroCpf").mask('999.999.999-99');
    $("#nroCep").mask('99999-999');
    $("#nroTelefone").mask('(99) 99999-9999');

    var valor = '{x:' + $(window).width / 2 + ', y:' + $(window).heigth / 2 + '}';
    $(".login").keyup(function (event) {
        if (event.keyCode == 13) {
            $("#btnLogin").click();
        }
    });
    $("#btnCadastrarParceira").click(function () {
        $("#CadPrestador").show('fade');
    });
    $("#btnCadastrarCliente").click(function () {
        $("#CadCliente").show('fade');
    });
    $("#btnEsqueciSenha").click(function () {
        $("#RecuperaSenha").show('fade');
    });
    $("#btnLogin").click(function () {
        logar();
    });

});

function logar() {
    var parametros = retornaParametros();
    ExecutaDispatch('Login','Logar', parametros, posLogin, "Aguarde, efetuando login!");
}

function posLogin(logar){
    $(location).attr('href', '../../Dispatch.php?controller=' + logar[1][0]['DSC_PAGINA'] + '&method=' + logar[1][0]['NME_METHOD']+'&verificaPermissao=N');
}

$(document).ready(function () {
    $("#nmeLogin").focus();
});