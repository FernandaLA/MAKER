<?php
include_once("Dao/BaseDao.php");
class UnidadeFederativaDao extends BaseDao
{
    Protected $tableName = "EN_UNIDADE_FEDERATIVA";

    Protected $columns = array ("dscEstado"   => array("column" =>"dsc_estado", "typeColumn" =>"S"));

    Protected $columnKey = array("sglEstado"=> array("column" =>"sgl_estado", "typeColumn" => "S"));

    Public Function UnidadeFederativaDao() {
        $this->conect();
    }

    Public Function ListarUnidadeFederativa() {
        return $this->MontarSelect();
    }
}