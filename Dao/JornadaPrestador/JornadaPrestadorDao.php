<?php
include_once("Dao/BaseDao.php");
class JornadaPrestadorDao extends BaseDao
{
    Protected $tableName = "EN_JORNADA_PRESTADOR";

    Protected $columns = array ("codPrestador"   => array("column" =>"COD_PRESTADOR", "typeColumn" =>"I"),
                                "hraInicio"   => array("column" =>"HRA_INICIO", "typeColumn" =>"S"),
                                "hraFim"   => array("column" =>"HRA_FIM", "typeColumn" =>"S"));

    Protected $columnKey = array("codJornadaPrestador"=> array("column" =>"COD_JORNADA_PRESTADOR", "typeColumn" => "I"));

    Public Function JornadaPrestadorDao() {
        $this->conect();
    }

    Public Function CarregaJornadaPrestador($codPrestador) {
        $select = " SELECT COD_JORNADA_PRESTADOR,
                           HRA_INICIO,
                           HRA_FIM
                      FROM EN_JORNADA_PRESTADOR
                     WHERE COD_PRESTADOR =".$codPrestador;
        return $this->selectDB($select, false);
    }

    Public Function ListarDiasJornada($codJornadaPre) {
        $select = " SELECT COD_DIAS_JORNADA_PRESTADOR,
                           COD_DIA,
                           CASE COD_DIA WHEN '1' THEN 'Domingo'
                                        WHEN '2' THEN 'Segunda'
                                        WHEN '3' THEN 'Terça'
                                        WHEN '4' THEN 'Quarta'
                                        WHEN '5' THEN 'Quinta'
                                        WHEN '6' THEN 'Sexta'
                                        WHEN '7' THEN 'Sábado'
                            END AS DSC_DIA
                      FROM EN_DIAS_JORNADA_PRESTADOR
                     WHERE COD_JORNADA_PRESTADOR =".$codJornadaPre;
        return $this->selectDB($select, false);
    }

    Public Function UpdateJornadaPrestador(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Public Function VerificaJornadaPrestador() {
        $codPrestador = $_SESSION['cod_usuario'];
        $select = " SELECT COD_JORNADA_PRESTADOR
                      FROM EN_JORNADA_PRESTADOR
                     WHERE COD_PRESTADOR = ".$codPrestador;
        return $this->selectDB($select, false);
    }

    Public Function InsertJornadaPrestador(stdClass $obj) {
        $codJornadaPrestador = $this->CatchUltimoCodigo('EN_JORNADA_PRESTADOR', 'COD_JORNADA_PRESTADOR');
        $obj->codPrestador = $_SESSION['cod_usuario'];
        return $this->MontarInsert($obj);
    }

    Public Function InsertDiasJornada($codJornadaPrestador, $codDia) {
        $insert = "INSERT INTO EN_DIAS_JORNADA_PRESTADOR(COD_JORNADA_PRESTADOR, COD_DIA)
                          VALUES(".$codJornadaPrestador.", ".$codDia.")";
        return $this->insertDB($insert);
    }

    Public Function DeleteDiasJornada($codJornadaPrestador) {
        $delete = "DELETE FROM EN_DIAS_JORNADA_PRESTADOR WHERE COD_JORNADA_PRESTADOR = ".$codJornadaPrestador;
        return $this->insertDB($delete);
    }
}