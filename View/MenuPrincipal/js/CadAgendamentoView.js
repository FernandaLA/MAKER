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
        params += "|dtaAgendamento;"+$("#dtaAgendamento").val()+"|";
        ExecutaDispatch('Agenda', 'InsertAgendamento', params, undefined, "Aguarde, salvando agendamento", "Agendamento salvo com sucesso! Aguarde a confirmação do prestador");
    });

    $("#dtaAgendamento").change(function() {
        var params = "codPrestador;"+$("#codPrestador").val()+"|dtaAgendamento;"+$("#dtaAgendamento").val()+"|";
        ExecutaDispatch('Agenda', 'ListaHorariosDisponiveis', params, montaComboHorario);
    });
});

function montaComboServicos(arrDados) {
    CriarComboDispatchComTamanho('codServico', arrDados, 0, 'cadAgendamento', undefined, '450');

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
        html += "<option value='"+lista[i]+"'>"+lista[i]+"</option>";
    }
    html += "</select>";
    
    $("#tddscHorario").html(html);
}

function informePrestador(nmePrestador, jornada, jornadaDias) {
    var html = '';
    html +=' <table width="100%">';
    html +='   <tr>';
    html +='     <td colspan="2" class="labelFont14" style="font-size: 19px">'+nmePrestador+'</td>';
    html +='   </tr>';
    html +='    <tr>';
    html +='      <td class="labelFont15">Jornada: ';
    html +='        <span style="color: magenta">'+jornada+'</span>';
    html +='      </td>';
    html +='      <td class="labelFont15">Dias de Atendimento: ';
    html +='        <span style="color: magenta">'+jornadaDias+'</span>';
    html +='      </td>';
    html +='    </tr>';
    html +=' </table>';
    html +=' <hr>';

    $("#infoPrestador").html(html);
}

$(document).ready(function() {
});
