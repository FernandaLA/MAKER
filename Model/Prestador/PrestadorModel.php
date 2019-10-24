<?php
include_once("Model/Usuario/UsuarioModel.php");
include_once("Dao/Prestador/PrestadorDao.php");
include_once("Dao/JornadaPrestador/JornadaPrestadorDao.php");
class PrestadorModel extends UsuarioModel
{
    public function PrestadorModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarPrestador($Json=true) {
        $dao = new PrestadorDao();
        $lista = $dao->ListarPrestador();
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function InsertPrestador() {
        $dao = new PrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->nmeUsuario = strtoupper($this->objRequest->nmeUsuario);
        $this->objRequest->dscSobrenome = strtoupper($this->objRequest->dscSobrenome);
        $result = $dao->InsertPrestador($this->objRequest);
        return json_encode($result);
    }

    Public Function UpdatePrestador() {
        $dao = new PrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->UpdatePrestador($this->objRequest);
        return json_encode($result);
    }

    Public Function CarregaDadosPrestador() {
        $dao = new PrestadorDao();
        $JPdao = new JornadaPrestadorDao();
        $result = $dao->CarregaDadosPrestador($_SESSION['cod_usuario']);
        // var_dump($result); die;
        if($result[0] && $result[1] !== null) {
            $result[1][0]['HRA_INICIO'] = substr($result[1][0]['HRA_INICIO'], 0, 5);
            $result[1][0]['HRA_FIM'] = substr($result[1][0]['HRA_FIM'], 0, 5);
            $listaDias = $JPdao->ListarDiasJornada($result[1][0]['COD_JORNADA_PRESTADOR']);
            $result[1][0]['DIAS_ATENDIMENTO'] = $listaDias[1];
        }
        return json_encode($result);
    }
    
}

