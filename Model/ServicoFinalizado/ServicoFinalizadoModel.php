<?php
include_once("Model/Agenda/AgendaModel.php");
include_once("Dao/ServicoFinalizado/ServicoFinalizadoDao.php");
include_once("Dao/Usuario/UsuarioDao.php");
class ServicoFinalizadoModel extends AgendaModel
{
    public function ServicoFinalizadoModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarServicoFinalizado() {
        $dao = new ServicoFinalizadoDao();
        $daoP = new PerfilDao();
        $codUsuario = $_SESSION['cod_usuario'];
        $perfil = $daoP->RetornaPerfilUsuarioLogado($codUsuario);
        if($perfil[1]['COD_PERFIL'] == 3) {
            $lista = $dao->ListarServicoFinalizadoPrestador($codUsuario);
        } else if ($perfil[1]['COD_PERFIL'] == 4) {
            $lista = $dao->ListarServicoFinalizadoCliente($codUsuario);
        }
        
        return json_encode($lista);
    }
    
}

