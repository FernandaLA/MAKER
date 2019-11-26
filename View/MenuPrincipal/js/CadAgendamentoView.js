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

    $("#dtaAgendamento").change(function() {
        var params = "codPrestador;"+$("#codPrestador").val()+"|dtaAgendamento;"+$("#dtaAgendamento").val()+"|";
        ExecutaDispatch('Agenda', 'ListaHorariosDisponiveis', params, montaComboHorario);
    });
    
    $("#codServico").change(function () {
        console.log('mudou');
        if ($("#codServico").val() !== 0) {
            $("#dtaAgendamento").prop('disabled', false);
        }
    });
});

function montaComboServicos(arrDados) {
    CriarComboDispatch('codServico', arrDados, 0, 'cadAgendamento');
}

function montaComboHorario(arrDados) {
    var html= '';
    html += "<select id='dscHorario' name='dscHorario' class='cadAgendamento input' style='background-color: white;'>";
    html += '<option value="-1" disabled selected>Selecione...</option>';
    $(arrDados[1]).each(function(index, horario) {
        html += "<option value='"+horario+"'>"+horario+"</option>";
    });
    html += "</select>";
    
    $("#tddscHorario").html(html);
}

$(document).ready(function() {
    $("#codServico").on('change', function() {
        console.log('mudou');
        if ($("#codServico").val() !== 0) {
            $("#dtaAgendamento").prop('disabled', false);
        }
    });
});
