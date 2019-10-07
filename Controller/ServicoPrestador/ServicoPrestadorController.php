<?php
include_once("Controller/BaseController.php");
include_once("Model/ServicoPrestador/ServicoPrestadorModel.php");
class ServicoPrestadorController extends BaseController
{
    /**
     * Redireciona para a Tela de  de ServicoPrestador
     */
    Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function ListarServicoPrestador() {
        $ServicoPrestadorModel = new ServicoPrestadorModel();
        echo $ServicoPrestadorModel->ListarServicoPrestador();
    }
    
    Public Function InsertServicoPrestador() {
        $ServicoPrestadorModel = new ServicoPrestadorModel();
        echo $ServicoPrestadorModel->InsertServicoPrestador();
    }

    Public Function UpdateServicoPrestador() {
        $ServicoPrestadorModel = new ServicoPrestadorModel();
        echo $ServicoPrestadorModel->UpdateServicoPrestador();
    }
}