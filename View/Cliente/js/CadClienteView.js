$(function () {
    $("#nroCpfCli").mask('999.999.999-99');
    $("#dtaNascimentoCli").mask('99/99/9999');
    $("#nroCepCli").mask('99999-999');
    $("#nroTelefoneCli").mask('(99) 99999-9999');

    $('#fechaModalCli').click(function () {
        $('#CadCliente').hide('fade');
        limparCampos();
    });

    $('#btnVoltarCli').click(function () {
        $('#CadCliente').hide('fade');
        limparCampos();
    });

    $('#btnSalvarCli').click(function () {
        $('#CadCliente').hide('fade');
        salvarCadastroCli();
    });
        
    $("#nroCepCli").on('blur', function(){
        if ($(this).val()!=''){
            pesquisaCepCli();
        }
    });

});

function pesquisaCepCli(){
    var parametros = 'nroCep;'+$("#nroCepCli").val()+'|verificaPermissao;N|';
    ExecutaDispatch('Usuario','PesquisaCep', parametros, preencheEnderecoCli);  
}

function preencheEnderecoCli(data) {
    var endereco = data[1][0];
    if (endereco.erro) {
        swal({
            title: "Ops!",
            text: "O CEP informado não foi encontrado",
            confirmButtontext: "OK",
            type: "warning"
        });
    }else{
        $("#dscLogradouroCli").val(endereco.logradouro);
        $("#dscComplementoEnderecoCli").val(endereco.complemento);
        $("#dscBairroCli").val(endereco.bairro);
        $("#dscCidadeCli").val(endereco.localidade);
        $("#slgUfCli").val(endereco.uf);
    }

}

function MontaComboUFCli(arrDados) {
    CriarComboDispatch('slgUfCli', arrDados, 0, 'cadCliente', 'slgUf');
}

function limparCampos() {
    $(".cadCliente").val('');
}

function validaCpfCli() {
    var param = "nroCpf;"+$("#nroCpfCli").val()+"|verificaPermissao;N|";
    ExecutaDispatch('Usuario','VerificaCpf', param, RetornoValidaCpfCli);

}

function RetornoValidaCpfCli(resposta) {
    if(resposta[0]) {
        DesabilitaCamposCli(false);
    } else {
        swal({
            title: "Aviso!",
            text: resposta[1],
            confirmButtontext: "OK",
            type: "alert"
        });
        limparCampos();
        DesabilitaCamposCli(true);
    }

}

function salvarCadastroCli() {
    var parametros = retornaParametros("cadCliente");
    parametros += "|verificaPermissao;N|codPerfil;3|";
    // console.log(parametros);
    ExecutaDispatch('Usuario','InsertUsuario', parametros);
}

function DesabilitaCamposCli(ind) {
    $("#fotoCli").attr('Disabled', ind);
    $("#nmeUsuarioCli").attr('Disabled', ind);
    $("#dscSobrenomeCli").attr('Disabled', ind);
    $("#dtaNascimentoCli").attr('Disabled', ind);
    $("#nroTelefoneCli").attr('Disabled', ind);
    $("#txtEmailCli").attr('Disabled', ind);
    $("#nroCepCli").attr('Disabled', ind);
    $("#dscComplementoEnderecoCli").attr('Disabled', ind);
    $("#dscBairroCli").attr('Disabled', ind);
    $("#dscCidadeCli").attr('Disabled', ind);
    $("#dscEstadoCli").attr('Disabled', ind);
    $("#nmeLoginCadCli").attr('Disabled', ind);
    $("#txtSenhaCadCli").attr('Disabled', ind);
    $("#txtSenhaConfCli").attr('Disabled', ind);
}

$(document).ready(function() {
    DesabilitaCamposCli(true);
    ExecutaDispatch('UnidadeFederativa','ListarUnidadeFederativa', 'verificaPermissao;N|', MontaComboUFCli);
});