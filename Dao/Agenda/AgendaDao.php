<?php
include_once("Dao/BaseDao.php");
class AgendaDao extends BaseDao
{
    Protected $tableName = "EN_AGENDAMENTO";

    Protected $columns = array ("codPrestador"   => array("column" =>"COD_PRESTADOR", "typeColumn" =>"I"),
                                "codCliente"   => array("column" =>"COD_CLIENTE", "typeColumn" =>"I"),
                                "codServico"   => array("column" =>"COD_SERVICO", "typeColumn" =>"I"),
                                "dtaAgendamento"   => array("column" =>"DTA_AGENDAMENTO", "typeColumn" =>"D"),
                                "dscHorario"   => array("column" =>"DSC_HORARIO", "typeColumn" =>"S"),
                                "codStatus"   => array("column" =>"COD_STATUS", "typeColumn" =>"I"));

    Protected $columnKey = array("codAgendamento"=> array("column" =>"COD_AGENDAMENTO", "typeColumn" => "I"));

    Public Function AgendaDao() {
        $this->conect();
    }

    Public Function ListarAgenda() {
        return $this->MontarSelect();
    }

    Public Function UpdateAgendamento(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Public Function InsertAgendamento(stdClass $obj) {
        return $this->MontarInsert($obj);
    }
}