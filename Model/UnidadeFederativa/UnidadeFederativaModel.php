<?php
include_once("Model/BaseModel.php");
include_once("Dao/UnidadeFederativa/UnidadeFederativaDao.php");
class UnidadeFederativaModel extends BaseModel
{
    public function UnidadeFederativaModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarUnidadeFederativa() {
        $dao = new UnidadeFederativaDao();
        $lista = $dao->ListarUnidadeFederativa();
        if ($lista[0]) {
            $qtdTotal = count($lista[1]);
            for($i=0;$i<$qtdTotal;$i++) {
                $lista[1][$i]['COD'] = $lista[1][$i]['SGL_ESTADO'];
                $lista[1][$i]['DSC'] = $lista[1][$i]['DSC_ESTADO'];
            }
        }
        return json_encode($lista);
    }
    
}

