<?php
include_once("Model/BaseModel.php");
include_once("Dao/PermissaoMenu/PermissaoMenuDao.php");
class PermissaoMenuModel
{
    function PermissaoMenuModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    function ListarPerfil(){
        $dao = new PermissaoMenuDao();
        return $dao->ListarPerfil();
    }

    function ListarMenus($json=false){
        $dao = new PermissaoMenuDao();
        if ($json){
            return json_encode($dao->ListarMenus());
        }else{
            return $dao->ListarMenus();
        }
    }

    function AtualizaPermissoes(){
        $dao = new PermissaoMenuDao();        
        $dao->RemovePermissoes('0');
        $array = explode("P", $_POST['C']);
        for ($i=0;$i<count($array)-1;$i++){
            $registro=explode('=>',$array[$i]);            
            if ($registro[1]=='S'){
                $atualizado = $dao->AddPermissao($registro[0]);
            }else{
                $atualizado = $dao->RemovePermissoes($registro[0]);
            }
        }
        return json_encode($atualizado);
    }
}
?>
