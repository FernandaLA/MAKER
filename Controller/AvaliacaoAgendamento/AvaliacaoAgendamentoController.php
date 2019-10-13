<?php
include_once("Controller/BaseController.php");
include_once("Model/AvaliacaoAgendamento/AvaliacaoAgendamentoModel.php");
class AvaliacaoAgendamentoController extends BaseController
{
    /**
     * Redireciona para a Tela de  de AvaliacaoAgendamento
     */
    Public Function ChamaView() {
        $params = array();
        echo $this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params);
    }

    Public Function CarregaAvaliacaoAgendamento() {
        $AvaliacaoAgendamentoModel = new AvaliacaoAgendamentoModel();
        echo $AvaliacaoAgendamentoModel->CarregaAvaliacaoAgendamento();
    }
    
    Public Function InsertAvaliacaoAgendamento() {
        $AvaliacaoAgendamentoModel = new AvaliacaoAgendamentoModel();
        echo $AvaliacaoAgendamentoModel->InsertAvaliacaoAgendamento();
    }
}