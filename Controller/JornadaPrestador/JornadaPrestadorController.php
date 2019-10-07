<?php
include_once("Controller/BaseController.php");
include_once("Model/JornadaPrestador/JornadaPrestadorModel.php");
class JornadaPrestadorController extends BaseController
{
    /**
     * Redireciona para a Tela de  de JornadaPrestador
     */
    Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function CarregaJornadaPrestador() {
        $JornadaPrestadorModel = new JornadaPrestadorModel();
        echo $JornadaPrestadorModel->CarregaJornadaPrestador();
    }
    
    Public Function InsertJornadaPrestador() {
        $JornadaPrestadorModel = new JornadaPrestadorModel();
        echo $JornadaPrestadorModel->InsertJornadaPrestador();
    }

    Public Function UpdateJornadaPrestador() {
        $JornadaPrestadorModel = new JornadaPrestadorModel();
        echo $JornadaPrestadorModel->UpdateJornadaPrestador();
    }
}