$(function () {
    $("#nroCpfPre").mask('999.999.999-99');
    $("#dtaNascimentoPre").mask('99/99/9999');
    $("#nroCepPre").mask('99999-999');
    $("#nroTelefonePre").mask('(99) 99999-9999');

    $('#fechaModalPre').click(function () {
        limparCampos();
        $('#CadPrestador').hide('fade');
    });

    $('#btnVoltarPre').click(function () {
        limparCampos();
        $('#CadPrestador').hide('fade');
    });

    $('#btnSalvarPre').click(function () {
        salvarCadastroPre();
        $('#CadPrestador').hide('fade');
    });
        
    $("#nroCepPre").on('blur', function(){
        if ($(this).val()!=''){
            pesquisaCepPre();
        }
    });

});

function pesquisaCepPre(){
    var parametros = 'nroCep;'+$("#nroCepPre").val()+'|verificaPermissao;N|';
    ExecutaDispatch('Usuario','PesquisaCep', parametros, preencheEnderecoPre);  
}

function preencheEnderecoPre(data) {
    console.log(data);
    var endereco = data[1][0];
    if (endereco.erro) {
        swal({
            title: "Ops!",
            text: "O CEP informado não foi encontrado",
            confirmButtontext: "OK",
            type: "warning"
        });
    }else{
        $("#dscLogradouroPre").val(endereco.logradouro);
        $("#dscComplementoEnderecoPre").val(endereco.complemento);
        $("#dscBairroPre").val(endereco.bairro);
        $("#dscCidadePre").val(endereco.localidade);
        $("#slgUfPre").val(endereco.uf);
    }

}

function MontaComboUFPre(arrDados) {
    CriarComboDispatch('slgUfPre', arrDados, 0, 'cadPrestador', 'slgUf');
}

function limparCampos() {
    $(".cadPrestador").val('');
}

function validaCpfPre() {
    var param = "nroCpf;"+$("#nroCpfPre").val()+"|verificaPermissao;N|";
    ExecutaDispatch('Usuario','VerificaCpf', param, RetornoValidaCpfPre);

}

function RetornoValidaCpfPre(resposta) {
    if(resposta[0]) {
        DesabilitaCamposPre(false);
    } else {
        swal({
            title: "Aviso!",
            text: resposta[1],
            confirmButtontext: "OK",
            type: "alert"
        });
        limparCampos();
        DesabilitaCamposPre(true);
    }

}

function montaBoxCategoria(categorias) {
    var count = 5;
    var html = "";

    for (var i=0; i<categorias[1].length; i++ ) {
        if(count == 5){
            html += "<tr>";
            count = 0;
        }
        html += "<td width='300px'>";
        html += "<strong class='checkbox'>";
        html += "<input type='checkbox' name='codCategoria' id='codCategoria' value='"+categorias[1][i]['COD']+"'class='cadPrestador'>"+categorias[1][i]['DSC']+"";
        html += "</strong>";
        html += "</td>"
        count++;
        if(count == 5){
            html += "</tr>";
        }
    }
    $("#servicosBox").html(html);
}

function salvarCadastroPre() {
    var parametros = retornaParametros("cadPrestador");
    parametros += "|verificaPermissao;N|codPerfil;2|";
    // console.log(parametros);
    ExecutaDispatch('Prestador','InsertPrestador', parametros);
}

function DesabilitaCamposPre(ind) {
    $("#fotoPre").attr('Disabled', ind);
    $("#nmeUsuarioPre").attr('Disabled', ind);
    $("#dscSobrenomePre").attr('Disabled', ind);
    $("#dtaNascimentoPre").attr('Disabled', ind);
    $("#nroTelefonePre").attr('Disabled', ind);
    $("#txtEmailPre").attr('Disabled', ind);
    $("#nroCepPre").attr('Disabled', ind);
    $("#dscComplementoEnderecoPre").attr('Disabled', ind);
    $("#dscBairroPre").attr('Disabled', ind);
    $("#dscCidadePre").attr('Disabled', ind);
    $("#dscEstadoPre").attr('Disabled', ind);
    $("#codCategoria").attr('Disabled', ind);
    $("#arquivo").attr('Disabled', ind);
    $("#nmeLoginCadPre").attr('Disabled', ind);
    $("#txtSenhaCadPre").attr('Disabled', ind);
    $("#txtSenhaConfPre").attr('Disabled', ind);
}

$(document).ready(function() {
    ExecutaDispatch('CategoriaServico','ListarCategoriaServicoAtivo', 'verificaPermissao;N|', montaBoxCategoria);
    ExecutaDispatch('UnidadeFederativa','ListarUnidadeFederativa', 'verificaPermissao;N|', MontaComboUFPre);
    DesabilitaCamposPre(true);
});