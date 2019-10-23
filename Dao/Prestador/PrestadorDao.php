<?php
include_once("Dao/Usuario/UsuarioDao.php");
class PrestadorDao extends UsuarioDao
{

    Public Function PrestadorDao() {
        $this->conect();
    }

    Public Function ListarPrestador() {
        return $this->MontarSelect();
    }
    
    Public Function UpdatePrestador(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }
    
    Public Function InsertPrestador(stdClass $obj) {
        $obj->codUsuario = $this->CatchUltimoCodigo('SE_USUARIO', 'COD_USUARIO');
        $obj->indAtivo = "N";
        $obj->txtSenha = md5($obj->txtSenha);
        return $this->MontarInsert($obj);
    }

    Public Function CarregaDadosPrestador($codUsuario) {
        $select = " SELECT U.NME_USUARIO,
                           U.DSC_SOBRENOME,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           U.DTA_NASCIMENTO,
                           U.NRO_CPF,
                           U.TXT_EMAIL,
                           U.NRO_TELEFONE,
                           U.NRO_CEP,
                           U.DSC_LOGRADOURO,
                           U.DSC_COMPLEMENTO_ENDERECO,
                           U.DSC_BAIRRO,
                           U.DSC_CIDADE,
                           U.SGL_UF,
                           CONCAT(COALESCE(U.DSC_LOGRADOURO, ''), ' ',
                                  COALESCE(U.DSC_COMPLEMENTO_ENDERECO, ''), ' ',
                                  COALESCE(U.DSC_BAIRRO, ''), ' ',
                                  COALESCE(U.DSC_CIDADE, ''), ' ',
                                  COALESCE(U.SGL_UF, '')) AS ENDERECO_COMPLETO,
                           U.DSC_CAMINHO_FOTO,
                           U.DSC_CAMINHO_CERTIFICADO,
                           J.COD_JORNADA_PRESTADOR,
                           J.HRA_INICIO,
                           J.HRA_FIM
                      FROM SE_USUARIO U
                      LEFT JOIN EN_JORNADA_PRESTADOR J
                        ON U.COD_USUARIO = J.COD_PRESTADOR
                     WHERE COD_USUARIO =". $codUsuario;
        
        return $this->selectDB($select, false);
    }
}