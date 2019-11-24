<?php
include_once("Model/BaseModel.php");
include_once("Dao/Usuario/UsuarioDao.php");
include_once("Resources/php/FuncoesArray.php");
include_once("Resources/php/FuncoesString.php");
class UsuarioModel extends BaseModel
{
    function UsuarioModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    function ListarUsuario(){
        $dao = new UsuarioDao();
        $lista = $dao->ListarUsuario();
        if ($lista[0]){
            if ($lista[1]!=null){
                $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
            }
        }
        return json_encode($lista);
    }

    function ListaDadosUsuario(){
        $dao = new UsuarioDao();
        $lista = $dao->ListaDadosUsuario($_SESSION['cod_perfil']);
        return json_encode($lista);
    }
    
    function InsertUsuario(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->txtSenhaConf = $dao->Populate('txtSenhaConf', 'S');
        $result = $this->ValidaCampos();
        if($result[0]){
            $this->objRequest->nmeUsuario = strtoupper($this->objRequest->nmeUsuario);
            $this->objRequest->dscSobrenome = strtoupper($this->objRequest->dscSobrenome);
            $result = $dao->InsertUsuario($this->objRequest);
        }
        return json_encode($result);
    }

    function UpdateUsuario(){
        $dao = new UsuarioDao();
        return json_encode($dao->UpdateUsuario());
    }
    
    function DeleteUsuario(){
        $dao = new UsuarioDao();
        return $dao->DeleteUsuario();
    }
    
    function VerificaCpf(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $nroCpf = $this->objRequest->nroCpf;
        if (FuncoesString::validaCPF($nroCpf)) {
            $result = $dao->VerificaUsuario($nroCpf);
            if($result[0] && $result[1] > 0) {
                $result[0] = false;
                $result[1] = 'CPF já cadastrado em nosso sistema!';
            }
        } else {
            $result[0] = false;
            $result[1] = 'O CPF informado é inválido!';
        }
        
        return json_encode($result);
    }
    
    Public Function ResetaSenha(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $nroCpf = $this->objRequest->nroCpf;
        return json_encode($dao->ResetaSenha($nroCpf));
    }
    
    Public Function RecuperarSenha(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        // $nroCpf = filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_NUMBER_INT);
        if (isset($this->objRequest->nroCpf)){
            $nroCpf = $this->objRequest->nroCpf;
            if (FuncoesString::validaCPF($nroCpf)) {
                $result = $dao->VerificaUsuario($nroCpf);
                if($result[0]) {
                    if($result[1] > 0) {
                        $codUsuario = $result[1][0]['COD_USUARIO'];
                        $novaSenha = md5('954321');
                        $result = $dao->RecuperarSenha($codUsuario, $novaSenha);
                        // if ($result[0]) {
                        //     Enviar email para o usuário com a nova senha
                        // }
                    } else {
                        $result[0] = false;
                        $result[1] = "Nenhum Usuário encontrado com o CPF informado!";
                    }
                }
            } else {
                $result[0] = false;
                $result[1] = "CPF inválido!";
            }
        } else {
            $result[0] = false;
            $result[1] = "Informe o CPF!";
        }
        return json_encode($result);
    }

    Public Function ValidaCampos(){
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

    Public Function validaNascimento($dtaNascimento) {
        $retorno = array(false, '');
        //Data de nascimento
        $dtaCad = date('Y-m-d',strtotime(str_replace('/','-',$dtaNascimento)));   
        // data atual
        $dtaAtual = date('Y-m-d'); 
        var_dump('data nasc: ', $dtaNascimento);
        var_dump('data: ', $dtaCad, ' Ano: ', substr($dtaCad,0,4), ' Mês: ', substr($dtaCad,5,2), ' Dia: ', substr($dtaCad,8,2)); die;
        if (substr($dtaCad,0,4) > date('Y') || substr($dtaCad,0,4) < date('Y')-99 || substr($dtaCad,5,7) > 12 || substr($dtaCad,8,10) > 31){
            $retorno[0] = true;
            $retorno[1] = "Informe uma 'Data de Nascimento' válida\n";
        } else if (date('Y') - substr($dtaCad,0,4) < 18){
            $retorno[0] = true;
            $retorno[1] = "Você não tem idade para se cadastrar conosco, sinto muito\n";
        }
        
        // diferenca entre duas datas
        // if( isset($dtaCad) && $dtaCad != "" && isset($dtaAtual) && $dtaAtual != "") {
        //     $dtaCad = DateTime::createFromFormat('Y-m-d', $dtaCad);
        //     $dtaAtual = DateTime::createFromFormat('Y-m-d', $dtaAtual);
            
        //     if ((int)$dtaAtual->diff($dtaCad)->format('%y') < 18) {
        //         $retorno[0] = true;
        //         $retorno[1] = "Você não tem idade para se cadastrar conosco, sinto muito\n";
        //     }
        // }
        return $retorno;
    }
}
?>
