<?php
include_once("Model/BaseModel.php");
include_once("Dao/JornadaPrestador/JornadaPrestadorDao.php");
class JornadaPrestadorModel extends BaseModel
{
    public function JornadaPrestadorModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function CarregaJornadaPrestador() {
        $dao = new JornadaPrestadorDao();
        $codPrestador = $_SESSION['cod_usuario'];
        $lista = $dao->CarregaJornadaPrestador($codPrestador);
        if($lista[0]){
            $lista[1][0]['HRA_INICIO'] = substr($lista[1][0]['HRA_INICIO'], 0, 5);
            $lista[1][0]['HRA_FIM'] = substr($lista[1][0]['HRA_FIM'], 0, 5);
            $listaDias = $dao->ListarDiasJornada($lista[1][0]['COD_JORNADA_PRESTADOR']);
            $lista[1][0]['DIAS_ATENDIMENTO'] = $listaDias[1];
        }
        
        return json_encode($lista);
        
    }

    Public Function InsertJornadaPrestador() {
        $dao = new JornadaPrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->VerificaJornadaPrestador();
        if($result[0] && $result[1]>0) {
            $this->UpdateJornadaPrestador();
        } else {
            $result = $dao->InsertJornadaPrestador($this->objRequest);
            if($result[0]){
                $codJornadaPrestador = $result[2];
                $diasAtendimento = explode('-', $dao->Populate('dscDiasAtendimento', 'S'));
                // var_dump($result[2]); die;
                $todos = count($diasAtendimento);
                for($i=0;$i<$todos;$i++){
                    $result = $dao->InsertDiasJornada($codJornadaPrestador, $diasAtendimento[$i]);
                }

            }
        }
        return json_encode($result);
    }

    Public Function UpdateJornadaPrestador() {
        $dao = new JornadaPrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->UpdateJornadaPrestador($this->objRequest);
        if($result[0]){
            $result = $dao->DeleteDiasJornada($this->objRequest->codJornadaPrestador);
            $diasAtendimento = explode('-', $dao->Populate('dscDiasAtendimento', 'S'));
            // var_dump($diasAtendimento); die;
            $todos = count($diasAtendimento);
            for($i=0;$i<$todos;$i++){
                $result = $dao->InsertDiasJornada($this->objRequest->codJornadaPrestador, $diasAtendimento[$i]);
            }

        }
        return json_encode($result);
    }
    
}

