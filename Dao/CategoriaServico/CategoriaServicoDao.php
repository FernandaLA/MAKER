<?php
include_once("Dao/BaseDao.php");
class CategoriaServicoDao extends BaseDao
{
    Protected $tableName = "EN_CATEGORIA_SERVICO";

    Protected $columns = array ("dscCategoria"  => array("column" =>"DSC_CATEGORIA", "typeColumn" =>"S"),
                                "indAtivo"      => array("column" =>"IND_ATIVO", "typeColumn" =>"S"));

    Protected $columnKey = array("codCategoria" => array("column" =>"COD_CATEGORIA", "typeColumn" => "I"));

    Public Function CategoriaServicoDao() {
        $this->conect();
    }

    Public Function ListarCategoriaServico() {
        return $this->MontarSelect();
    }

    Public Function ListarCategoriaServicoAtivo() {
        $select = " SELECT COD_CATEGORIA AS COD,
                           DSC_CATEGORIA AS DSC
                      FROM EN_CATEGORIA_SERVICO
                      WHERE IND_ATIVO = 'S'";
        return $this->selectDB($select, false);
    }

    Public Function ListarCategoriaServicoPrestador($codUsuario) {
        $select = " SELECT CS.COD_CATEGORIA AS COD,
                           CS.DSC_CATEGORIA AS DSC
                      FROM EN_CATEGORIA_SERVICO CS
                     INNER JOIN RE_CATEGORIA_SERVICO_PRESTADOR CSP
                        ON CS.COD_CATEGORIA = CSP.COD_CATEGORIA
                     WHERE CSP.COD_PRESTADOR = ".$codUsuario."
                       AND CS.IND_ATIVO = 'S'";
        return $this->selectDB($select, false);
    }

    Public Function UpdateCategoriaServico(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Public Function InsertCategoriaServico(stdClass $obj) {
        return $this->MontarInsert($obj);
    }
}