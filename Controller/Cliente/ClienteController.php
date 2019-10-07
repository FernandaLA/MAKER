<?php
include_once("Controller/Usuario/UsuarioController.php");
include_once("Model/Cliente/ClienteModel.php");
class ClienteController extends UsuarioController
{
    /**
     * Redireciona para a Tela de  de Cliente
     */
    Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function CarregaListaPrestadores() {
        $ClienteModel = new ClienteModel();
        echo $ClienteModel->CarregaListaPrestadores();
    }
    
    // Public Function InsertCliente() {
    //     $ClienteModel = new ClienteModel();
    //     echo $ClienteModel->InsertCliente();
    // }

    // Public Function UpdateCliente() {
    //     $ClienteModel = new ClienteModel();
    //     echo $ClienteModel->UpdateCliente();
    // }
}