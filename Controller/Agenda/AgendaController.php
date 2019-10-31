<?php
include_once("Controller/BaseController.php");
include_once("Model/Agenda/AgendaModel.php");
class AgendaController extends BaseController
{
    /**
     * Redireciona para a Tela de  de Agenda
     */
    Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function ListarAgenda() {
        $AgendaModel = new AgendaModel();
        echo $AgendaModel->ListarAgenda();
    }
    
    Public Function InsertAgendamento() {
        $AgendaModel = new AgendaModel();
        echo $AgendaModel->InsertAgendamento();
    }

    Public Function UpdateAgendamento() {
        $AgendaModel = new AgendaModel();
        echo $AgendaModel->UpdateAgendamento();
    }

    Public Function ListaHorariosDisponiveis() {
        $AgendaModel = new AgendaModel();
        echo $AgendaModel->ListaHorariosDisponiveis();
    }
}