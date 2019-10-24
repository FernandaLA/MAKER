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
        $daoU = new UsuarioDao();
        $codUsuario = $_SESSION['cod_usuario'];
        $perfil = $daoU->BuscaPerfilUsuario($codUsuario);
        if($perfil[1]['COD_PERFIL'] == 2) {
            $lista = $dao->ListarServicoPendentePrestador($codUsuario);
        } else if ($perfil[1]['COD_PERFIL'] == 3) {
            $lista = $dao->ListarServicoPendenteCliente($codUsuario);
        }

        return json_encode($lista);
    }
    
}

