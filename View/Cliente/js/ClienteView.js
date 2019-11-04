$(function() {
    $("#btnEditarPerfilCli").click(function () {
        $("#editarCadastro").show('fade');
    });

    $("#btnCancelaEdicao").click(function () {
        $("#editarCadastro").hide('fade');
    });

    $("#btnSalvarCadastro").click(function () {
        montaCampoCategorias();
    });

});

function montaTelaCliente(dados) {
    // console.log(dados);
    preencheCamposForm(dados[1][0], "Cli");
    var dadosPre = dados[1][0];
    var nmeCompleto = dadosPre['NME_USUARIO_COMPLETO'];
    var endereco = dadosPre['ENDERECO_COMPLETO'];
    // var nota = dadosPre['NOTA_AVALIACAO'];
    // var icon = $("#avaliacaoCliente").html();
    
    $("#nmeClienteCompleto").html(nmeCompleto);
    $("#enderecoCliente").html("<b>Endereço:</b> "+endereco);
    // $("#avaliacaoCliente").html("Avaliação: "+ nota + icon);
}

function MontaComboUF(arrDados) {
    CriarComboDispatch('sglUfCli', arrDados, 0, 'cadCliente');
}


function salvarCadastro(categorias) {
    var parametros = retornaParametros("cadCliente");
    ExecutaDispatch('Usuario','UpdateUsuario', parametros, retornoSalvarCadastro, "Aguarde, atualizando seu cadastro", "Cadastro atualizado com sucesso!");
}

function retornoSalvarCadastro() {
    $("#editarCadastro").hide();
}

$(document).ready(function() {
    ExecutaDispatch('Cliente', 'CarregaDadosCliente', undefined, montaTelaCliente);
    ExecutaDispatch('UnidadeFederativa','ListarUnidadeFederativa', undefined, MontaComboUF);
    $("#editarCadastro").hide();
});