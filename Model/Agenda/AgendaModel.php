<?php
include_once("Model/BaseModel.php");
include_once("Dao/Agenda/AgendaDao.php");
include_once("Resources/php/FuncoesData.php");
class AgendaModel extends BaseModel
{
    public function AgendaModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function InsertAgendamento() {
        $dao = new AgendaDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->codCliente = $_SESSION['cod_usuario'];
        $this->objRequest->codStatus = 1;
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
        $result = [];
        $result[0] = false;
        $dao = new AgendaDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $dtaAgendamento = $this->objRequest->dtaAgendamento;
        $diaSemana = getdate(strtotime($dtaAgendamento))['wday']+1;
        // $part = explode('-', $dtaAgendamento);
        // $dtaAgendamento = $part[2]."/".$part[1]."/".$part[0];
        // var_dump($dtaAgendamento); die;
        $codPrestador = $this->objRequest->codPrestador;
        $intervalo = "010000";
        $horarios = [];
        $lista = $dao->BuscaJornadaPrestador($codPrestador);
        if($lista[0] && $lista[1] !== null) {
            $inicio = $lista[1][0]["HRA_INICIO"];
            $inicio = str_replace(":", "", $inicio);
            $fim = $lista[1][0]["HRA_FIM"];
            $fim = str_replace(":", "", $fim);
            $lista = $dao->BuscaDiasJornadaPrestador($lista[1][0]['COD_JORNADA_PRESTADOR']);
            if($lista[0]) {
                $disponivel = false;
                for($i = 0; $i < count($lista[1]);$i++){
                    // var_dump((string) $diaSemana);
                    // var_dump($lista[1][$i]['COD_DIA']);
                    if($lista[1][$i]['COD_DIA'] == (string) $diaSemana) {
                        $disponivel = true;
                    }
                }
                // var_dump($disponivel);
                // die;
                if($disponivel) {
                    for ($i = $inicio; $i <= $fim; $i=$i+$intervalo){
                        if(strlen((string) $i) == 5){
                            $horarios[] = (string) "0".substr($i,0,1).":".substr($i,1,2).":".substr($i,3,2);
                        } else {
                            $horarios[] = (string) substr($i,0,2).":".substr($i,2,2).":".substr($i,4,2);
                        }
                    }
                    $lista = $dao->BuscaHorariosOcupados($codPrestador, $dtaAgendamento);
                    if($lista[0] && $lista[1] > 0) {
                        $agendados = $lista[1];
                        for ($i = 0; $i < count($agendados); $i++) {
                            for ($j = 0; $j < count($horarios); $j++) {
                                if($agendados[$i]['DSC_HORARIO'] == $horarios[$j]) {
                                    unset($horarios[$j]);
                                }
                            }
                        }
                    }
                    $result[0] = true;
                    $result[1] = $horarios;
                } else {
                    $result[1] = "Ops!<br> Este prestador não está disponivel neste dia";
                }
            }
        }
        return json_encode($result);
    }

    Public Function ListarServicosFuturos() {
        $dao = new AgendaDao();
        $lista = $dao->ListarServicosFuturos($_SESSION['cod_usuario']);
        $lista = FuncoesData::AtualizaDataInArray($lista, 'DTA_AGENDAMENTO');

        return json_encode($lista);
    }
    
}

