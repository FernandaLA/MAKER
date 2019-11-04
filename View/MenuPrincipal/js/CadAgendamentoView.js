$(function() {
    $('#fechaModalAgendamento').click(function () {
        LimparCampos('cadAgendamento');
        $('#CadAgendamento').hide('fade');
    });

    $('#btnCancelar').click(function () {
        LimparCampos('cadAgendamento');
        $('#CadAgendamento').hide('fade');
    });

    $('#btnSalvarAgendamento').click(function () {
        var params = retornaParametros('cadAgendamento');
        ExecutaDispatch('Agenda', 'InsertAgendamento', params, "Aguarde, salvando agendamento", "Agendamento salvo com sucesso! Aguarde a confirmação do prestador");
    });
    
    $("#codServico").change(function() {
        if($(this).val() !== 0) {
            $("#dtaAgendamento").prop('disabled', false);
        }
    });
    $("#dtaAgendamento").change(function() {
        var params = "codServico;"+$("#codServico").val()+"|dtaAgendamento;"+$("#dtaAgendamento").val()+"|";
        ExecutaDispatch('Agenda', 'ListaHorariosDisponiveis', params, MontaComboHorario)
    });
});

function montaComboServicos(arrDados) {
    CriarComboDispatch('codServico', arrDados, 0, 'cadAgendamento');
}

function montaComboHorario(arrDados) {
    CriarComboDispatch('dscHorario', arrDados, 0, 'cadAgendamento');
}

$(document).ready(function() {
});