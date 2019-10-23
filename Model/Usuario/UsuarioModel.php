<?php
include_once("Model/BaseModel.php");
include_once("Dao/Usuario/UsuarioDao.php");
include_once("Resources/php/FuncoesArray.php");
include_once("Resources/php/FuncoesString.php");
class UsuarioModel extends BaseModel
{
    function UsuarioModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    function ListarUsuario(){
        $dao = new UsuarioDao();
        $lista = $dao->ListarUsuario();
        if ($lista[0]){
            if ($lista[1]!=null){
                $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
            }
        }
        return json_encode($lista);
    }

    function ListaDadosUsuario(){
        $dao = new UsuarioDao();
        $lista = $dao->ListaDadosUsuario($_SESSION['cod_perfil']);
        return json_encode($lista);
    }
    
    function InsertUsuario(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->nmeUsuario = strtoupper($this->objRequest->nmeUsuario);
        $this->objRequest->dscSobrenome = strtoupper($this->objRequest->dscSobrenome);
        return json_encode($dao->InsertUsuario($this->objRequest));
    }
    
    function AddUsuario(){
        $dao = new UsuarioDao();
        return json_encode($dao->AddUsuario());
    }

    function UpdateUsuario(){
        $dao = new UsuarioDao();
        return json_encode($dao->UpdateUsuario());
    }

    function DeleteUsuario(){
        $dao = new UsuarioDao();
        return $dao->DeleteUsuario();
    }
    
    function VerificaCpf(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $nroCpf = $this->objRequest->nroCpf;
        if (FuncoesString::validaCPF($nroCpf)) {
            $result = $dao->VerificaUsuario($nroCpf);
            if($result[0] && $result[1] > 0) {
                $result[0] = false;
                $result[1] = 'CPF já cadastrado em nosso sistema!';
            }
        } else {
            $result[0] = false;
            $result[1] = 'O CPF informado é inválido!';
        }
        
        return json_encode($result);
    }

    // Public Function ReiniciarSenha(){
    //     $dao = new UsuarioDao();
    //     return json_encode($dao->ReiniciarSenha());
    // }

    Public Function ResetaSenha(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $nroCpf = $this->objRequest->nroCpf;
        return json_encode($dao->ResetaSenha($nroCpf));
    }

    Public Function AlterarSenha(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $codUsuario = $_SESSION['cod_usuario'];
        $senhaAtual = $this->objRequest->txtSenha;
        $novaSenha = filter_input(INPUT_POST, 'novaSenha', FILTER_SANITIZE_STRING);
        $result = $dao->VerificaSenhaAtual($codUsuario, $senhaAtual);
        if($result[0]){
            $result = $dao->RecuperarSenha($codUsuario, $novaSenha);
        } else {
            $result[0] = false;
            $result[0] = "Senha Atual Incorreta! Verifique seu e-mail.";
        }
        return json_encode($result);
    }

    Public Function RecuperarSenha(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        // $nroCpf = filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->objRequest->nroCpf)){
            $nroCpf = $this->objRequest->nroCpf;
            if (FuncoesString::validaCPF($nroCpf)) {
                $result = $dao->VerificaUsuario($nroCpf);
                if($result[0]) {
                    if($result[1] > 0) {
                        $codUsuario = $result[1][0]['COD_USUARIO'];
                        $novaSenha = md5('954321');
                        $result = $dao->RecuperarSenha($codUsuario, $novaSenha);
                        // if ($result[0]) {
                        //     Enviar email para o usuário com a nova senha
                        // }
                    } else {
                        $result[0] = false;
                        $result[1] = "Nenhum Usuário encontrado com o CPF informado!";
                    }
                }
            } else {
                $result[0] = false;
                $result[1] = "CPF inválido!";
            }
        } else {
            $result[0] = false;
            $result[1] = "Informe o CPF!";
        }
        return json_encode($result);
    }
}
?>
