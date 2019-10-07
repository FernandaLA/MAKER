<?php
include_once ("Controller/BaseController.php");
include_once ("Model/MontaFile/MontaFileModel.php");
class MontaFileController extends BaseController
{
   
    Public Function ChamaView() {
        $param = array();
        $view = BaseController::ReturnView(BaseController::getPath(), get_class($this));
        echo $this->gen_redirect_and_form($view, $param);
    }
    
    function ListarTabelas() {
        $model = new MontaFileModel();
        echo $model->ListarTabelas();
    }    
    
    function GeraFile() {
        $model = new MontaFileModel();
        echo $model->GeraFile();
    }
      
}
?>
