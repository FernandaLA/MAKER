$(function() {
});

function AvaliarAgendamento(codAgendamento, nmeUsuario, codAvaliado) {
    $("#codAgendamento").val(codAgendamento);
    $("#codUsuarioAvaliado").val(codAvaliado);
    $("#nmeUsuario").html(nmeUsuario);
    $("#AvaliacaoServico").show('fade');
}

function CarregaLista(dados) {
    MontaCardAgenda(dados[1], "listagemFinalizados");
    for (var i = 0;i < dados[1].length; i++) {
        if(dados[1][i]['SITUACAO'] == 'Finalizado' && dados[1][i]['NRO_NOTA_AVALIACAO']){
            $("#avaliacao"+dados[1][i]['COD_AGENDAMENTO']).jqxRating({ width: 350, height: 35, theme: 'classic', itemHeight: 50, itemWidth: 60, disabled: true, value: dados[1][i]['NRO_NOTA_AVALIACAO'] });
        }
    }
}

function ListarServicosFinalizados() {
    ExecutaDispatch('ServicoFinalizado', 'ListarServicoFinalizado', '', CarregaLista);
}

$(document).ready(function() {
    ListarServicosFinalizados();
});