<?php
include_once("Model/Agenda/AgendaModel.php");
include_once("Dao/ServicoPendente/ServicoPendenteDao.php");
include_once("Dao/Usuario/UsuarioDao.php");
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
        if($perfil[1]['COD_PERFIL'] == 3) {
            $lista = $dao->ListarServicoPendentePrestador($codUsuario);
        } else if ($perfil[1]['COD_PERFIL'] == 4) {
            $lista = $dao->ListarServicoPendenteCliente($codUsuario);
        }

        return json_encode($lista);
    }
    
}

