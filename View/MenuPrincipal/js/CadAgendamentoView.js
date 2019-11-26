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
});

function montaComboServicos(arrDados) {
    CriarComboDispatch('codServico', arrDados, 0, 'cadAgendamento');

    $("#codServico").change(function () {
        if ($("#codServico").val() !== 0) {
            $("#dtaAgendamento").removeAttr('disabled');
        }
    });
}

function montaComboHorario(arrDados) {
    var lista = arrDados[1];
    var html= '';
    html += "<select id='dscHorario' name='dscHorario' class='cadAgendamento input' style='background-color: white;'>";
    html += '<option value="0" disabled selected>Selecione...</option>';
    for (var i = 0; i < lista.length; i++) {
    //$(arrDados[1]).each(function(index, horario) {
        html += "<option value='"+lista[i]+"'>"+lista[i]+"</option>";
    //});
    }
    html += "</select>";
    
    $("#tddscHorario").html(html);
}

$(document).ready(function() {
});
