<?php
include_once("Model/Usuario/UsuarioModel.php");
include_once("Dao/ValidaPrestador/ValidaPrestadorDao.php");
class ValidaPrestadorModel extends UsuarioModel
{
    public function ValidaPrestadorModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarPrestadoresPendentes($Json=true) {
        $dao = new ValidaPrestadorDao();
        $lista = $dao->ListarPrestadoresPendentes();
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function UpdateStatusPrestador() {
        $dao = new ValidaPrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->UpdateStatusPrestador($this->objRequest);
        return json_encode($result);
    }
    
}

