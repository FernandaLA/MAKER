<?php
include_once 'Model/Usuario/UsuarioModel.php';
include_once 'Dao/Login/LoginDao.php';

class LoginModel extends UsuarioModel
{
    Public Function Logar(){
        $LoginDao = new LoginDao();
        $this->PopulaObjetoComRequest($LoginDao->GetColumns(), $LoginDao);
        $txtSenha = md5($this->objRequest->txtSenha);
        $this->objRequest->txtSenha = md5($this->objRequest->txtSenha);
        $result = $LoginDao->Logar($this->objRequest);
        if ($result[0]){
            if ($result[1]!=NULL){
                static::AtualizaSessao($result[1]);
                if ($txtSenha==md5('123459') || $txtSenha==md5('954321')){
                    $result[1][0]['DSC_PAGINA'] = 'Login';
                    $result[1][0]['NME_METHOD'] = 'ChamaAlterarSenhaView';
                } else {
                    $result[1][0]['DSC_PAGINA'] = 'MenuPrincipal';
                    $result[1][0]['NME_METHOD'] = 'ChamaView';
                }
            }else{
                $result[0] = false;
                $result[1] = 'Usuário não encontrado!';
            }
        }
        return json_encode($result);
    }
    
    Public Function AtualizaSessao($dados){
        $_SESSION['cod_usuario']=$dados[0]['COD_USUARIO'];
    }
    
    Public Function AlterarSenha(){
        $LoginDao = new LoginDao();
        $this->RecuperaRequest();
        $this->objRequest->codUsuario = $_SESSION['cod_usuario'];
        $this->objRequest->txtSenhaAtual = md5($this->objRequest->txtSenhaAtual);
        $this->objRequest->txtSenhaNova = md5($this->objRequest->txtSenhaNova);
        $result = $this->VerificaSenhaAtual();
        if ($result[0]){
            $result = $LoginDao->AlterarSenha($this->objRequest);
            if ($result[0]){
                $result[1] = array();
                $result[1][0]['DSC_PAGINA'] = 'MenuPrincipal';
                $result[1][0]['NME_METHOD'] = 'ChamaView';
            }
        }
        return json_encode($result);
    }
    
    Public Function VerificaSenhaAtual(){
        $LoginDao = new LoginDao();
        $verifica = $LoginDao->VerificaSenhaAtual($this->objRequest);
        if ($verifica[0]){
            if ($verifica[1][0]['QTD']==0){
                return array(false, 'Senha atual não confere!');
            }
        }else{
            return array(false, 'Problema ao executar a consulta!');
        }
        return array(true, 'Senha Correta!');
    }

}
?>
