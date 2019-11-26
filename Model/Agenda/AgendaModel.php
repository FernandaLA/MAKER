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
        $part = explode('-', $dtaAgendamento);
        $dtaAgendamento = $part[2]+"/"+$part[1]+"/"+$part[0];
        $codPrestador = $this->objRequest->codPrestador;
        $intervalo = "10000";
        $horarios = [];
        $lista = $dao->BuscaJornadaPrestador($codPrestador);
        if($lista[0]) {
            $inicio = $lista[1][0]["HRA_INICIO"];
            $inicio = str_replace(":", "", $inicio);
            $fim = $lista[1][0]["HRA_FIM"];
            $fim = str_replace(":", "", $fim);
            for ($i = $inicio; $i <= $fim; $i=$i+$intervalo){
                $horarios[$i] = $i;
            }
            // var_dump($horarios); die;
            $lista = $dao->BuscaHorariosOcupados($codPrestador, $dtaAgendamento);
            if($lista[0] && $lista[1] > 0) {
                $agendados = $lista[1];
                for ($i = 0; $i < $agendados.length; $i++) {
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

