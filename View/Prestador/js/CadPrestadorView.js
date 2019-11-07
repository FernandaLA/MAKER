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
        // if($('#arquivo').val() != '') {
        //     var formCertificado = new FormData($('#formComprovante')[0]);
        //     // Ta sem permissão
        //     ExecutaDispatchUpload('Usuario', 'UploadCertificado', formCertificado+"|verificaPermissao;N|", retornaEnvioCertificado);
        // }
    });
        
    $("#nroCepPre").on('blur', function(){
        if ($(this).val()!=''){
            pesquisaCepPre();
        }
    });

});

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
    parametros += "|verificaPermissao;N|categoriasPrestador;"+categorias+"|";
    ExecutaDispatch('Prestador','InsertPrestador', parametros, retornoSalvarPrestador, "Aguarde, Salvando",
                    "Cadastro realizado com sucesso! Iremos validar seu cadastro e entraremos em contato via Email");
}

function retornoSalvarPrestador(dado) {
    if(dado[0]){
        $('#CadPrestador').hide('fade');
    }
}


function DesabilitaCamposPre(ind) {
    $(".cadPrestador").attr('Disabled', ind);
    $("#nroCpfPre").attr('Disabled', false);
    $("#dscLogradouroPre").attr('Disabled', true);
}

$(document).ready(function() {
    ExecutaDispatch('CategoriaServico','ListarCategoriaServicoAtivo', 'verificaPermissao;N|', montaBoxCategoria);
    DesabilitaCamposPre(true);

    // $('#fotoPre').change(function () {
    //     if($('#fotoPre').val() !== ''){
    //         // Ta sem permissão
    //         var formFoto = new FormData(document.formFoto);
    //         var parametros = "fotoPre;"+formFoto+"|verificaPermissao;N|";
    //         ExecutaDispatchUpload('Usuario', 'UploadFotoPerfil', parametros, retornaEnvioFoto, 'Aguarde...', 'Foto Salva!!');
    //     }
    // });
});