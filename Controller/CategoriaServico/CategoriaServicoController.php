<?php
include_once("Controller/BaseController.php");
include_once("Model/CategoriaServico/CategoriaServicoModel.php");
class CategoriaServicoController extends BaseController
{
    /**
     * Redireciona para a Tela de  de CategoriaServico
     */
    Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Public Function ListarCategoriaServicoAtivo() {
        $CategoriaServicoModel = new CategoriaServicoModel();
        echo $CategoriaServicoModel->ListarCategoriaServicoAtivo();
    }

    Public Function ListarCategoriaServicoPrestador() {
        $CategoriaServicoModel = new CategoriaServicoModel();
        echo $CategoriaServicoModel->ListarCategoriaServicoPrestador();
    }
}