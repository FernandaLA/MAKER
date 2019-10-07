<?php
include_once("Model/BaseModel.php");
include_once("Dao/CategoriaServico/CategoriaServicoDao.php");
class CategoriaServicoModel extends BaseModel
{
    public function CategoriaServicoModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarCategoriaServico($Json=true) {
        $dao = new CategoriaServicoDao();
        $lista = $dao->ListarCategoriaServico();
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function ListarCategoriaServicoAtivo($Json=true) {
        $dao = new CategoriaServicoDao();
        $lista = $dao->ListarCategoriaServicoAtivo();
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function ListarCategoriaServicoPrestador($Json=true) {
        $dao = new CategoriaServicoDao();
        $lista = $dao->ListarCategoriaServicoPrestador($_SESSION['cod_usuario']);
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function InsertCategoriaServico() {
        $dao = new CategoriaServicoDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->InsertCategoriaServico($this->objRequest);
        return json_encode($result);
    }

    Public Function UpdateCategoriaServico() {
        $dao = new CategoriaServicoDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->UpdateCategoriaServico($this->objRequest);
        return json_encode($result);
    }
    
}

