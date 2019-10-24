<?php
include_once("Controller/Usuario/UsuarioController.php");
include_once("Model/ValidaPrestador/ValidaPrestadorModel.php");
class ValidaPrestadorController extends UsuarioController
{
    /**
     * Redireciona para a Tela de  de ValidaPrestador
     */
    Public Function ChamaView() {
        $params = array();
        echo $this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params);
    }

    Public Function ListarPrestadoresPendentes() {
        $ValidaPrestadorModel = new ValidaPrestadorModel();
        echo $ValidaPrestadorModel->ListarPrestadoresPendentes();
    }

    Public Function UpdateStatusPrestador() {
        $ValidaPrestadorModel = new ValidaPrestadorModel();
        echo $ValidaPrestadorModel->UpdateStatusPrestador();
    }
}