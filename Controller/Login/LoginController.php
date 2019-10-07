<?php
include_once("Controller/Usuario/UsuarioController.php");
include_once("Model/Login/LoginModel.php");

class LoginController extends UsuarioController
{
    Public Function Logar(){
        $LoginModel = new LoginModel();
        echo $LoginModel->Logar();
    }   
    
    Public Function ChamaAlterarSenhaView(){
        $params = array();
        echo ($this->gen_redirect_and_form('View/Usuario/AlteraSenhaView.php', $params));
    }

    Public Function AlterarSenha(){
        $LoginModel = new LoginModel();
        echo $LoginModel->AlterarSenha();        
    }   
    
    Public Function Logoff(){
        $params = array();
        echo ($this->gen_redirect_and_form('index.php', $params));
    }
}
?>