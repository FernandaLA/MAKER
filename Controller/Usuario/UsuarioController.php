<?php 
include_once("Controller/BaseController.php");
include_once("Model/Usuario/UsuarioModel.php");
class UsuarioController extends BaseController
{

    Public function ChamaView(){
        $params = array();        
        echo $this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params);  
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

    Public Function ResetaSenha(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->ResetaSenha();
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
    
    Public Function UploadCertificado(){
        $arquivo = $_FILES['arquivo'];
        $tipos = array('pdf');
        $enviar = $this->uploadFile($arquivo, PATH_CERTIFICADOS, $tipos);
        echo json_encode($enviar);
    }
    
    Public Function UploadFotoPerfil() {
        $arquivo = $_FILES['arquivo'];
        $tipos = array('jpg', 'png', 'jpeg');
        $enviar = $this->uploadFile($arquivo, PATH_FOTOS, $tipos);
        echo json_encode($enviar);
    }
    
    Private Function uploadFile($arquivo, $pasta, $tipos, $nome = null){
        $nomeOriginal='';
        if(isset($arquivo)){
            $infos = explode(".", $arquivo["name"]);
            if(!$nome){
                for($i = 0; $i < count($infos) - 1; $i++){
                    $nomeOriginal = $nomeOriginal . $infos[$i] . ".";
                }
            }else{
                $nomeOriginal = $nome . ".";
            }
            $tipoArquivo = $infos[count($infos) - 1];
            $tipoPermitido = false;
            foreach($tipos as $tipo){
                if(strtolower($tipoArquivo) == strtolower($tipo)){
                    $tipoPermitido = true;
                }
            }            
            if(!$tipoPermitido){
                $retorno[0] = false;
                $retorno[1] = "Formato de arquivo não permitido";
            }else{
                if(move_uploaded_file($arquivo['tmp_name'], $pasta . $nomeOriginal . $tipoArquivo)){
                    $retorno[0] = true;
                    $retorno[1] = $pasta . $nomeOriginal . $tipoArquivo;
                }
                else{
                    $retorno[0] = false;
                    $retorno[1] = "Erro ao fazer upload";
                }
            }
        }
        else{
            $retorno[0] = false;
            $retorno[1] = "Arquivo nao setado";
        }
        return $retorno;
    } 
}
?>