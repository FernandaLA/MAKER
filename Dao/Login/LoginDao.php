<?php
include_once 'Dao/Usuario/UsuarioDao.php';
include_once 'Resources/php/FuncoesArray.php';

class LoginDao extends UsuarioDao{
    
    Public Function Logar($objRequest){
        $select = "SELECT COD_USUARIO,
                          COD_PERFIL
                     FROM SE_USUARIO
                    WHERE NRO_CPF = '".$objRequest->nmeLogin."'
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
    
    Public Function VerificaUsuario(){
        $select = "SELECT COALESCE(COUNT(*),0) AS QTD 
                     FROM SE_USUARIO
                    WHERE NME_LOGIN = '".$this->Populate('nmelogin')."'";
        return $this->selectDB($select, false);
    }
    
    Public Function VerificaEmail(){
        $select = "SELECT COALESCE(COUNT(*),0) AS QTD 
                     FROM SE_USUARIO
                    WHERE TXT_EMAIL = '".$this->Populate('txtEmail')."'";
        return $this->selectDB($select, false);
    }
    
    // Public Function InsereCadastro(){
    //     $codUsuario = $this->CatchUltimoCodigo($this->tableName, 'COD_USUARIO');
    //     $sql = "INSERT INTO SE_USUARIO (COD_USUARIO, 
    //                                     NME_USUARIO,
    //                                     NRO_CPF,
    //                                     TXT_EMAIL,
    //                                     NRO_TELEFONE,
    //                                     DSC_ENDERECO, 
    //                                     NME_LOGIN, 
    //                                     TXT_SENHA, 
    //                                     COD_PERFIL,
    //                                     IND_ATIVO)
    //             VALUES(".$codUsuario.",
    //                    '".$this->Populate('nmeUsuario')."',
    //                    '".$this->Populate('nroCpf')."', 
    //                    '".$this->Populate('txtEmail')."', 
    //                    '".$this->Populate('nroTelefone')."', 
    //                    '".$this->Populate('dscEndereco')."', 
    //                    '".$this->Populate('nmeLogin')."', 
    //                    '".md5($this->Populate('txtSenha'))."',
    //                    2,
    //                    'S')";
    //     return $this->insertDB($sql);
    // }

}
?>
