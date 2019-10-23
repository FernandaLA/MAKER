<?php
include_once("Dao/Menu/MenuDao.php");
class MenuPrincipalDao extends MenuDao
{
    function MenuPrincipalDao() {
        $this->conect();
    }

    public function CarregaMenuNew($codUsuario, $path) {
        try {
            $select = " SELECT DSC_MENU,
                               M.COD_MENU,
                               NME_CONTROLLER,
                               CONCAT('" . $path . "','/Controller/',NME_CONTROLLER) AS NME_PATH,
                               NME_METHOD,
                               M.COD_MENU_PAI,
                               TXT_SENHA,
                               '250px' AS VLR_TAMANHO_SUBMENU,
                                CONCAT('<span class=\"icon oi ',DSC_CAMINHO_IMAGEM,'\"><strong style=\"font-size:16px\">',' ', M.DSC_MENU, ' </strong></span>') AS LABEL
                            --     --    CONCAT('<ion-icon md=\"',DSC_CAMINHO_IMAGEM,'\" size=\"large\"></ion-icon><span ') AS IMG 
                          FROM SE_MENU M
                         INNER JOIN SE_MENU_PERFIL MP
                            ON M.COD_MENU = MP.COD_MENU
                         INNER JOIN SE_USUARIO U
                            ON MP.COD_PERFIL = U.COD_PERFIL
                         WHERE COD_USUARIO = $codUsuario
                           AND M.IND_ATIVO = 'S'
                           AND IND_VISIBLE = 'S'
                         ORDER BY DSC_MENU";
                        //  echo $select;
            $rs_localiza = $this->selectDB($select, false);
        } catch (Exception $e) {
            echo "erro" . $e;
        }
        return $rs_localiza;
    }

    public function CarregaController($codMenu, $path) {
        try {
            $select = " SELECT NME_CONTROLLER,
                               NME_METHOD
                          FROM SE_MENU M
                         WHERE M.COD_MENU = $codMenu";
            $rs_localiza = $this->selectDB("$select");
        } catch (Exception $e) {
            echo "erro" . $e;
        }
        return $rs_localiza;
    }

    public function CarregaDadosUsuario($codUsuario) {
        $select = "SELECT COD_USUARIO,
                          NME_USUARIO,
                          NRO_CPF,
                          COD_PERFIL
                     FROM SE_USUARIO
                    WHERE COD_USUARIO = $codUsuario";
        return $this->selectDB($select, false);
    }
}
?>
