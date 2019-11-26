$(function() {
    $("#nroCpfPre").mask('999.999.999-99');
    $("#dtaNascimentoPre").mask('99/99/9999');
    $("#nroCepPre").mask('99999-999');
    $("#nroTelefonePre").mask('(99) 99999-9999');

    $("#btnEditarPerfilPre").click(function () {
        $("#editarCadastro").show('fade');
    });

    $("#btnCancelarEdicao").click(function () {
        $("#editarCadastro").hide('fade');
    });

    $("#btnSalvarCadastro").click(function () {
        montaCampoCategorias();
    });

    $("#btnMeusServicos").click(function () {
        $("#CadServicoPrestador").show('fade');
    });

    $("#btnEditarJornada").click(function () {
        ExecutaDispatch('JornadaPrestador', 'CarregaJornadaPrestador', undefined, carregaDadosJornada);
        $("#CadJornadaPrestador").show('fade');
    });
});

function montaTelaPrestador(dados) {
    preencheCamposForm(dados[1][0], "Pre");
    var dadosPre = dados[1][0];
    montaCategorias(dadosPre['CATEGORIAS']);
    var nmeCompleto = dadosPre['NME_USUARIO_COMPLETO'];
    var codUsuario = dadosPre['COD_USUARIO'];
    var DIAS = dadosPre['DIAS_ATENDIMENTO'];
    var endereco = dadosPre['ENDERECO_COMPLETO'];
    var caminhoFoto = dadosPre['DSC_CAMINHO_FOTO'];
    var sglUf = dadosPre['SGL_UF'];
    // var nota = dadosPre['NOTA_AVALIACAO'];
    // var icon = $("#avaliacaoPrestador").html();
    var jornada = "";
    if(dadosPre['HRA_INICIO'] !== "" && dadosPre['HRA_FIM'] !== ""){
        jornada = dadosPre['HRA_INICIO']+" às "+dadosPre['HRA_FIM'];
    } else {
        jornada = "Você ainda não cadastrou sua jornada";
    }
    
    var jornadaDias = "";
    if (DIAS != null) {
        for (var i=0;i<DIAS.length;i++) {
            jornadaDias += DIAS[i]['DSC_DIA']+'-';
        }
        jornadaDias = jornadaDias.substr(0, jornadaDias.length-1);
    } else {
        jornadaDias = "Você ainda cadastrou essa informação";
    }
    $("#codUsuarioPre").html(codUsuario);
    $("#sglUfPre").html(sglUf);
    $("#nmePrestadorCompleto").html(nmeCompleto);
    $("#jornadaPrestador").html(jornada);
    $("#diasAtendimento").html(jornadaDias);
    $("#enderecoPrestador").html("<b>Endereço:</b> "+endereco);
    if(caminhoFoto !== '') {
        $("#fotoPerfil").attr("src", caminhoFoto);
    }
    // $("#avaliacaoPrestador").html("Avaliação: "+ nota + icon);
}

function montaCategorias($cats) {
    var categorias = '';
    $(".checkCat").each(function (check) {
        $cats.each(function (cat) {
            if (check.attr('id') == cat) {
                check.prop('checked', true);
            }
        });
    });
    categorias = categorias.substr(0, categorias.length-1);
}

function listaCategorias(dados) {
    if (dados[0]) {
        if (dados[1] !== null) {
            montaComboCategoria(dados);
            var lista = "";
            for(var i = 0; i<dados[1].length; i++) {
                if(dados[1][i]['COD'] != 0) {
                    lista += "<u>"+dados[1][i]['DSC']+"</u> - ";
                }
            }
            var html = lista.substr(0, lista.length-3);
            
            $("#servicosPrestador").html(html)
        }
    }
}

function MontaComboUF(arrDados) {
    CriarComboDispatch('sglUfPre', arrDados, 0, 'cadPrestador', true);
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
        html += "<input type='checkbox' name='codCategoria' id='codCategoria' value='"+categorias[1][i]['COD']+"'class='cadPrestador checkCat'>"+categorias[1][i]['DSC']+"";
        html += "</strong>";
        html += "</td>"
        count++;
        if(count == 5){
            html += "</tr>";
        }
    }
    $("#servicosBox").html(html);
}

function montaCampoCategorias() {
    var categorias = '';
    $(".checkCat").each(function () {
        if ($(this).prop('checked')) {
            categorias += $(this).val() + '-';
        }
    });
    categorias = categorias.substr(0, categorias.length-1);

    salvarCadastro(categorias);
}

function salvarCadastro(categorias) {
    var parametros = retornaParametros("cadPrestador");
    parametros += "|categoriasPrestador;"+categorias+"|";
    ExecutaDispatch('Prestador','UpdatePrestador', parametros, retornoSalvarCadastro, "Aguarde, atualizando seu cadastro", "Cadastro atualizado com sucesso!");
}

function retornoSalvarCadastro() {
    $("#editarCadastro").hide();
}

$(document).ready(function() {
    ExecutaDispatch('Prestador', 'CarregaDadosPrestador', undefined, montaTelaPrestador);
    ExecutaDispatch('CategoriaServico','ListarCategoriaServicoPrestador', undefined, listaCategorias);
    ExecutaDispatch('CategoriaServico','ListarCategoriaServicoAtivo', undefined, montaBoxCategoria);
    ExecutaDispatch('UnidadeFederativa','ListarUnidadeFederativa', undefined, MontaComboUF);
    $("#editarCadastro").hide();
});
