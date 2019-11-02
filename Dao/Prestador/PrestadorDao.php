<?php
include_once("Dao/Usuario/UsuarioDao.php");
class PrestadorDao extends UsuarioDao
{

    Public Function PrestadorDao() {
        $this->conect();
    }

    Public Function ListarPrestador() {
        return $this->MontarSelect();
    }

    Public Function ListarServicosFuturos() {
        $select = " SELECT A.COD_AGENDAMENTO,
                           A.COD_CLIENTE AS COD_USUARIO_REF,
                           CONCAT(U.NME_USUARIO, '', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                       --    '4,8' AS NOTA_PRESTADOR,
                           U.DSC_CAMINHO_FOTO,
                           A.DSC_HORARIO,
                           A.DTA_AGENDAMENTO,
                           A.COD_SERVICO,
                           SP.COD_CATEGORIA,
                           CS.DSC_CATEGORIA,
                           SP.DSC_SERVICO,
                           SP.VLR_SERVICO
                      FROM EN_AGENDAMENTO A
                     INNER JOIN SE_USUARIO U
                        ON A.COD_CLIENTE = U.COD_USUARIO
                     INNER JOIN EN_SERVICO_PRESTADOR SP
                        ON A.COD_SERVICO = SP.COD_SERVICO_PRESTADOR
                     INNER JOIN EN_CATEGORIA_SERVICO CS
                        ON SP.COD_CATEGORIA = CS.COD_CATEGORIA
                      FROM EN_AGENDAMENTO A
                     WHERE A.COD_STATUS = 2
                       AND A.DTA_AGENDAMENTO >= NOW(DATE)
                       AND A.DSC_HORARIO > NOW()
                       AND COD_PRESTADOR =".$codUsuario."
                     ORDER BY A.DTA_AGENDAMENTO, A.DSC_HORARIO";
        return $this->selectDB($select, false);
    }
    
    Public Function UpdatePrestador(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }
    
    Public Function InsertPrestador(stdClass $obj) {
        $obj->codUsuario = $this->CatchUltimoCodigo('SE_USUARIO', 'COD_USUARIO');
        $obj->indAtivo = "N";
        $obj->txtSenha = md5($obj->txtSenha);
        return $this->MontarInsert($obj);
    }

    Public Function InsertCategoriaServicoPrestador($codPrestador, $codCategoria) {
        $insert = "INSERT INTO RE_CATEGORIA_SERVICO_PRESTADOR(COD_PRESTADOR, COD_CATEGORIA)
                          VALUES(".$codPrestador.", ".$codCategoria.")";
        return $this->insertDB($insert);
    }

    Public Function DeleteCategoriaServicoPrestador($codPrestador) {
        $delete = "DELETE FROM RE_CATEGORIA_SERVICO_PRESTADOR WHERE COD_PRESTADOR = ".$codPrestador;
        return $this->insertDB($delete);
    }

    Public Function CarregaDadosPrestador($codUsuario) {
        $select = " SELECT U.NME_USUARIO,
                           U.DSC_SOBRENOME,
                           CONCAT(U.NME_USUARIO, ' ', COALESCE(U.DSC_SOBRENOME, '')) AS NME_USUARIO_COMPLETO,
                           U.DTA_NASCIMENTO,
                           U.NRO_CPF,
                           U.TXT_EMAIL,
                           U.NRO_TELEFONE,
                           U.NRO_CEP,
                           U.DSC_LOGRADOURO,
                           U.DSC_COMPLEMENTO_ENDERECO,
                           U.DSC_BAIRRO,
                           U.DSC_CIDADE,
                           U.SGL_UF,
                           CONCAT(COALESCE(U.DSC_LOGRADOURO, ''), ' ',
                                  COALESCE(U.DSC_COMPLEMENTO_ENDERECO, ''), ' ',
                                  COALESCE(U.DSC_BAIRRO, ''), ' ',
                                  COALESCE(U.DSC_CIDADE, ''), ' ',
                                  COALESCE(U.SGL_UF, '')) AS ENDERECO_COMPLETO,
                           U.DSC_CAMINHO_FOTO,
                           U.DSC_CAMINHO_CERTIFICADO,
                           J.COD_JORNADA_PRESTADOR,
                           J.HRA_INICIO,
                           J.HRA_FIM
                      FROM SE_USUARIO U
                      LEFT JOIN EN_JORNADA_PRESTADOR J
                        ON U.COD_USUARIO = J.COD_PRESTADOR
                     WHERE COD_USUARIO =". $codUsuario;
        
        return $this->selectDB($select, false);
    }
}