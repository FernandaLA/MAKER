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
        salvarCadastroCli();
    });
        
    $("#nroCepCli").on('blur', function(){
        if ($(this).val()!=''){
            pesquisaCepCli();
        }
    });

    $("#nmeUsuarioCli").on("input", function(){
        var regexp = /[^a-zA-Zà-úÀ-Ú' ]/g;
        if(this.value.match(regexp)){
          $(this).val(this.value.replace(regexp,''));
        }
    });

    $("#dscSobrenomeCli").on("input", function(){
        var regexp = /[^a-zA-Zà-úÀ-Ú' ]/g;
        if(this.value.match(regexp)){
          $(this).val(this.value.replace(regexp,''));
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
        $("#sglUfCli").val(endereco.uf);
    }

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
    var formFotoCli = new FormData($('#formFotoCli')[0]);
    var parametros = retornaParametros("cadCliente");
    parametros += "|verificaPermissao;N|"+formFotoCli+"|";
    ExecutaDispatchUpload('Usuario','InsertUsuario', parametros, retornoSalvarCliente, "Aguarde, Salvando", "Cadastro realizado com sucesso! Bem Vindo à MAKER");
}

function retornoSalvarCliente(dado) {
    if(dado[0]){
        $('#CadCliente').hide('fade');
        LimparCampos('CadCliente');
    }
}

function DesabilitaCamposCli(ind) {
    $(".cadCliente").attr('Disabled', ind);
    $("#nroCpfCli").attr('Disabled', false);
    $("#dscLogradouroCli").attr('Disabled', true);
}

$(document).ready(function() {
    DesabilitaCamposCli(true);
});