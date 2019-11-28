<?php
include_once("Dao/BaseDao.php");
class AgendaDao extends BaseDao
{
    Protected $tableName = "EN_AGENDAMENTO";

    Protected $columns = array ("codPrestador"   => array("column" =>"COD_PRESTADOR", "typeColumn" =>"I"),
                                "codCliente"   => array("column" =>"COD_CLIENTE", "typeColumn" =>"I"),
                                "codServico"   => array("column" =>"COD_SERVICO", "typeColumn" =>"I"),
                                "dtaAgendamento"   => array("column" =>"DTA_AGENDAMENTO", "typeColumn" =>"S"),
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

    Public Function BuscaJornadaPrestador($codPrestador) {
        $select = " SELECT COD_JORNADA_PRESTADOR,
                           HRA_INICIO,
                           HRA_FIM
                      FROM EN_JORNADA_PRESTADOR
                     WHERE COD_PRESTADOR =".$codPrestador;
        return $this->selectDB($select, false);
    }

    Public Function BuscaDiasJornadaPrestador($codJornada) {
        $select= " SELECT COD_DIA
                     FROM EN_DIAS_JORNADA_PRESTADOR
                    WHERE COD_JORNADA_PRESTADOR = ".$codJornada;
        return $this->selectDB($select, false);
    }

    Public Function BuscaHorariosOcupados($codPrestador, $dtaAgendamento) {
        $select = " SELECT DSC_HORARIO
                      FROM EN_AGENDAMENTO
                     WHERE DTA_AGENDAMENTO = '". $dtaAgendamento ."'
                       AND COD_PRESTADOR =". $codPrestador."
                       AND COD_STATUS = 2
                     GROUP BY DSC_HORARIO";
        return $this->selectDB($select, false);
    }

    Public Function ListarServicosFuturos($codUsuario) {
        $select = " SELECT A.COD_AGENDAMENTO,
                           A.COD_CLIENTE AS COD_USUARIO_REF,
                           CONCAT(U.NME_USUARIO, '', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           (SELECT FORMAT(COALESCE(SUM(AA.NRO_NOTA_AVALIACAO)/COUNT(AA.NRO_NOTA_AVALIACAO), 0), 1)
                             FROM EN_AVALIACAO AA
                            WHERE AA.COD_USUARIO_AVALIADO = U.COD_USUARIO) AS NOTA_AVALIACAO,
                       --    '4,8' AS NOTA_PRESTADOR,
                           U.DSC_CAMINHO_FOTO,
                           A.DSC_HORARIO,
                           A.DTA_AGENDAMENTO,
                           A.COD_SERVICO,
                           SP.COD_CATEGORIA,
                           CASE WHEN SP.COD_CATEGORIA = 1 THEN 'Depilação'
                                ELSE CS.DSC_CATEGORIA
                           END AS DSC_CATEGORIA,
                           SP.DSC_SERVICO,
                           SP.VLR_SERVICO,
                           CONCAT(COALESCE(U.DSC_LOGRADOURO, ''), ' ',
                                  COALESCE(U.DSC_COMPLEMENTO_ENDERECO, ''), ' ',
                                  COALESCE(U.DSC_BAIRRO, ''), ' ',
                                  COALESCE(U.DSC_CIDADE, ''), ' ',
                                  COALESCE(U.SGL_UF, '')) AS ENDERECO_COMPLETO,
                           'Confirmado' AS SITUACAO,
                           A.COD_STATUS
                        --    CASE WHEN A.COD_STATUS = 2 AND A.DTA_AGENDAMENTO < CURRENT_DATE()
                        --         THEN 'Realizado'
                        --         WHEN A.COD_STATUS = 2 AND A.DTA_AGENDAMENTO = CURRENT_DATE() AND A.DSC_HORARIO+SP.TMP_DURACAO_SERVICO < NOW()
                        --         THEN 'Realizado'
                        --    ELSE SA.DSC_STATUS
                        --    END AS SITUACAO
                      FROM EN_AGENDAMENTO A
                     INNER JOIN SE_USUARIO U
                        ON A.COD_CLIENTE = U.COD_USUARIO
                     INNER JOIN EN_SERVICO_PRESTADOR SP
                        ON A.COD_SERVICO = SP.COD_SERVICO_PRESTADOR
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     INNER JOIN EN_STATUS_AGENDAMENTO SA
                        ON A.COD_STATUS = SA.COD_STATUS
                     WHERE A.COD_STATUS = 2
                       AND CONCAT(A.DTA_AGENDAMENTO, ' ', A.DSC_HORARIO) >= NOW()
                       AND A.COD_PRESTADOR =".$codUsuario."
                     ORDER BY A.DTA_AGENDAMENTO, A.DSC_HORARIO";
        return $this->selectDB($select, false);
    }
}
