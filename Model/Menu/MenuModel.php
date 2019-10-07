<?php
include_once("Model/BaseModel.php");
include_once("Dao/Menu/MenuDao.php");
include_once("Resources/php/FuncoesArray.php");
class MenuModel extends BaseModel
{
    /**
     * Carrega Lista de menus
     * @param type $nmeLogin
     * @param type $txtSenha
     * @return type
     */
    function ListaMenus(){
        $dao = new MenuDao();
        return json_encode($dao->ListaMenus());
    }

    function AddMenu(){
        $dao = new MenuDao();
        return json_encode($dao->AddMenu());
    }

    function UpdateMenu(){
        $dao = new MenuDao();
        return json_encode($dao->UpdateMenu());
    }

    function DeleteMenu(){
        $dao = new MenuDao();
        return json_encode($dao->DeleteMenu());
    }

    function ListarMenusGrid(){
        $dao = new MenuDao();
        $lista = $dao->ListarMenusGrid();
        if ($lista[0]){
            $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
            $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATALHO', 'ATALHO');
            $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_VISIBLE', 'VISIBLE');
        }
        return json_encode($lista);
    }
}
?>
