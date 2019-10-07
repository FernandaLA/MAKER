$(function () {
    $("#nroCpf").mask('999.999.999-99');  
    
    $("#btnReiniciarSenha").click(function () {
        ExecutaDispatch('Usuario', 'ReiniciarSenha', 'codUsuario;' + $("#codUsuario").val() + '|', undefined, "Aguarde", "Senha reiniciada");
    });
    
    $("#nroCpf").blur(function () {
        if ((!valCpf($("#nroCpf").val())) && ($("#nroCpf").val() != '')) {
            swal({
                title: "Aviso",
                text: "CPF Inválido!",
                confirmButtontext: "Fechar",
                type: "alert"
            });
            $("#nroCpf").focus();
        }
    });
    
    $("#btnSalvar").click(function () {
        if ($('#codUsuario').val() == 0) {
            $('#method').val('AddUsuario');
        } else {
            $('#method').val('UpdateUsuario');
        }
        var parametros = retornaParametros();
        ExecutaDispatch('Usuario',$('#method').val(), parametros, retornoSalvarUsuario, "Aguarde, Salvando Usuário!");
    });
    
    $("#codCliente").change(function () {
        CarregaLojas($(this).val(), -1);
    });
});

function retornoSalvarUsuario(retorno) {
    if (retorno[0]) {
        if (retorno[1] != $("#codUsuario").val()) {
            swal({
                title: "Usuario salvo com sucesso!",
                text: "A Senha para acesso é 123459.",
                confirmButtonText: "OK",
                type: "success",
            });
        } else {
            swal({
                title: "Usuario salvo com sucesso!",
                showConfirmButton: false,
                type: "success",
                timer: 2000
            });
        }
        $("#codUsuario").val(retorno[1]);
        CarregaGridUsuario();
    }
}

function CarregaComboPerfil(arrDados) {
    CriarComboDispatch('codPerfil', arrDados, 0, 'persist');
}