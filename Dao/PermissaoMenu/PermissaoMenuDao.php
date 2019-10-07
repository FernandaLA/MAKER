<?php
include_once("Dao/BaseDao.php");
class PermissaoMenuDao extends BaseDao
{
    Protected $tableName = "SE_MENU_PERFIL";

    Protected $columns = array ("codPerfil" => array("column" =>"COD_PERFIL", "typeColumn" =>"I"),
                                "codMenu"   => array("column" =>"COD_MENU", "typeColumn" =>"I"));
    
    function PermissaoMenuDao() {
        $this->conect();
    }

    function ListarPerfil() {
        $select = "SELECT COD_PERFIL,
                          DSC_PERFIL
                     FROM SE_PERFIL";
        $lista = $this->selectDB("$select", false);
        return $lista;
    }

    function ListarMenus() {        
        try{
            $select = " SELECT M.DSC_MENU,
                               M.COD_MENU,
                               MP.DSC_MENU AS DSC_MENU_PAI,
                               (SELECT DSC_PERFIL
                                  FROM SE_PERFIL P
                                 INNER JOIN SE_MENU_PERFIL MP
                                    ON P.COD_PERFIL = MP.COD_PERFIL
                                 WHERE MP.COD_MENU = M.COD_MENU
                                   AND P.COD_PERFIL = " .filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT). ") AS PERFIL
                          FROM SE_MENU M
                          LEFT JOIN SE_MENU MP
                            ON M.COD_MENU_PAI = MP.COD_MENU
                         WHERE M.IND_ATIVO = 'S'
                         ORDER BY DSC_MENU_PAI, M.DSC_MENU";
            $lista = $this->selectDB("$select", false);
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $lista;
    }

    Function AtualizaPermissoes() {        
        try{
            $select = " SELECT M.DSC_MENU,
                               M.COD_MENU,
                               (SELECT DSC_PERFIL
                                  FROM SE_PERFIL P
                                 INNER JOIN SE_MENU_PERFIL MP
                                    ON P.COD_PERFIL = MP.COD_PERFIL
                                 WHERE MP.COD_MENU = M.COD_MENU
                                   AND P.COD_PERFIL = ".filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT).") AS PERFIL
                          FROM SE_MENU M
                         WHERE M.IND_ATIVO = 'S'";
            $lista = $this->selectDB("$select", false);
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $lista;

    }

    function RemovePermissoes( $codMenu ) {        
        $delete = " DELETE FROM SE_MENU_PERFIL
                          WHERE COD_PERFIL = ".filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT);
        if ($codMenu!=0){
            $delete .=  " AND COD_MENU = $codMenu";
        }        
        $result = $this->insertDB("$delete");
        return $result;
    }

    function AddPermissao( $codMenu ) {        
        $insert = "INSERT INTO SE_MENU_PERFIL (COD_PERFIL, COD_MENU)
                        VALUES (
                               ".filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT).",
                               $codMenu)";
        return $this->insertDB("$insert");
    }
}
?>
