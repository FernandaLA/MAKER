<?php
include_once("Controller/Agenda/AgendaController.php");
include_once("Model/ServicoFinalizado/ServicoFinalizadoModel.php");
class ServicoFinalizadoController extends AgendaController
{
    /**
     * Redireciona para a Tela de  de ServicoFinalizado
     */
    Public Function ChamaView() {
        $params = array();
        echo $this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params);
    }

    Public Function ListarServicoFinalizado() {
        $ServicoFinalizadoModel = new ServicoFinalizadoModel();
        echo $ServicoFinalizadoModel->ListarServicoFinalizado();
    }
}