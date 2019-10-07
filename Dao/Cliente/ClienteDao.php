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
                     WHERE U.IND_ATIVO = 'S'";
        return $this->selectDB($select, false);
    }

    Public Function CarregaListaPrestadoresPorCategoria(stdClass $obj) {
        $select = " SELECT U.COD_USUARIO,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           '4,8' AS NOTA_PRESTADOR,
                           U.TXT_EMAIL,
                           U.NRO_TELEFONE,
                           U.DSC_CAMINHO_FOTO,
                           J.HRA_INICIO,
                           J.HRA_FIM,
                           '' AS JORNADA_PRESTADOR,
                           J.DSC_DIAS_ATENDIMENTO
                      FROM SE_USUARIO U
                     INNER JOIN EN_JORNADA_PRESTADOR J
                        ON U.COD_USUARIO = J.COD_PRESTADOR
                     INNER JOIN RE_CATEGORIA_SERVICO_PRESTADOR CSP
                        ON U.COD_USUARIO = CSP.COD_PRESTADOR
                       AND CSP.COD_CATEGORIA = ".$obj->codCategoria."
                     WHERE U.IND_ATIVO = 'S'";
        return $this->selectDB($select, false);
    }

    Public Function UpdateCliente(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Public Function InsertCliente(stdClass $obj) {
        return $this->MontarInsert($obj);
    }
}