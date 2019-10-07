<?php
include_once("Model/Menu/MenuModel.php");
include_once("Dao/MenuPrincipal/MenuPrincipalDao.php");
include_once("Resources/php/FuncoesArray.php");
include_once("Resources/php/FuncoesMoeda.php");

class MenuPrincipalModel extends MenuModel
{
    function MenuPrincipalModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    function CarregaMenuNew($path){
        $dao = new MenuPrincipalDao();
        $listaAtualizada = $dao->CarregaMenuNew($_SESSION['cod_usuario'], $path);
//        $listaAtualizada = FuncoesArray::RecursiveArrayUtf8Encode($listaAtualizada);
        return json_encode($listaAtualizada);
    }

    function CarregaController($codMenu, $path){
        $dao = new MenuPrincipalDao();
        $controller = $dao->CarregaController($codMenu, $path);
        if ($controller->NME_METHOD!=''){
            return json_encode($controller->NME_CONTROLLER."?method=".$rs_localiza->NME_METHOD);
        }else{
            return json_encode('#');
        }
    }

    Public Function CarregaDadosUsuario(){
        $dao = new MenuPrincipalDao();
        $lista = $dao->CarregaDadosUsuario($_SESSION['cod_usuario']);
        $_SESSION['dadosUsuario'] = $lista[1][0];
        return json_encode($lista);
    }
}
?>
