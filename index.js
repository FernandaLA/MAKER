$(function () {
    $("#nroCpf").mask('999.999.999-99');
    $("#nroCpfR").mask('999.999.999-99');
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

function MontaComboUF(arrDados) {
    CriarComboDispatch('sglUfPre', arrDados, 0, 'cadPrestador', 'sglUf');
    CriarComboDispatch('sglUfCli', arrDados, 0, 'cadCliente', 'sglUf');
}

$(document).ready(function () {
    ExecutaDispatch('UnidadeFederativa','ListarUnidadeFederativa', 'verificaPermissao;N|', MontaComboUF);
    $("#nroCpf").focus();
});