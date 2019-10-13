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
        $daoU = new UsuarioDao();
        $codUsuario = $_SESSION['cod_usuario'];
        $perfil = $daoU->BuscaPerfilUsuario($codUsuario);
        if($perfil[1]['COD_PERFIL'] == 2) {
            $lista = $dao->ListarServicoFinalizadoPrestador($codUsuario);
        } else if ($perfil[1]['COD_PERFIL'] == 3) {
            $lista = $dao->ListarServicoFinalizadoCliente($codUsuario);
        }
        
        return json_encode($lista);
    }
    
}

