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
        montaCampoCategorias();
    });

    $("#nroCepPre").on('blur', function(){
        if ($(this).val()!=''){
            pesquisaCepPre();
        }
    });

    $("#nmeUsuarioPre").on("input", function(){
        var regexp = /[^a-zA-Zà-úÀ-Ú' ]/g;
        if(this.value.match(regexp)){
          $(this).val(this.value.replace(regexp,''));
        }
    });

    $("#dscSobrenomePre").on("input", function(){
        var regexp = /[^a-zA-Zà-úÀ-Ú' ]/g;
        if(this.value.match(regexp)){
          $(this).val(this.value.replace(regexp,''));
        }
    });

    $("#arquivo").change(function() {
        var formCertificado = new FormData($('#formCertificado')[0]);
        ExecutaDispatchUpload('Prestador', 'SalvarCertificado', formCertificado, preencheCampoCartificado);
    });

    $("#fotoPre").change(function() {
        var formFotoPre = new FormData($('#formFotoPre')[0]);
        ExecutaDispatchUpload('Prestador', 'SalvarFotoPre', formFotoPre, preencheCampoFotoPre);
    });

});

function preencheCampoCartificado(rota) {
    $("#dscCaminhoCertificado").val(rota);
}

function preencheCampoFotoPre(rota) {
    $("#dscCaminhoFotoPre").val(rota);
}

function montaCampoCategorias() {
    var categorias = '';
    $(".checkCat").each(function () {
        if ($(this).prop('checked')) {
            categorias += $(this).val() + '-';
        }
    });
    categorias = categorias.substr(0, categorias.length-1);

    salvarCadastroPre(categorias);
}

function retornaEnvioFoto(dado) {
    $("#dscCaminhoFotoPre").val(dado[1]);
}

function retornaEnvioCertificado(dado) {
    $("#dscCaminhoCertificado").val(dado[1]);
}

function pesquisaCepPre(){
    var parametros = 'nroCep;'+$("#nroCepPre").val()+'|verificaPermissao;N|';
    ExecutaDispatch('Usuario','PesquisaCep', parametros, preencheEnderecoPre);  
}

function preencheEnderecoPre(data) {
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
        $("#sglUfPre").val(endereco.uf);
    }

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
        DesabilitaCamposPre(true);
        swal({
            title: "Aviso!",
            text: resposta[1],
            confirmButtontext: "OK",
            type: "alert"
        });
        limparCampos();
    }

}

function montaBoxCategoria(categorias) {
    if(categorias[1] !== null) {
        var count = 5;
        var html = "";
    
        for (var i=0; i<categorias[1].length; i++ ) {
            if(count == 5){
                html += "<tr>";
                count = 0;
            }
            html += "<td width='300px'>";
            html += "<strong class='checkbox'>";
            html += "<input type='checkbox' name='codCategoria' id='codCategoria"+categorias[1][i]['COD']+"' value='"+categorias[1][i]['COD']+"'class='cadPrestador checkCat'>"+categorias[1][i]['DSC']+"";
            html += "</strong>";
            html += "</td>"
            count++;
            if(count == 5){
                html += "</tr>";
            }
        }
        $("#servicosBox").html(html);
    }
}

function salvarCadastroPre(categorias) {
    var parametros = retornaParametros("cadPrestador");
    parametros += "|categoriasPrestador;"+categorias+"|verificaPermissao;N";
    ExecutaDispatch('Prestador','InsertPrestador', parametros, retornoSalvarPrestador, "Aguarde, Salvando",
                    "Cadastro realizado com sucesso! Iremos validar seu cadastro e entraremos em contato via Email");
}

function retornoSalvarPrestador(dado) {
    if(dado[0]){
        $('#CadPrestador').hide('fade');
        LimparCampos('CadPrestador');
    }
}


function DesabilitaCamposPre(ind) {
    $(".cadPrestador").attr('Disabled', ind);
    $("#nroCpfPre").attr('Disabled', false);
    $("#dscLogradouroPre").attr('Disabled', true);
    $("#dscBairroPre").attr('Disabled', true);
    $("#dscCidadePre").attr('Disabled', true);
    $("#sglUfPre").attr('Disabled', true);
}

$(document).ready(function() {
    ExecutaDispatch('CategoriaServico','ListarCategoriaServicoAtivo', 'verificaPermissao;N|', montaBoxCategoria);
    DesabilitaCamposPre(true);
});