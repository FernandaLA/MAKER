<?php
include_once("Dao/BaseDao.php");
class AvaliacaoAgendamentoDao extends BaseDao
{
    Protected $tableName = "EN_AVALIACAO";

    Protected $columns = array ("codUsuario"            => array("column" =>"COD_USUARIO", "typeColumn" =>"I"),
                                "nroNotaAvaliacao"      => array("column" =>"NRO_NOTA_AVALIACAO", "typeColumn" =>"I"),
                                "dscAvaliacao"          => array("column" =>"DSC_AVALIACAO", "typeColumn" =>"S"),
                                "codUsuarioAvaliado"    => array("column" =>"COD_USUARIO_AVALIADO", "typeColumn" =>"I"),
                                "codAgendamento"        => array("column" =>"COD_AGENDAMENTO", "typeColumn" =>"I"));

    Protected $columnKey = array("codAvaliacao"         => array("column" =>"COD_AVALIACAO", "typeColumn" => "I"));

    Public Function AvaliacaoAgendamentoDao() {
        $this->conect();
    }

    Public Function FinalizaAgendamento($codAgendamento) {
        $update = "UPDATE EN_AGENDAMENTO SET COD_STATUS = 4 WHERE COD_AGENDAMENTO =".$codAgendamento;
        return $this->insertDB($update);
    }

    Public Function InsertAvaliacaoAgendamento(stdClass $obj) {
        return $this->MontarInsert($obj);
    }
}