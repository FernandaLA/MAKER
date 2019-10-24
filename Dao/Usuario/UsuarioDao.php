<?php
include_once("Dao/BaseDao.php");
class UsuarioDao extends BaseDao {

    Protected $tableName = "SE_USUARIO";

    Protected $columns = array ("nmeUsuario"                => array("column" =>"NME_USUARIO", "typeColumn" =>"S"),
                                "nroCpf"                    => array("column" =>"NRO_CPF", "typeColumn" =>"S"),
                                "txtEmail"                  => array("column" =>"TXT_EMAIL", "typeColumn" =>"S"),
                                "nroTelefone"               => array("column" =>"NRO_TELEFONE", "typeColumn" =>"S"),
                                "dscLogradouro"             => array("column" =>"DSC_LOGRADOURO", "typeColumn" =>"S"),
                                "txtSenha"                  => array("column" =>"TXT_SENHA", "typeColumn" =>"S"),
                                "codPerfil"                 => array("column" =>"COD_PERFIL", "typeColumn" =>"I"),
                                "indAtivo"                  => array("column" =>"IND_ATIVO", "typeColumn" =>"S"),
                                "dscComplementoEndereco"    => array("column" =>"DSC_COMPLEMENTO_ENDERECO", "typeColumn" =>"S"),
                                "dscBairro"                 => array("column" =>"DSC_BAIRRO", "typeColumn" =>"S"),
                                "dscCidade"                 => array("column" =>"DSC_CIDADE", "typeColumn" =>"S"),
                                "dscSobrenome"              => array("column" =>"DSC_SOBRENOME", "typeColumn" =>"S"),
                                "nroCep"                    => array("column" =>"NRO_CEP", "typeColumn" =>"S"),
                                "sglUf"                     => array("column" =>"SGL_UF", "typeColumn" =>"S"),
                                "dtaNascimento"             => array("column" =>"DTA_NASCIMENTO", "typeColumn" =>"D"),
                                "dscCaminhoFoto"            => array("column" =>"DSC_CAMINHO_FOTO", "typeColumn" =>"S"),
                                "dscCaminhoCertificado"     => array("column" =>"DSC_CAMINHO_CERTIFICADO", "typeColumn" =>"S"));

    Protected $columnKey = array("codUsuario"=> array("column" =>"COD_USUARIO", "typeColumn" => "I"));

    function UsuarioDao() {
        $this->conect();
    }
    
    Public Function InsertUsuario(stdClass $obj) {
        $obj->codUsuario = $this->CatchUltimoCodigo('SE_USUARIO', 'COD_USUARIO');
        $obj->indAtivo = "S";
        $obj->txtSenha = md5($obj->txtSenha);
        return $this->MontarInsert($obj);
    }

    function ListarUsuario() {
        $select = " SELECT DISTINCT U.COD_USUARIO,
                           NME_USUARIO,
                           NRO_CPF,
                           TXT_EMAIL,
                           U.COD_PERFIL,
                           P.DSC_PERFIL,
                           U.IND_ATIVO
                      FROM SE_USUARIO U
                     INNER JOIN SE_PERFIL P
                        ON U.COD_PERFIL = P.COD_PERFIL";
        return $this->selectDB("$select", false);
    }

    function ListaDadosUsuario($codPerfil) {
        $select = " SELECT $codPerfil AS COD_PERFIL,
                        COD_USUARIO,
                        NME_USUARIO,
                        DSC_SOBRENOME
                   FROM SE_USUARIO
                  WHERE IND_ATIVO = 'S'";
        return $this->selectDB("$select", false);
    }

    function AddUsuario() {
        $codUsuario = $this->CatchUltimoCodigo('SE_USUARIO', 'COD_USUARIO');
        $txtSenha = '123459';
        $senha = base64_encode($txtSenha);
        $insert = " INSERT INTO SE_USUARIO (
                                COD_USUARIO,
                                NME_USUARIO,
                                TXT_SENHA,
                                COD_PERFIL,
                                IND_ATIVO,
                                TXT_EMAIL,
                                NRO_CPF)
                         VALUES (
                                $codUsuario,
                                '" . filter_input(INPUT_POST, 'nmeUsuario', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                                '" . $senha . "',
                                '" . filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT) . "',
                                '" . filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING) . "',
                                '" . filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_STRING) . "',
                                '" . filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_STRING) . "')";
        $result = $this->insertDB("$insert");
        if ($result[0]) {
            $result[1] = $codUsuario;
        }
        return $result;
    }

    function UpdateUsuario() {
        $nroCpf = str_replace('-', '', str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_NUMBER_INT)));
        $update = " UPDATE SE_USUARIO
                       SET NME_USUARIO    = '" . filter_input(INPUT_POST, 'nmeUsuario', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                           TXT_EMAIL      = '" . filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_MAGIC_QUOTES) . "',
                           COD_PERFIL     = '" . filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT) . "',
                           IND_ATIVO      = '" . filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING) . "'
                        WHERE COD_USUARIO = " . filter_input(INPUT_POST, 'codUsuario', FILTER_SANITIZE_NUMBER_INT);
        $result = $this->insertDB("$update");
        if ($result[0]) {
            $result[1] = filter_input(INPUT_POST, 'codUsuario', FILTER_SANITIZE_NUMBER_INT);
        }
        return $result;

    }

    function DeleteUsuario() {
        $delete = " DELETE FROM SE_USUARIO
                          WHERE COD_USUARIO = " . filter_input(INPUT_POST, 'codUsuario', FILTER_SANITIZE_NUMBER_INT);
        $result = $this->insertDB("$delete");
        return $result;
    }

    public function ResetaSenha($nroCpf) {
        // $nroCpf = str_replace('-', '', str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_NUMBER_INT)));
        $select = " SELECT COD_USUARIO FROM SE_USUARIO WHERE NRO_CPF = '" . $nroCpf . "'";
        $rs = $this->selectDB($select, false);
        if ($rs[0]) {
            if ($rs[1][0]['COD_USUARIO'] > 0) {
                $senha = md5("123459");
                $update = " UPDATE SE_USUARIO
                                  SET TXT_SENHA = '" . $senha . "'
                                WHERE COD_USUARIO = " . $rs[1][0]['COD_USUARIO'];
                $rs = $this->insertDB("$update");
            } else {
                $rs[0] = false;
                $rs[1] = 'CPF n&atilde;o encontrado na base de dados!';
            }
        }
        return $rs;
    }

    public function VerificaUsuario($nroCpf) {
        $select = " SELECT COD_USUARIO
                      FROM SE_USUARIO
                     WHERE NRO_CPF ='" . $nroCpf . "'";
        return $this->selectDB($select, false);
    }

    public function RecuperarSenha($codUsuario, $novaSenha) {
        $update = " UPDATE SE_USUARIO
                       SET TXT_SENHA = '" . $novaSenha . "'
                     WHERE COD_USUARIO = " . $codUsuario;
        return $this->insertDB($update);
    }

    public function BuscaPerfilUsuario($codUsuario) {
        $select = " SELECT COD_PERFIL
                      FROM SE_USUARIO
                     WHERE COD_USUARIO =".$codUsuario;
        return $this->selectDB($select, false);
    }
}
?>
