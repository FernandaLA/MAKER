<?php
include_once("Model/BaseModel.php");
include_once("Dao/AvaliacaoAgendamento/AvaliacaoAgendamentoDao.php");
class AvaliacaoAgendamentoModel extends BaseModel
{
    public function AvaliacaoAgendamentoModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function InsertAvaliacaoAgendamento() {
        $dao = new AvaliacaoAgendamentoDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->FinalizaAgendamento($this->objRequest->codAgendamento);
        if($result[0]) {
            $this->objRequest->codUsuario = $_SESSION['cod_usuario'];
            $result = $dao->InsertAvaliacaoAgendamento($this->objRequest);
        }
        return json_encode($result);
    }
    
}

