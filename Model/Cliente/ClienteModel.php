<?php
include_once("Model/Usuario/UsuarioModel.php");
include_once("Dao/Cliente/ClienteDao.php");
include_once("Dao/CategoriaServico/CategoriaServicoDao.php");
include_once("Dao/JornadaPrestador/JornadaPrestadorDao.php");
class ClienteModel extends UsuarioModel
{
    public function ClienteModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function CarregaListaPrestadores() {
        $dao = new ClienteDao();
        $CSdao = new CategoriaServicoDao();
        $JPdao = new JornadaPrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->GetColumns());
        if (isset($this->objRequest->codCategoria)){
            $lista = $dao->CarregaListaPrestadoresPorCategoria($this->objRequest);   
        }else{
            $lista = $dao->CarregaListaPrestadores();
        }
        $totalRegistros = count($lista[1]);
        if ($lista[0] && $totalRegistros>0) {
            for($i=0;$i<$totalRegistros;$i++) {
                $lista[1][$i]['HRA_INICIO'] = substr($lista[1][$i]['HRA_INICIO'], 0, 5);
                $lista[1][$i]['HRA_FIM'] = substr($lista[1][$i]['HRA_FIM'], 0, 5);
                $lista[1][$i]['JORNADA_PRESTADOR'] = $lista[1][$i]['HRA_INICIO'].' as '.$lista[1][$i]['HRA_FIM'];
                $listaCategorias = $CSdao->ListarCategoriaServicoPrestador($lista[1][$i]['COD_USUARIO']);
                $lista[1][$i]['LISTA_CATEGORIAS'] = $listaCategorias[1];
                $listaDias = $JPdao->ListarDiasJornada($lista[1][$i]['COD_JORNADA_PRESTADOR']);
                $lista[1][$i]['DIAS_ATENDIMENTO'] = $listaDias[1];
            }
        }
        return json_encode($lista);
    }

    Public Function CarregaDadosCliente() {
        $dao = new ClienteDao();
        $result = $dao->CarregaDadosCliente($_SESSION['cod_usuario']);
        // var_dump($result); die;
        return json_encode($result);
    }
    
}

