<?php
include_once("Model/Agenda/AgendaModel.php");
include_once("Dao/ServicoPendente/ServicoPendenteDao.php");
include_once("Dao/Perfil/PerfilDao.php");
include_once("Resources/php/FuncoesData.php");
class ServicoPendenteModel extends AgendaModel
{
    public function ServicoPendenteModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarServicoPendente() {
        $dao = new ServicoPendenteDao();
        $daoP = new PerfilDao();
        $codUsuario = $_SESSION['cod_usuario'];
        $perfil = $daoP->RetornaPerfilUsuarioLogado($codUsuario);
        if($perfil[1][0]['COD_PERFIL'] == 3) {
            $lista = $dao->ListarServicoPendentePrestador($codUsuario);
        } else if ($perfil[1][0]['COD_PERFIL'] == 4) {
            $lista = $dao->ListarServicoPendenteCliente($codUsuario);
        } else {
            $lista = $dao->ListarServicoPendenteCliente($codUsuario);
            // $lista = $dao->ListarServicoPendentePrestador($codUsuario);
        }
        $lista = FuncoesData::AtualizaDataInArray($lista, 'DTA_AGENDAMENTO');

        return json_encode($lista);
    }
    
}

