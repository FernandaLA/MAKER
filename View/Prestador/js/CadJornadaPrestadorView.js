$(function() {
    $("#hraInicio").mask('99:99');
    $("#hraFim").mask('99:99');

    $('#fechaModalJornada').click(function () {
        $('#CadJornadaPrestador').hide('fade');
    });

    $(".checkDias").on('change', function() {
        var todos = true;
        $(".checkDias").each(function () {
            if (!$(this).prop('checked')) {
                todos = false;
            }
        });
        $("#todosDias").prop('checked', todos);
    });

    $('#btnSalvarJornada').click(function () {
        MontaComboDiaSelecionado();
    });
});


function MontaComboDiaSelecionado() {
    var diasAtendimento = '';
    $(".checkDias").each(function () {
        if ($(this).prop('checked')) {
            diasAtendimento += $(this).attr('codDia') + '-';
        }
    });
    diasAtendimento = diasAtendimento.substr(0, diasAtendimento.length-1);
    validaCamposJornada(diasAtendimento);
}

function carregaDadosJornada(dados) {
    var dadosJornada = dados[1][0];
    $("#codJornadaPrestador").val(dadosJornada['COD_JORNADA_PRESTADOR']);
    $("#hraInicio").val(dadosJornada['HRA_INICIO']);
    $("#hraFim").val(dadosJornada['HRA_FIM']);
    $(".checkDias").prop('checked',false);
    $("#todosDias").prop('checked',false);
    var DIAS = dadosJornada['DIAS_ATENDIMENTO'];
    if(DIAS != null){
        for (var i=0;i<DIAS.length;i++) {
            $("#chkDia"+DIAS[i]['COD_DIA']).prop('checked',true);
        }
    }
    if (DIAS.length==7){
        $("#todosDias").prop('checked',true);
    }
}

function validaCamposJornada(diasAtendimento) {
    if ($("#hraInicio").val() != '' && $("#hraFim").val() != '') {
        var hraInicio = $("#hraInicio").val().split(':');
        var hraFim = $("#hraFim").val().split(':');
        if ((1 <= hraInicio[0] && hraInicio[0] <= 24) && (hraInicio[1] <= 59)){
            if ((1 <= hraFim[0] && hraFim[0] <= 24) && (hraFim[1] <= 59)){
                if (diasAtendimento != "") {
                    salvarJornada(diasAtendimento);
                } else {
                    // "Nenhum dia de atendimento foi informado"
                    swal({
                        title: "Aviso!",
                        text: "Nenhum dia de atendimento foi informado",
                        confirmButtontext: "OK",
                        type: "warning"
                    });
                }
            } else {
                // "Hora Fim inválida"
                swal({
                    title: "Aviso!",
                    text: "Hora Fim inválida",
                    confirmButtontext: "OK",
                    type: "warning"
                });
            }
        } else {
            // "Hora Inicio inválida"
            swal({
                title: "Aviso!",
                text: "Hora Inicio inválida",
                confirmButtontext: "OK",
                type: "warning"
            });
        }
    } else {
        // "O horário da sua jornada precisa ser informado"
        swal({
            title: "Aviso!",
            text: "O horário da sua jornada precisa ser informado",
            confirmButtontext: "OK",
            type: "warning"
        });
    }
}

function salvarJornada(diasAtendimento) {
    var parametros = retornaParametros('cadJornada');
    parametros += "dscDiasAtendimento;"+diasAtendimento+"|";
    if ($("#codJornadaPrestador").val()) {
        $("#method").val('UpdateJornadaPrestador');
    } else {
        $("#method").val('InsertJornadaPrestador');
    }
    ExecutaDispatch('JornadaPrestador', $("#method").val(), parametros, fecharModalJornada, "Aguarde, salvando jornada", "Jornada salva com sucesso");
}

function fecharModalJornada() {
    ExecutaDispatch('Prestador', 'CarregaDadosPrestador', undefined, montaTelaPrestador);
    $('#CadJornadaPrestador').hide('fade');
}

$(document).ready(function() {
    // ExecutaDispatch('JornadaPrestador', 'CarregaJornadaPrestador', undefined, carregaDadosJornada);
    $("#todosDias").on('change', function() {
        if ($(this).prop('checked')) {
            $(".checkDias").prop('checked', true);
        } else {
            $(".checkDias").prop('checked', false);
        }
    });
});