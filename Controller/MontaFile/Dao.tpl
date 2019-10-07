<?php
include_once("Dao/BaseDao.php");
class #classDao extends BaseDao
{
    Protected $tableName = "#dscTabela";

    Protected $columns = #columns;

    Protected $columnKey = #pk;

    Public Function #classDao() {
        $this->conect();
    }

    Public Function Listar#class() {
        return $this->MontarSelect();
    }

    Public Function Update#class(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Public Function Insert#class(stdClass $obj) {
        return $this->MontarInsert($obj);
    }
}