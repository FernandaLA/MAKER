<?php
include_once("Dao/BaseDao.php");
class MenuDao extends BaseDao
{
    Protected $tableName = "SE_MENU";

    Protected $columns = array ("dscMenu"           => array("column" =>"DSC_MENU", "typeColumn" =>"S"),
                                "nmeController"     => array("column" =>"NME_CONTROLLER", "typeColumn" =>"S"),
                                "codMenuPai"        => array("column" =>"COD_MENU_PAI", "typeColumn" =>"I"),
                                "nmeMethod"         => array("column" =>"NME_METHOD", "typeColumn" =>"S"),
                                "indAtalho"         => array("column" =>"IND_ATALHO", "typeColumn" =>"S"),
                                "dscCaminhoImagem"  => array("column" =>"DSC_CAMINHO_IMAGEM", "typeColumn" =>"S"),
                                "indVisible"        => array("column" =>"IND_VISIBLE", "typeColumn" =>"S"),
                                "indAtivo"          => array("column" =>"IND_ATIVO", "typeColumn" =>"S"));

    Protected $columnKey = array("codMenu"      => array("column" =>"COD_MENU", "typeColumn" => "I"));
    
    function MenuDao() {
        $this->conect();
    }

    /**
     * Retorna uma lista de menus
     * @return array
     */
    function ListaMenus() {
        try {
            $select = " SELECT COD_MENU,
                               COD_MENU AS COD,
                               DSC_MENU,
                               DSC_MENU AS DSC
                          FROM SE_MENU
                         WHERE COD_MENU_PAI > -1 
                           AND IND_VISIBLE = 'S'
                        UNION
                        SELECT '0' AS COD_MENU,
                               '0' AS COD,
                               'Sem Pai' AS DSC_MENU,
                               'Sem Pai' AS DSC
                         ORDER BY DSC_MENU";
            $lista = $this->selectDB("$select", false);
        } catch (Exception $e) {
            echo "erro" . $e;
        }
        return $lista;
    }

    public function ListarMenusGrid() {
        try {
            $select = " SELECT M.COD_MENU,
                               M.COD_MENU AS ID,
                               M.DSC_MENU,
                               M.DSC_MENU AS DSC,
                               M.NME_CONTROLLER,
                               M.NME_METHOD,
                               M.IND_ATIVO,
                               M.IND_VISIBLE,
                               M.COD_MENU_PAI,
                               COALESCE(M1.DSC_MENU, '- - - - - - -') AS DSC_MENU_PAI,
                               COALESCE(M.IND_ATALHO,'N') AS IND_ATALHO,
                               COALESCE(M.DSC_CAMINHO_IMAGEM, '') AS DSC_CAMINHO_IMAGEM,
                               (SELECT COUNT(*)
                                  FROM SE_MENU
                                 WHERE COD_MENU > 0
                                   AND COD_MENU_PAI = M.COD_MENU) AS QTD
                          FROM SE_MENU M
                          LEFT JOIN SE_MENU M1
                            ON M.COD_MENU_PAI = M1.COD_MENU
                         WHERE M.COD_MENU_PAI >= 0";
            $lista = $this->selectDB("$select", false);
        } catch (Exception $e) {
            echo "erro" . $e;
        }
        return $lista;
    }

    function AddMenu() {
        $insert = " INSERT INTO SE_MENU (
                                COD_MENU, DSC_MENU,
                                NME_CONTROLLER, IND_ATIVO,
                                COD_MENU_PAI, NME_METHOD,
                                DSC_CAMINHO_IMAGEM, IND_ATALHO, IND_VISIBLE) 
                       VALUES (
                              " .$this->CatchUltimoCodigo('SE_MENU', 'COD_MENU'). ", "
                              . "'" .filter_input(INPUT_POST, 'dscMenu', FILTER_SANITIZE_MAGIC_QUOTES). "', "
                              . "'" .filter_input(INPUT_POST, 'nmeController', FILTER_SANITIZE_MAGIC_QUOTES). "', "
                              . "'" .filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_MAGIC_QUOTES). "', "
                              . filter_input(INPUT_POST, 'codMenuPai', FILTER_SANITIZE_NUMBER_INT). ", "
                              . "'" .filter_input(INPUT_POST, 'nmeMethod', FILTER_SANITIZE_MAGIC_QUOTES). "', "
                              . "'" .filter_input(INPUT_POST, 'dscCaminhoImagem', FILTER_SANITIZE_MAGIC_QUOTES). "', "
                              . "'" .filter_input(INPUT_POST, 'indAtalho', FILTER_SANITIZE_MAGIC_QUOTES). "', "
                              . "'" .filter_input(INPUT_POST, 'indVisible', FILTER_SANITIZE_MAGIC_QUOTES). "') ";
        $result = $this->insertDB("$insert");
        $result[2] = $insert;
        return $result;

    }

    function UpdateMenu() {
        $update = " UPDATE SE_MENU 
                       SET DSC_MENU = '" . filter_input(INPUT_POST, 'dscMenu', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                           NME_CONTROLLER = '" . filter_input(INPUT_POST, 'nmeController', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                           IND_ATIVO = '" . filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                           COD_MENU_PAI = " . filter_input(INPUT_POST, 'codMenuPai', FILTER_SANITIZE_NUMBER_INT) . ",
                           NME_METHOD = '" . filter_input(INPUT_POST, 'nmeMethod', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                           DSC_CAMINHO_IMAGEM = '" . filter_input(INPUT_POST, 'dscCaminhoImagem', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                           IND_ATALHO = '" . filter_input(INPUT_POST, 'indAtalho', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                           IND_VISIBLE = '" . filter_input(INPUT_POST, 'indVisible', FILTER_SANITIZE_MAGIC_QUOTES) . "'
                     WHERE COD_MENU = " . filter_input(INPUT_POST, 'codMenu', FILTER_SANITIZE_NUMBER_INT);
        $result = $this->insertDB("$update", false);
        return $result;

    }

    function DeleteMenu() {
        $delete = " DELETE FROM SE_MENU
                          WHERE COD_MENU = " . filter_input(INPUT_POST, 'codMenu', FILTER_SANITIZE_NUMBER_INT);
        $result = $this->insertDB("$delete", false);
        return $result;

    }

}
?>
