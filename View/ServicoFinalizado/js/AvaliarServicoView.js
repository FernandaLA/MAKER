$(function() {
    $("#fechaModalAvaliacao").click(function () {
        $("#AvaliacaoServico").hide('fade');
        params = "codAgendamento;"+$("#codAgendamento").val()+"|codStatus;4";
        ExecutaDispatch('Agenda', 'UpdateAgendamento', params, ListarServicosFinalizados, "Aguarde", "Agendamento finalizado com sucesso!")
    });
    
    // Create jqxRating
    $("#notaAvaliacao").jqxRating({ width: 350, height: 35, theme: 'classic', itemHeight: 50, itemWidth: 60 });
    $("#notaAvaliacao").on('change', function (event) {
        $("#nroNotaAvaliacao").val(event.value);
        var txt = '';
        switch (event.value) {
            case 1:
                txt = 'Péssimo';
            break;
            case 2:
                txt = 'Ruim';
            break;
            case 3:
                txt = 'Bom';
            break;
            case 4:
                txt = 'Ótimo';
            break;
            case 5:
                txt = 'Excelente';
            break;
        }
        $("#infoNota").find('span').remove();
        $("#infoNota").append('<span>' + txt + '</span');
    });

    $("#btnAvaliar").click(function () {
        // params = "codAgendamento;"+codAgendamento+"|codStatus;4";
        // ExecutaDispatch('Agenda', 'UpdateAgendamento', params, undefined, "Aguarde", "Agendamento finalizado com sucesso!")
        var params = retornaParametros('avaliacaoServico');
        console.log(params);
        ExecutaDispatch('AvaliacaoAgendamento', 'InsertAvaliacaoAgendamento', params, retornoAvaliacao, "Aguarde, salvando Avaliação", "Avaliação salva com sucesso!");
    });
});

function retornoAvaliacao() {
    ListarServicosFinalizados();
    LimparCampos('avaliacaoServico');
    $("#AvaliacaoServico").hide('fade');
}
    
$(document).ready(function() {

});