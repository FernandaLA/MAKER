$(function () {
    // $("#nroCpfSenha").mask('999.999.999-99');

    $("#nroCpfSenha").blur(function () {
        if ((!valCpf($("#nroCpfSenha").val())) && ($("#nroCpfSenha").val() != '')) {
            swal({
                title: "Aviso",
                text: "CPF Inválido!",
                confirmButtontext: "Fechar",
                type: "warning"
            });
            $("#nroCpfSenha").focus();
        }
    });

    $("#btnEnviar").click(function () {
        var parametros = retornaParametros("recuperaSenha");
        ExecutaDispatch('Usuario', 'RecuperarSenha', parametros, retornaEnvio, "Aguarde, verificando CPF");
    });

    $("#fechaModalSenha").click(function () {
        $('#RecuperaSenha').hide('fade');
    });
});

function retornaEnvio(){
    swal({
        title: "Sucesso!",
        text: "<b>Uma nova senha foi enviada para o seu e-mail!</b>",
        confirmButtontext: "OK",
        type: "success"
    });
}