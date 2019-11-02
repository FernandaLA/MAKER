$(function() {
    $("#btnPesquisar").click(function() {
        var parametros = retornaParametros();
        ExecutaDispatch('Cliente', 'CarregaListaPrestadores', parametros, MontaListaPrestadores);
    });
});

function MontaTela(dado) {
    if(dado[0]) {
        if(dado[1][0]['COD_PERFIL'] == 3) {
            $("#telaCliente").hide();
            $("#telaPrestador").show();
            ExecutaDispatch('Agenda', 'ListarServicosFuturos', '', MontaListaServicos);
        } else if(dado[1][0]['COD_PERFIL'] == 4) {
            $("#telaCliente").show();
            $("#telaPrestador").hide();
            ExecutaDispatch('Cliente', 'CarregaListaPrestadores', '',MontaListaPrestadores);
            ExecutaDispatch('CategoriaServico', 'ListarCategoriaServicoAtivo', undefined, MontaComboCategorias);
        }
    }
}

function MontaListaServicos(dados) {
    MontaCardServico(dados[1], "listagemServicosFuturos");
}

function MontaListaPrestadores(dados) {
    MontaCardServico(dados[1], "listagemPrestadores", true);
}

function MontaComboCategorias(arrDados) {
    CriarComboDispatch('codCategoria', arrDados, 0, 'persist');
}

function SolicitarAgendamento(codPrestador) {
    $('#codPrestador').val(codPrestador);
    $('#CadAgendamento').show('fade');
}

$(document).ready(function() {
    ExecutaDispatch('Cliente', 'CarregaListaPrestadores', '', CarregaLista);
    ExecutaDispatch('CategoriaServico', 'ListarCategoriaServicoAtivo', undefined, MontaComboCategorias);
});
