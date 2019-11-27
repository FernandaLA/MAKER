<?php
include_once("Dao/Agenda/AgendaDao.php");
class ServicoFinalizadoDao extends AgendaDao
{

    Public Function ServicoFinalizadoDao() {
        $this->conect();
    }

    Public Function ListarServicoFinalizadoPrestador($codUsuario) {
        $select = " SELECT A.COD_AGENDAMENTO,
                           A.COD_CLIENTE AS COD_USUARIO_REF,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
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
                           'Realizado' AS SITUACAO
                      FROM EN_AGENDAMENTO A
                     INNER JOIN SE_USUARIO U
                        ON A.COD_CLIENTE = U.COD_USUARIO
                     INNER JOIN EN_SERVICO_PRESTADOR SP
                        ON A.COD_SERVICO = SP.COD_SERVICO_PRESTADOR
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     WHERE A.COD_STATUS = 2
                       AND CONCAT(A.DTA_AGENDAMENTO, ' ', A.DSC_HORARIO) < NOW()
                       AND A.COD_PRESTADOR =".$codUsuario."
                    UNION 
                    SELECT A.COD_AGENDAMENTO,
                           A.COD_CLIENTE AS COD_USUARIO_REF,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
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
                           'Finalizado' AS SITUACAO
                      FROM EN_AGENDAMENTO A
                     INNER JOIN SE_USUARIO U
                        ON A.COD_CLIENTE = U.COD_USUARIO
                     INNER JOIN EN_SERVICO_PRESTADOR SP
                        ON A.COD_SERVICO = SP.COD_SERVICO_PRESTADOR
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     WHERE A.COD_STATUS = 4
                       AND CONCAT(A.DTA_AGENDAMENTO, ' ', A.DSC_HORARIO) < NOW()
                       AND A.COD_PRESTADOR =".$codUsuario."
                    UNION
                    SELECT A.COD_AGENDAMENTO,
                           A.COD_CLIENTE AS COD_USUARIO_REF,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
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
                           'Cancelado' AS SITUACAO
                      FROM EN_AGENDAMENTO A
                     INNER JOIN SE_USUARIO U
                        ON A.COD_CLIENTE = U.COD_USUARIO
                     INNER JOIN EN_SERVICO_PRESTADOR SP
                        ON A.COD_SERVICO = SP.COD_SERVICO_PRESTADOR
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     WHERE A.COD_STATUS = 5
                       AND CONCAT(A.DTA_AGENDAMENTO, ' ', A.DSC_HORARIO) < NOW()
                       AND A.COD_PRESTADOR =".$codUsuario;
        return $this->selectDB($select, false);
    }

    Public Function ListarServicoFinalizadoCliente($codUsuario) {
        $select = " SELECT A.COD_AGENDAMENTO,
                           A.COD_PRESTADOR AS COD_USUARIO_REF,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                   --       '4,8' AS NOTA_PRESTADOR,
                           U.DSC_CAMINHO_FOTO,
                           A.DSC_HORARIO,
                           A.DTA_AGENDAMENTO,
                           A.COD_SERVICO,
                           SP.COD_CATEGORIA,
                           CASE WHEN SP.COD_CATEGORIA = 1 THEN 'Depilação'
                           ELSE CS.DSC_CATEGORIA
                           END AS DSC_CATEGORIA,
                           SP.DSC_SERVICO,
                           SP.VLR_SERVICO
                      FROM EN_AGENDAMENTO A
                     INNER JOIN SE_USUARIO U
                        ON A.COD_PRESTADOR = U.COD_USUARIO
                     INNER JOIN EN_SERVICO_PRESTADOR SP
                        ON A.COD_SERVICO = SP.COD_SERVICO_PRESTADOR
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     WHERE A.COD_STATUS IN (2,4,5)
                       AND CONCAT(A.DTA_AGENDAMENTO, ' ', A.DSC_HORARIO) < NOW()
                       AND A.COD_CLIENTE =".$codUsuario;
        return $this->selectDB($select, false);
    }
}