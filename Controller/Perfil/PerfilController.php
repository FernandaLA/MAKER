<?php
include_once("Controller/BaseController.php");
include_once("Model/Perfil/PerfilModel.php");
class PerfilController extends BaseController
{
    Public function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public function ListarPerfil(){
        $model = new PerfilModel();
        echo $model->ListarPerfil();
    }

    Public function ListarPerfilAtivo(){
        $model = new PerfilModel();
        echo $model->ListarPerfilAtivo();
    }

    Public function AddPerfil(){
        $PerfilModel = new PerfilModel();
        echo $PerfilModel->AddPerfil();
    }
    Public Function UpdatePerfil(){
        $PerfilModel = new PerfilModel();
        echo $PerfilModel->UpdatePerfil();
    }
    
    Public Function RetornaPerfilUsuarioLogado(){
        $PerfilModel = new PerfilModel();
        echo $PerfilModel->RetornaPerfilUsuarioLogado();   
    }
}
?>