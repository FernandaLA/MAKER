$(function() {

});

function CancelaAgendamento(codAgendamento) {
    params = "codAgendamento;"+codAgendamento+"|codStatus;5";
    ExecutaDispatch('Agenda', 'UpdateAgendamento', params, ListaServicosPendentes, "Aguarde, cancelando agendamento", "Agendamento cancelado com sucesso!")
}

function RecusarAgendamento(codAgendamento) {
    params = "codAgendamento;"+codAgendamento+"|codStatus;3";
    ExecutaDispatch('Agenda', 'UpdateAgendamento', params, ListaServicosPendentes, "Aguarde, recusando agendamento", "Agendamento recusado com sucesso!")
}

function AceitarAgendamento(codAgendamento) {
    params = "codAgendamento;"+codAgendamento+"|codStatus;2";
    ExecutaDispatch('Agenda', 'UpdateAgendamento', params, ListaServicosPendentes, "Aguarde, aceitando agendamento", "Agendamento aceito com sucesso!")
}

function CarregaLista(dados) {
    MontaCardAgenda(dados[1], "listagemPendentes");
}

function ListaServicosPendentes(){
    ExecutaDispatch('ServicoPendente', 'ListarServicoPendente', '', CarregaLista);
}

$(document).ready(function() {
    ListaServicosPendentes();
});