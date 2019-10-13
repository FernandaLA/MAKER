<?php
include_once("Dao/Usuario/UsuarioDao.php");
class ValidaPrestadorDao extends UsuarioDao
{

    Public Function ValidaPrestadorDao() {
        $this->conect();
    }

    Public Function ListarPrestadoresPendentes() {
        $select = " SELECT COD_USUARIO,
                           CONCAT(NME_USUARIO, ' ', DSC_SOBRENOME) AS NME_COMPLETO, 
                           NRO_CPF
                      FROM SE_USUARIO
                      WHERE IND_ATIVO = 'N'";
        return $this->selectDB($select, false);
    }

    Public Function UpdateStatusPrestador(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }
}