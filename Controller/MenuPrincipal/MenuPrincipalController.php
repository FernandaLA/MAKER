<?php
include_once("Controller/Menu/MenuController.php");
include_once("Model/MenuPrincipal/MenuPrincipalModel.php");

class MenuPrincipalController extends MenuController {

    Public Function ChamaView(){
        $params = array();        
        echo $this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params);        
    }

    Public Function VerificaSessao() {
        if (!isset($_SESSION['cod_usuario'])) {
            echo json_encode(array(false));
        } else {
            echo json_encode(array(true));
        }
    }

    Public Function CarregaMenuNew() {
        $menuModel = new MenuPrincipalModel();
        echo $menuModel->CarregaMenuNew($this->getPath());
    }

    Public Function CarregaDadosUsuario() {
        $menuModel = new MenuPrincipalModel();
        echo $menuModel->CarregaDadosUsuario();
    }

}
?>