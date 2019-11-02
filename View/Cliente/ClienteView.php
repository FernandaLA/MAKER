<?php 
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<head>
    <title>MAKER - Cliente</title>
    <script src="../../View/Cliente/js/ClienteView.js"></script>
</head>
<body>
    <div class="card">
        <?php include_once "../../View/MenuPrincipal/Cabecalho.php"; ?>

        <table width="100%">
            <tr>
                <td width="14%">
                    <img style="border-radius:50%" src="../../Resources/images/maker/fotoPerfil.jpg" width="100" alt="foto de Perfil">
                </td>
                <td width="30%" style="text-align:left">
                    <table width="100%">
                        <tr>
                            <td id="nmeClienteCompleto"  class="labelFont14" style="font-size: 18px"></td>
                        </tr>
                        <tr>
                            <td id="avaliacaoCliente" class="labelFont14" >Avaliação: 5 <span class="oi oi-star" style="color:gold;border-color:khaki;"></span></td>
                        </tr>
                    </table>
                </td>
                <td width="26%">
                    <table width="100%" style="text-align:right">
                        <tr>
                            <td><input type="button" id="btnEditarPerfilCli" class="button-edit" value="Editar Perfil"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" id="enderecoCliente" class="labelFont14"></td>
            </tr>
        </table>
        <hr style="margin-top: 20px">
        
        <div id="editarCadastro" class="card-maximo">
            <input type="hidden" id="codUsuarioCli" name="codUsuario" class="cadCliente">
        
            <h2 class="titulo-cadastro">Dados Pessoais</h2>

            <table width="100%" cellspacing="8px">
                <tr>
                    <td>
                        <label for="nroCpfCli" class="titulo">CPF *</label>
                        <input type="text" id="nroCpfCli" name="nroCpf" class="cadCliente input" onblur="validaCpfCli()">
                    </td>
                    <td>
                        <label for="nmeUsuario" class="titulo">Nome *</label>
                        <input required type="text" id="nmeUsuarioCli" name="nmeUsuario"
                            class="cadCliente input" style="text-transform:uppercase;">
                    </td>
                    <td>
                        <label for="dscSobrenome" class="titulo">Sobrenome *</label>
                        <input required type="text" id="dscSobrenomeCli" name="dscSobrenome"
                            class="cadCliente input" style="text-transform:uppercase;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dtaNascimento" class="titulo">Data de Nascimento *</label>
                        <input required type="text" id="dtaNascimentoCli" name="dtaNascimento" class="cadCliente input">
                    </td>
                    <td>
                        <label for="nroTelefone" class="titulo">Celular *</label>
                        <input required type="text" id="nroTelefoneCli" name="nroTelefone" class="cadCliente input">
                    </td>
                    <td>
                        <label for="txtEmail" class="titulo">Email *</label>
                        <input required type="text" id="txtEmailCli" name="txtEmail" class="cadCliente input">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="titulo-cadastro" style="font-size: 20px"><u>Endereço<u></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nroCep" class="titulo">CEP *</label>
                        <input required type="text" id="nroCepCli" name="nroCep" class="cadCliente input">
                    </td>
                    <td>
                        <label for="dscLogradouro" class="titulo">Logradouro *</label>
                        <input disabled type="text" id="dscLogradouroCli" name="dscLogradouro" class="cadCliente input">
                    </td>
                    <td>
                        <label for="dscComplementoEndereco" class="titulo">Complemento *</label>
                        <input required type="text" id="dscComplementoEnderecoCli" name="dscComplementoEndereco" class="cadCliente input">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dscBairro" class="titulo">Bairro *</label>
                        <input required type="text" id="dscBairroCli" name="dscBairro" class="cadCliente input">
                    </td>
                    <td>
                        <label for="dscCidade" class="titulo">Cidade *</label>
                        <input required type="text" id="dscCidadeCli" name="dscCidade" class="cadCliente input">
                    </td>
                    <td>
                        <label for="dscEstado" class="titulo">Estado *</label>
                        <div id="tdsglUfCli"></div>
                    </td>
                </tr>
            </table>
                
            <hr style="margin-top: 20px">
            <h2 class="titulo-cadastro">Dados de Acesso</h2>

            <table  width="100%" cellspacing="8px">
                <tr>
                    <td>
                        <label for="txtSenhaCad" class="titulo">Senha *</label>
                        <span>********</span>
                    </td>
                    <td style="text-align: right;">
                        <input type="button" id="btnAlterarSenha" value="Alterar Senha" class="button" style="width: 180px;">
                    </td>
                </tr>
            </table>

            <hr style="margin-top: 30px;margin-bottom: 0px">
            <div class="titulo">
                <input type="button" id="btnCancelaEdicao" value="Cancelar" class="button-default">
                <input type="button" id="btnSalvarCadastro" value="Enviar Cadastro" class="button-enviar">
            </div>
        </div>
    </div>
</body>