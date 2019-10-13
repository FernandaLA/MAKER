<?php
include_once("Controller/Agenda/AgendaController.php");
include_once("Model/ServicoPendente/ServicoPendenteModel.php");
class ServicoPendenteController extends AgendaController
{
    /**
     * Redireciona para a Tela de  de ServicoPendente
     */
    Public Function ChamaView() {
        $params = array();
        echo $this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params);
    }

    Public Function ListarServicoPendente() {
        $ServicoPendenteModel = new ServicoPendenteModel();
        echo $ServicoPendenteModel->ListarServicoPendente();
    }
}