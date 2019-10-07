<?php
include_once("Model/BaseModel.php");
include_once("Dao/ServicoPrestador/ServicoPrestadorDao.php");
class ServicoPrestadorModel extends BaseModel
{
    public function ServicoPrestadorModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarServicoPrestador($Json=true) {
        $dao = new ServicoPrestadorDao();
        $lista = $dao->ListarServicoPrestador($_SESSION['cod_usuario']);
        if($lista[0] && $lista[1]>0) {
            $lista[1][0]['TMP_DURACAO_SERVICO'] = substr($lista[1][0]['TMP_DURACAO_SERVICO'], 0, 5);
        }
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function InsertServicoPrestador() {
        $dao = new ServicoPrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $this->ValidaCampos();
        if($result[0]){
            $this->objRequest->codPrestador = $_SESSION['cod_usuario'];
            $this->objRequest->indAtivo = 'S';
            $result = $dao->InsertServicoPrestador($this->objRequest);
        }
        return json_encode($result);
    }

    Public Function UpdateServicoPrestador() {
        $dao = new ServicoPrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->UpdateServicoPrestador($this->objRequest);
        return json_encode($result);
    }

    Public Function ValidaCampos() {
        $retorno = [];
        $retorno[0] = true;
    }
    
}

