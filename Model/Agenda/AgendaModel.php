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

    Public Function ListaHorariosDisponiveis() {
        $dao = new AgendaDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $dtaAgendamento = $this->objRequest->dtaAgendamento;
        $intervalo = 10000;
        $horarios = [];
        $lista = $dao->BuscaJornadaPrestador($this->objRequest->codPrestador);
        if($lista[0]) {
            $inicio = $lista[1]['HRA_INICIO'];
            $fim = $lista[1]['HRA_FIM'];
            for ($i = $inicio; $i <= $fim; $i+$intervalo){
                $horarios[$i] = $i;
            }
            $lista = $dao->BuscaHorariosOcupados($lista[1]['COD_PRESTADOR'], $dtaAgendamento);
            if($lista[0]) {
                $agendados = $lista[1];
                for ($i = 0; $i <= $agendados.length; $i++) {
                    unset($horarios[$agendados[$i]]);
                }
            }
        }
        return json_encode(array(true, $horarios));
    }

    Public Function ListarServicosFuturos() {
        $dao = new AgendaDao();
        $lista = $dao->ListarServicosFuturos($_SESSION['cod_usuario']);

        return json_encode($lista);
    }
    
}

