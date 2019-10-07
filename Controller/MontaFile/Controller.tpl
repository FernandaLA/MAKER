<?php
include_once("Controller/BaseController.php");
include_once("Model/#class/#classModel.php");
class #classController extends BaseController
{
    /**
     * Redireciona para a Tela de  de #class
     */
    Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function Listar#class() {
        $#classModel = new #classModel();
        echo $#classModel->Listar#class();
    }
    
    Public Function Insert#class() {
        $#classModel = new #classModel();
        echo $#classModel->Insert#class();
    }

    Public Function Update#class() {
        $#classModel = new #classModel();
        echo $#classModel->Update#class();
    }
}