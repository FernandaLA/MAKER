<?php
include_once("Controller/BaseController.php");
include_once("Model/Menu/MenuModel.php");
class MenuController extends BaseController
{
    /**
     * Redireciona para a view indicada
     */
    function ChamaView(){
        $model = new MenuModel();
        $lista = $model->ListaMenus();
        $params = array('ListaMenus' => urlencode(serialize($lista)));
        $view = $this->getPath()."/View/Menu/".str_replace("Controller", "View", get_class($this)).".php";
        echo ($this->gen_redirect_and_form($view, $params));    
    }
    /**
    * Adiciona um menu na tabela SE_MENU
    */
    function AddMenu(){
        $model = new MenuModel();
        echo $model->AddMenu();
    }

    function UpdateMenu(){
        $model = new MenuModel();
        echo $model->UpdateMenu();
    }

    function ListaMenus(){
        $model = new MenuModel();
        echo $model->ListaMenus();
    }

    function DeleteMenu(){
        $model = new MenuModel();
        echo $model->DeleteMenu();
    }

    Public Function ListarMenusGrid(){
        $model = new MenuModel();
        echo $model->ListarMenusGrid();
    }
    
    Public Function ListarMetodos(){
        $classe = filter_input(INPUT_POST, 'classe');
        include_once 'Controller/'.$classe.'/'.$classe.'Controller.php';
        $metodosBase = get_class_methods('BaseController');
        $metodosController = get_class_methods($classe.'Controller');
        $metodos = array_diff($metodosController,$metodosBase);
        foreach ($metodos as $value){
            $methods[] = $value;
        }
        echo json_encode(array(true, $methods));
    }
    
    Public Function ListarController(){
        $pasta = 'Controller/';        
        $novo = explode('/', $pasta);
        $pasta='';
        for ($i=0;$i<count($novo)-1;$i++){
            $pasta.=$novo[$i].'/';
        }
        if (filter_input(INPUT_POST, 'pasta')!=''){
            if (filter_input(INPUT_POST, 'pasta')!= 'undefined') {
                $pasta = $pasta.filter_input(INPUT_POST, 'pasta').'/';
            } else {
                echo 'Diretório '.filter_input(INPUT_POST, 'pasta').' não encontrado';
            }
        }
        $pasta = $this->PegarArquivosPasta($pasta);
        echo json_encode(array(true, $pasta));
    }

    Public Function PegarArquivosPasta($pasta){
        // echo $pasta; exit;
        $diretorio = $pasta;
        $ponteiro  = opendir($diretorio);
        while ($nome_itens = readdir($ponteiro)) {
            $itens[] = $nome_itens;
        }
        sort($itens);
        $i=0;
        foreach ($itens as $listar) {
                $arquivosPasta[$i]['nmeArquivo'] = $listar;
                $arquivosPasta[$i]['dscTipo'] = filetype($pasta.$listar);
                if (filetype($pasta.$listar)=="dir"){
                    $arquivosPasta[$i]['dscTamanho'] = "0";
                }else{
                    $arquivosPasta[$i]['dscTamanho'] = filesize($pasta.$listar);
                }
                $arquivosPasta[$i]['dtaAlteracao'] = date ("d/m/Y H:i:s", filemtime($pasta.$listar));
                $i++;
        }
        return $arquivosPasta;
    }
}
?>