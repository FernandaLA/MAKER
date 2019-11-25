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
    
    $("#codServico").change(function () {
        if ($(this).val() != 0) {
            $("#dtaAgendamento").prop('disabled', false);
        }
    });

    $("#dtaAgendamento").change(function() {
        var params = "codPrestador;"+$("#codPrestador").val()+"|dtaAgendamento;"+$("#dtaAgendamento").val()+"|";
        ExecutaDispatch('Agenda', 'ListaHorariosDisponiveis', params, MontaComboHorario)
    });
});

function montaComboServicos(arrDados) {
    CriarComboDispatch('codServico', arrDados, 0, 'cadAgendamento');
}

function montaComboHorario(arrDados) {
    var html= '';
    html += "<select id='dscHorario' class='cadAgendamento'>";
    $(arrDados[1]).each(function(index, horario) {
        html += "<option id='index' value='horario' class='cadAgendamento'>horario</option>";
    });
    html += "</select>";
    
    $("#tddscHorario").html(html);
}

$(document).ready(function() {
});
