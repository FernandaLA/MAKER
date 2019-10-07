<?php 
include_once("Controller/BaseController.php");
include_once("Model/Usuario/UsuarioModel.php");
class UsuarioController extends BaseController
{

    Public function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));  
    }

    Public function ListarUsuario(){
        $model = new UsuarioModel();
        echo $model->ListarUsuario();
    }
    
    Public Function ListaDadosUsuario(){
        $model = new UsuarioModel();
        echo $model->ListaDadosUsuario();        
    }
    Public function InsertUsuario(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->InsertUsuario();
    }
    Public function AddUsuario(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->AddUsuario();
    }
    Public function UpdateUsuario(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->UpdateUsuario();  
    }

    Public function DeleteUsuario(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->UpdateUsuario();
    }

    Public function VerificaCpf(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->VerificaCpf();
    }

    // Public Function ReiniciarSenha(){
    //     $UsuarioModel = new UsuarioModel();
    //     echo $UsuarioModel->ReiniciarSenha();
    // }

    Public Function ResetaSenha(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->ResetaSenha();
    }

    Public Function AlterarSenha(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->AlterarSenha();
    }

    Public Function RecuperarSenha(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->RecuperarSenha();
    }

    Public Function PesquisaCep(){
        $ch = curl_init();
        $cep = str_replace('.', '', filter_input(INPUT_POST, 'nroCep', FILTER_SANITIZE_STRING));
        $cep = str_replace('-', '', $cep);
        $url = "http://viacep.com.br/ws/".$cep."/json/";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $body = curl_exec($ch);
        $retorno[0]=true;
        $retorno[1]=array(json_decode($body));
        echo json_encode($retorno);;
    }
}
?>