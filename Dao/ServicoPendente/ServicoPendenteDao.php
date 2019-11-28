<?php
include_once("Dao/Agenda/AgendaDao.php");
class ServicoPendenteDao extends AgendaDao
{

    Public Function ServicoPendenteDao() {
        $this->conect();
    }

    Public Function ListarServicoPendentePrestador($codUsuario) {
        $select = " SELECT A.COD_AGENDAMENTO,
                           A.COD_CLIENTE AS COD_USUARIO_REF,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           (SELECT FORMAT(COALESCE(SUM(AA.NRO_NOTA_AVALIACAO)/COUNT(AA.NRO_NOTA_AVALIACAO), 0), 1)
                             FROM EN_AVALIACAO AA
                            WHERE AA.COD_USUARIO_AVALIADO = U.COD_USUARIO) AS NOTA_AVALIACAO,
                        --    '4,8' AS NOTA_PRESTADOR,
                           U.DSC_CAMINHO_FOTO,
                           A.DSC_HORARIO,
                           A.DTA_AGENDAMENTO,
                           A.COD_SERVICO,
                           SP.COD_CATEGORIA,
                           CS.DSC_CATEGORIA,
                           SP.DSC_SERVICO,
                           SP.VLR_SERVICO,
                           CONCAT(COALESCE(U.DSC_LOGRADOURO, ''), ' ',
                                  COALESCE(U.DSC_COMPLEMENTO_ENDERECO, ''), ' ',
                                  COALESCE(U.DSC_BAIRRO, ''), ' ',
                                  COALESCE(U.DSC_CIDADE, ''), ' ',
                                  COALESCE(U.SGL_UF, '')) AS ENDERECO_COMPLETO,
                           'PendentePre' AS SITUACAO,
                           A.COD_STATUS
                      FROM EN_AGENDAMENTO A
                     INNER JOIN SE_USUARIO U
                        ON A.COD_CLIENTE = U.COD_USUARIO
                     INNER JOIN EN_SERVICO_PRESTADOR SP
                        ON A.COD_SERVICO = SP.COD_SERVICO_PRESTADOR
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     WHERE A.COD_STATUS = 1
                       AND A.COD_PRESTADOR =".$codUsuario;
        return $this->selectDB($select, false);
    }

    Public Function ListarServicoPendenteCliente($codUsuario) {
        $select = " SELECT A.COD_AGENDAMENTO,
                           A.COD_PRESTADOR AS COD_USUARIO_REF,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           (SELECT FORMAT(COALESCE(SUM(AA.NRO_NOTA_AVALIACAO)/COUNT(AA.NRO_NOTA_AVALIACAO), 0), 1)
                             FROM EN_AVALIACAO AA
                            WHERE AA.COD_USUARIO_AVALIADO = U.COD_USUARIO) AS NOTA_AVALIACAO,
                        --   '4,8' AS NOTA_PRESTADOR,
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
                           CONCAT(COALESCE(AC.DSC_LOGRADOURO, ''), ' ',
                                  COALESCE(AC.DSC_COMPLEMENTO_ENDERECO, ''), ' ',
                                  COALESCE(AC.DSC_BAIRRO, ''), ' ',
                                  COALESCE(AC.DSC_CIDADE, ''), ' ',
                                  COALESCE(AC.SGL_UF, '')) AS ENDERECO_COMPLETO,
                           'PendenteCli' AS SITUACAO,
                           A.COD_STATUS
                      FROM EN_AGENDAMENTO A
                     INNER JOIN SE_USUARIO U
                        ON A.COD_PRESTADOR = U.COD_USUARIO
                     INNER JOIN EN_SERVICO_PRESTADOR SP
                        ON A.COD_SERVICO = SP.COD_SERVICO_PRESTADOR
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     INNER JOIN SE_USUARIO AC
                        ON A.COD_CLIENTE = AC.COD_USUARIO
                     WHERE A.COD_STATUS = 1
                       AND COD_CLIENTE =".$codUsuario;
        return $this->selectDB($select, false);
    }
}