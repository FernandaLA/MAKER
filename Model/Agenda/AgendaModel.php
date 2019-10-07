<?php
include_once("Model/BaseModel.php");
include_once("Dao/Agenda/AgendaDao.php");
class AgendaModel extends BaseModel
{
    public function AgendaModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarAgenda($Json=true) {
        $dao = new AgendaDao();
        $lista = $dao->ListarAgenda();
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function InsertAgendamento() {
        $dao = new AgendaDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->InsertAgendamento($this->objRequest);
        return json_encode($result);
    }

    Public Function UpdateAgendamento() {
        $dao = new AgendaDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->UpdateAgendamento($this->objRequest);
        return json_encode($result);
    }
    
}

