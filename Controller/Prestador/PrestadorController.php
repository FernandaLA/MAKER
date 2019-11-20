<?php
include_once("Controller/Usuario/UsuarioController.php");
include_once("Model/Prestador/PrestadorModel.php");
class PrestadorController extends UsuarioController
{
    /**
     * Redireciona para a Tela de  de Prestador
     */
    Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function ListarPrestador() {
        $PrestadorModel = new PrestadorModel();
        echo $PrestadorModel->ListarPrestador();
    }
    
    Public Function InsertPrestador() {
        $PrestadorModel = new PrestadorModel();
        echo $PrestadorModel->InsertPrestador();
    }

    Public Function UpdatePrestador() {
        $PrestadorModel = new PrestadorModel();
        echo $PrestadorModel->UpdatePrestador();
    }

    Public Function CarregaDadosPrestador() {
        $PrestadorModel = new PrestadorModel();
        echo $PrestadorModel->CarregaDadosPrestador();
    }
}