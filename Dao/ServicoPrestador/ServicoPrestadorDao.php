<?php
include_once("Dao/BaseDao.php");
class ServicoPrestadorDao extends BaseDao
{
    Protected $tableName = "EN_SERVICO_PRESTADOR";

    Protected $columns = array ("codCategoria"   => array("column" =>"COD_CATEGORIA", "typeColumn" =>"I"),
                                "dscServico"   => array("column" =>"DSC_SERVICO", "typeColumn" =>"S"),
                                "vlrServico"   => array("column" =>"VLR_SERVICO", "typeColumn" =>"S"),
                                "tmpDuracaoServico"   => array("column" =>"TMP_DURACAO_SERVICO", "typeColumn" =>"S"),
                                "codPrestador"   => array("column" =>"COD_PRESTADOR", "typeColumn" =>"I"),
                                "indAtivo"   => array("column" =>"IND_ATIVO", "typeColumn" =>"S"));

    Protected $columnKey = array("codServicoPrestador"=> array("column" =>"COD_SERVICO_PRESTADOR", "typeColumn" => "I"));

    Public Function ServicoPrestadorDao() {
        $this->conect();
    }

    Public Function ListarServicoPrestador($codUsuario) {
        $select = " SELECT SP.COD_SERVICO_PRESTADOR,
                           SP.COD_CATEGORIA,
                           CS.DSC_CATEGORIA,
                           SP.DSC_SERVICO,
                           SP.VLR_SERVICO,
                           SP.TMP_DURACAO_SERVICO,
                           CONCAT('<span class=\"icon-acao-servico oi oi-pencil\" onclick=\"javascript: EditarServico(', SP.COD_SERVICO_PRESTADOR,',',SP.COD_CATEGORIA,',\'',SP.DSC_SERVICO,'\',\'',SP.VLR_SERVICO,'\',\'',SP.TMP_DURACAO_SERVICO,'\')\"></span>&nbsp;&nbsp;&nbsp;<span class=\"icon-acao-servico oi oi-trash\" onclick=\"javascript: ExcluirServico(',SP.COD_SERVICO_PRESTADOR,')\"></span>') AS ACAO
                      FROM EN_SERVICO_PRESTADOR SP
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     WHERE SP.COD_PRESTADOR =". $codUsuario ."
                       AND SP.IND_ATIVO = 'S'";
                    //    echo $select; die;
        return $this->selectDB($select, false);
    }

    Public Function UpdateServicoPrestador(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Public Function InsertServicoPrestador(stdClass $obj) {
        return $this->MontarInsert($obj);
    }

    Public Function ListarServicoAtivoPrestador($codUsuario) {
        $select = " SELECT SP.COD_SERVICO_PRESTADOR AS COD,
                           CONCAT(CS.DSC_CATEGORIA, ' - ', SP.DSC_SERVICO, ' - ', SP.VLR_SERVICO) AS DSC
                      FROM EN_SERVICO_PRESTADOR SP
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                     WHERE SP.COD_PRESTADOR =". $codUsuario ."
                       AND SP.IND_ATIVO = 'S'";
                    //    echo $select; die;
        return $this->selectDB($select, false);
    }
}