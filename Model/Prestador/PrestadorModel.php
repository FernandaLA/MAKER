<?php
include_once("Model/Usuario/UsuarioModel.php");
include_once("Dao/Prestador/PrestadorDao.php");
include_once("Dao/JornadaPrestador/JornadaPrestadorDao.php");
include_once("Dao/CategoriaServico/CategoriaServicoDao.php");
include_once("Resources/php/FuncoesString.php");
class PrestadorModel extends UsuarioModel
{
    public function PrestadorModel() {
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    Public Function ListarPrestador($Json=true) {
        $dao = new PrestadorDao();
        $lista = $dao->ListarPrestador();
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function InsertPrestador() {
        $dao = new PrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $cats = $dao->Populate('categoriasPrestador', 'S');
        $this->objRequest->txtSenhaConf = $dao->Populate('txtSenhaConf', 'S');
        $result = $this->ValidaCamposPrestador($cats);
        if($result[0]){
            $this->objRequest->nmeUsuario = strtoupper($this->objRequest->nmeUsuario);
            $this->objRequest->dscSobrenome = strtoupper($this->objRequest->dscSobrenome);
            $result = $dao->InsertPrestador($this->objRequest);
            if($result[0]){
                $codPrestador = $result[2];
                    $categorias = explode('-', $dao->Populate('categoriasPrestador', 'S'));
                    $todos = count($categorias);
                    for($i=0;$i<$todos;$i++){
                        $result = $dao->InsertCategoriaServicoPrestador($codPrestador, $categorias[$i]);
                    }
            }
        }
        return json_encode($result);
    }

    Public Function UpdatePrestador() {
        $dao = new PrestadorDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $result = $dao->UpdatePrestador($this->objRequest);
        if($result[0]){
            $codPrestador = $result[2];
            $result = $dao->DeleteCategoriaServicoPrestador($codPrestador);
            $categorias = explode('-', $dao->Populate('categoriasPrestador', 'S'));

            $todos = count($categorias);
            for($i=0;$i<$todos;$i++){
                $result = $dao->InsertCategoriaServicoPrestador($codPrestador, $categorias[$i]);
            }
        }
        return json_encode($result);
    }

    Public Function CarregaDadosPrestador() {
        $dao = new PrestadorDao();
        $JPdao = new JornadaPrestadorDao();
        $CSdao = new CategoriaServicoDao();
        $result = $dao->CarregaDadosPrestador($_SESSION['cod_usuario']);
        // var_dump($result); die;
        if($result[0] && $result[1] !== null) {
            $listaCategorias = $CSdao->ListarCategoriaServicoPrestador($_SESSION['cod_usuario']);
            $result[1][0]['CATEGORIAS'] = $listaCategorias[1];
            $result[1][0]['HRA_INICIO'] = substr($result[1][0]['HRA_INICIO'], 0, 5);
            $result[1][0]['HRA_FIM'] = substr($result[1][0]['HRA_FIM'], 0, 5);
            if($result[1][0]['COD_JORNADA_PRESTADOR'] !== null){
                $listaDias = $JPdao->ListarDiasJornada($result[1][0]['COD_JORNADA_PRESTADOR']);
                $result[1][0]['DIAS_ATENDIMENTO'] = $listaDias[1];
            } else {
                $result[1][0]['DIAS_ATENDIMENTO'] = null;
            }
        }
        return json_encode($result);
    }
    
    Public Function ValidaCamposPrestador($cats){
        $result=array(true, '');
        if (!isset($this->objRequest->nroCpf)){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'CPF'\n";
        }else if (trim($this->objRequest->nroCpf)==''){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'CPF'\n";
        }
        if (!isset($this->objRequest->nmeUsuario)){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Nome'\n";
        }else if (trim($this->objRequest->nmeUsuario)==''){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Nome'\n";
        }
        if (!isset($this->objRequest->dscSobrenome)){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Sobrenome'\n";
        } else if (trim($this->objRequest->dscSobrenome)==''){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Sobrenome'\n";
        }
        if (!isset($this->objRequest->dtaNascimento)){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Data de Nascimento'\n";
        } else {
            $retorno = $this->validaNascimento($this->objRequest->dtaNascimento);
            if($retorno[0]){
                $result[0] = false;
                $result[1] .= $retorno[1];
            }
        }
        if (!isset($this->objRequest->nroTelefone)){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Celular'\n";
        } else if (!FuncoesString::validaTelefone($this->objRequest->nroTelefone)){
            $result[0] = false;
            $result[1] .= "Informe um Celular válido\n";
        }
        if (!isset($this->objRequest->txtEmail)){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Email'\n";
        } else if(!filter_var($this->objRequest->txtEmail, FILTER_VALIDATE_EMAIL)) {
            $result[0] = false;
            $result[1] .= "Email inválido\n";
        }
        if (!isset($this->objRequest->nroCep)){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'CEP'\n";
        }else if (trim($this->objRequest->nroCep)==''){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'CEP'\n";
        }
        if (!isset($cats)){
            $result[0] = false;
            $result[1] .= "Informe pelo menos uma Categoria\n";
        } else if (trim($cats)=='') {
            $result[0] = false;
            $result[1] .= "Informe pelo menos uma Categoria\n";
        }
        if (!isset($this->objRequest->dscCaminhoCertificado)){
            $result[0] = false;
            $result[1] .= "Nenhum certificado foi enviado\n";
        }
        if (!isset($this->objRequest->txtSenha)){
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Senha'\n";
        } else if (trim($this->objRequest->txtSenha)=='') {
            $result[0] = false;
            $result[1] .= "Preencha o campo 'Senha'\n";
        } else if (strlen($this->objRequest->txtSenha) < 6) {
            $result[0] = false;
            $result[1] .= "Sua senha deve ter pelo menos 6 caracteres'\n";
        } else if ($this->objRequest->txtSenha !== $this->objRequest->txtSenhaConf) {
            $result[0] = false;
            $result[1] .= "As Senhas informadas não são iguais'\n";
        }
        return $result;
    }

}

