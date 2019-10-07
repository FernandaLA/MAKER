<?php
include_once("Dao/BaseDao.php");
class PerfilDao extends BaseDao
{
    Protected $tableName = "SE_PERFIL";

    Protected $columns = array ("dscPerfil"           => array("column" =>"DSC_PERFIL", "typeColumn" =>"S"),
                                "indAtivo"          => array("column" =>"IND_ATIVO", "typeColumn" =>"S"));

    Protected $columnKey = array("codPerfil"      => array("column" =>"COD_PERFIL", "typeColumn" => "I"));
    
    function PerfilDao() {
        $this->conect();
    }

    function ListarPerfilAtivo() {
        $select = " SELECT COD_PERFIL as COD,
                           DSC_PERFIL as DSC
                      FROM SE_PERFIL 
                     WHERE IND_ATIVO = 'S'
                UNION
                    SELECT 0 as COD,
                           '(Selecione)' as DSC";        
        return $this->selectDB("$select", false);
    }

    /**
     * Retorna uma Lista de perfis
     * Utilizado no PerfilModel
     * @return Array
     */
    function ListarPerfil() {
        $select = " SELECT COD_PERFIL, 
                           DSC_PERFIL,
                           IND_ATIVO
                      FROM SE_PERFIL";
        return $this->selectDB("$select", false);
    }       

    /** Insere um perfil no banco de dados
     * Utilizado no PerfilModel
     * @return int
     */
    Public Function AddPerfil() {        
        $codPerfil = $this->CatchUltimoCodigo('SE_PERFIL', 'COD_PERFIL');
        $insert = " INSERT INTO SE_PERFIL (
                            COD_PERFIL,
                            DSC_PERFIL,
                            IND_ATIVO)
                    VALUES (
                            $codPerfil,
                            '" .filter_input(INPUT_POST, 'dscPerfil', FILTER_SANITIZE_MAGIC_QUOTES). "',
                            '" .filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_MAGIC_QUOTES). "')";
        return $this->insertDB($insert);
    }

    /**
     * Atualiza um perfil no banco de dados
     * Utilizado no PerfilModel
     * @return int
     */
    Public Function UpdatePerfil() {
        $update = " UPDATE SE_PERFIL
                       SET DSC_PERFIL = '" .filter_input(INPUT_POST, 'dscPerfil', FILTER_SANITIZE_STRING). "',
                           IND_ATIVO    = '" .filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_MAGIC_QUOTES). "'
                     WHERE COD_PERFIL = " .filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($update);
    }
    
    Public Function RetornaPerfilUsuarioLogado( $codUsuario ) {
        $select = " SELECT COD_PERFIL
                      FROM SE_USUARIO 
                     WHERE COD_USUARIO = $codUsuario";
        return $this->selectDB("$select", false);        
    }

}
?>
