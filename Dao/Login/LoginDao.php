<?php
include_once 'Dao/Usuario/UsuarioDao.php';
include_once 'Resources/php/FuncoesArray.php';

class LoginDao extends UsuarioDao{
    
    Public Function Logar($objRequest){
        $select = "SELECT COD_USUARIO,
                          COD_PERFIL
                     FROM SE_USUARIO
                    WHERE NRO_CPF = '".$objRequest->nroCpf."'
                      AND TXT_SENHA = '".$objRequest->txtSenha."'
                      AND IND_ATIVO = 'S'";
        return $this->selectDB($select, false);
    }
    
    Public Function VerificaSenhaAtual($objRequest){
        $select = "SELECT COUNT(COD_USUARIO) AS QTD
                     FROM SE_USUARIO
                    WHERE COD_USUARIO = ".$objRequest->codUsuario."
                      AND TXT_SENHA   = '".$objRequest->txtSenhaAtual."'";
        return $this->selectDB($select, false);
    }
    
    Public Function AlterarSenha($objRequest){
        $update = "UPDATE ".$this->tableName."
                      SET TXT_SENHA = '".$objRequest->txtSenhaNova."'
                    WHERE COD_USUARIO = ".$objRequest->codUsuario;
        return $this->insertDB($update);
    }
    
    Public Function VerificaEmail(){
        $select = "SELECT COALESCE(COUNT(*),0) AS QTD 
                     FROM SE_USUARIO
                    WHERE TXT_EMAIL = '".$this->Populate('txtEmail')."'";
        return $this->selectDB($select, false);
    }

}
?>
