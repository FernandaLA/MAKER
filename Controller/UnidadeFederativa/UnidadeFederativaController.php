<?php
include_once("Controller/BaseController.php");
include_once("Model/UnidadeFederativa/UnidadeFederativaModel.php");
class UnidadeFederativaController extends BaseController
{
    /**
     * Redireciona para a Tela de  de UnidadeFederativa
     */
    Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function ListarUnidadeFederativa() {
        $UnidadeFederativaModel = new UnidadeFederativaModel();
        echo $UnidadeFederativaModel->ListarUnidadeFederativa();
    }
}