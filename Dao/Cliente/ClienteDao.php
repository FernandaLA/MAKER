<?php
include_once("Dao/Usuario/UsuarioDao.php");
class ClienteDao extends UsuarioDao
{
    
    Protected $tableName = "";

    Protected $columns = array ("codCategoria"  => array("column" =>"COD_CATEGORIA", "typeColumn" =>"I"));

    Protected $columnKey = array();

    Public Function ClienteDao() {
        $this->conect();
    }

    Public Function CarregaListaPrestadores() {
        $select = " SELECT U.COD_USUARIO,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           '4,8' AS NOTA_PRESTADOR,
                           U.TXT_EMAIL,
                           U.NRO_TELEFONE,
                           U.DSC_CAMINHO_FOTO,
                           J.COD_JORNADA_PRESTADOR,
                           J.HRA_INICIO,
                           J.HRA_FIM,
                           '' AS JORNADA_PRESTADOR
                      FROM SE_USUARIO U
                     INNER JOIN EN_JORNADA_PRESTADOR J
                        ON U.COD_USUARIO = J.COD_PRESTADOR
                     WHERE U.COD_PERFIL = 3
                       AND U.IND_ATIVO = 'S'";
        return $this->selectDB($select, false);
    }

    Public Function CarregaListaPrestadoresPorCategoria(stdClass $obj) {
        $select = " SELECT U.COD_USUARIO,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           '4,8' AS NOTA_PRESTADOR,
                           U.TXT_EMAIL,
                           U.NRO_TELEFONE,
                           U.DSC_CAMINHO_FOTO,
                           J.COD_JORNADA_PRESTADOR,
                           J.HRA_INICIO,
                           J.HRA_FIM,
                           '' AS JORNADA_PRESTADOR
                      FROM SE_USUARIO U
                     INNER JOIN EN_JORNADA_PRESTADOR J
                        ON U.COD_USUARIO = J.COD_PRESTADOR
                     INNER JOIN RE_CATEGORIA_SERVICO_PRESTADOR CSP
                        ON U.COD_USUARIO = CSP.COD_PRESTADOR
                       AND CSP.COD_CATEGORIA = ".$obj->codCategoria."
                     WHERE U.COD_PERFIL = 3
                       AND U.IND_ATIVO = 'S'";
        return $this->selectDB($select, false);
    }

    Public Function CarregaDadosCliente($codUsuario) {
        $select = " SELECT NME_USUARIO,
                           DSC_SOBRENOME,
                           CONCAT(NME_USUARIO, ' ', COALESCE(DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           DTA_NASCIMENTO,
                           NRO_CPF,
                           TXT_EMAIL,
                           NRO_TELEFONE,
                           NRO_CEP,
                           DSC_LOGRADOURO,
                           DSC_COMPLEMENTO_ENDERECO,
                           DSC_BAIRRO,
                           DSC_CIDADE,
                           SGL_UF,
                           CONCAT(COALESCE(DSC_LOGRADOURO, ''), ' ',
                                  COALESCE(DSC_COMPLEMENTO_ENDERECO, ''), ' ',
                                  COALESCE(DSC_BAIRRO, ''), ' ',
                                  COALESCE(DSC_CIDADE, ''), ' ',
                                  COALESCE(SGL_UF, '')) AS ENDERECO_COMPLETO,
                           DSC_CAMINHO_FOTO
                      FROM SE_USUARIO
                     WHERE COD_USUARIO =". $codUsuario;
        
        return $this->selectDB($select, false);
    }
}