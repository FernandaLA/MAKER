<?php 
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<head>
    <title>MAKER - Meu Perfil</title>
    <script src="../../View/Prestador/js/PrestadorView.js"></script>
</head>
<body class="body">
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
                            <td id="nmePrestadorCompleto"  class="labelFont14" style="font-size: 18px"></td>
                        </tr>
                        <tr>
                            <td id="avaliacaoPrestador" class="labelFont14" >Avaliação: 5 <span class="oi oi-star" style="color:gold;border-color:khaki;"></span></td>
                        </tr>
                    </table>
                </td>
                <td width="30%" style="text-align:left">
                    <table width="100%">
                        <tr>
                            <td width="50%" class="labelFont14">Jornada: 
                                <div id="jornadaPrestador" style="color: grey"></div>
                            </td>
                            <td>
                                <button class="icon-edit" id="btnEditarJornada" title="Editar Jornada">
                                    <span class="oi oi-pencil"></span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="labelFont14">Dias de Atendimento: <br>
                                <div id="diasAtendimento" style="color: grey;text-align:justify"></div>
                            </td>
                        </tr>
                    </table> 
                </td>
                <td width="26%">
                    <table width="100%" style="text-align:right">
                        <tr>
                            <td><input type="button" id="btnEditarPerfilPre" class="button-edit" value="Editar Perfil"></td>
                        </tr>
                        <tr>
                            <td><input type="button" id="btnMeusServicos" class="button-edit" value="Meus Serviços"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" id="enderecoPrestador" class="labelFont14"></td>
            </tr>
            <tr>
                <td colspan="4" id="servicosPrestador" class="titulo"></td>
            </tr>
        </table>

        <div id="editarCadastro" class="card">
            <input type="hidden" id="codUsuarioPre" name="codUsuario" class="cadPrestador">
            <input type="hidden" id="codPerfilPre" name="codPerfil" class="cadPrestador" value="3">


            <hr style="margin-top: 20px">
            <h2 class="titulo-cadastro">Dados Pessoais</h2>
            <table width="100%" cellspacing="8px">
                <tr>
                    <td>
                        <label for="nroCpfPre" class="titulo">CPF *</label>
                        <input type="text" id="nroCpfPre" name="nroCpf" class="cadPrestador input" disabled>
                    </td>
                    <td>
                        <label for="nmeUsuarioPre" class="titulo">Nome *</label>
                        <input required type="text" id="nmeUsuarioPre" name="nmeUsuario"
                            class="cadPrestador input" style="text-transform:uppercase;" disabled>
                    </td>
                    <td>
                        <label for="dscSobrenomePre" class="titulo">Sobrenome *</label>
                        <input required type="text" id="dscSobrenomePre" name="dscSobrenome"
                            class="cadPrestador input" style="text-transform:uppercase;" disabled>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dtaNascimentoPre" class="titulo">Data de Nascimento *</label>
                        <input required type="text" id="dtaNascimentoPre" name="dtaNascimento"
                            class="cadPrestador input">
                    </td>
                    <td>
                        <label for="nroTelefonePre" class="titulo">Celular *</label>
                        <input required type="text" id="nroTelefonePre" name="nroTelefone" class="cadPrestador input">
                    </td>
                    <td>
                        <label for="txtEmailPre" class="titulo">Email *</label>
                        <input required type="text" id="txtEmailPre" name="txtEmail" class="cadPrestador input">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="titulo-cadastro" style="font-size: 20px"><u>Endereço<u></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nroCepPre" class="titulo">Cep *</label>
                        <input required type="text" id="nroCepPre" name="nroCep" class="cadPrestador input">
                    </td>
                    <td>
                        <label for="dscLogradouroPre" class="titulo">Logradouro *</label>
                        <input disabled type="text" id="dscLogradouroPre" name="dscLogradouro" class="cadPrestador input">
                    </td>
                    <td>
                        <label for="dscComplementoEnderecoPre" class="titulo">Complemento</label>
                        <input required type="text" id="dscComplementoEnderecoPre" name="dscComplementoEndereco" class="cadPrestador input">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dscBairroPre" class="titulo">Bairro *</label>
                        <input required type="text" id="dscBairroPre" name="dscBairro" class="cadPrestador input">
                    </td>
                    <td>
                        <label for="dscCidadePre" class="titulo">Cidade *</label>
                        <input required type="text" id="dscCidadePre" name="dscCidade" class="cadPrestador input">
                    </td>
                    <td>
                        <label for="dscEstadoPre" class="titulo">Estado *</label>
                        <div id="tdslgUf" ></div>
                    </td>
                </tr>
            </table>
            
            <hr style="margin-top: 20px">
            <h2 class="titulo-cadastro">Informações Profissionais</h2>
            
            <label for="servicosBox" class="titulo">Serviços Prestados *</label><br>
            <span style="color: #303030;padding-left: 35px;font-size: 0.90em;font-weight: bold;margin-bottom: 5px">
                ** Informe apenas as categorias, em outro momento pediremos os serviços detalhados
            </span>
            <!-- checkbox  -->
            <div style="margin-bottom: 1em;margin-top: 1em">
                <table width="100%" id="servicosBox"></table>
            </div>
            
            <label for="arquivoPre" class="titulo">Envio do Certificado *</label>
            <!-- add arquivo -->
            <div style="padding-top: 10px;width: 220px;">
                Selecione o arquivo:<br>
                <input type="file" name="arquivo" id="arquivo" class="cadPrestador"/>
                <br />
                <progress value="0" max="100"></progress>
                <span id="porcentagem">0%</span>
                <br />
            </div>
            
            <hr style="margin-top: 20px">
            <h2 class="titulo-cadastro">Dados de Acesso</h2>

            <table  width="80%" cellspacing="8px">
                <tr>
                    <td>
                        <label for="txtSenhaCadPre" class="titulo">Senha *</label>
                        <input required type="password" id="txtSenhaCadPre" name="txtSenha" class="cadPrestador input">
                    </td>
                    <td>
                        <label for="txtSenhaConfPre" class="titulo">Confirme a Senha *</label>
                        <input required type="password" id="txtSenhaConfPre" name="txtSenhaConf" class="input">
                    </td>
                </tr>
            </table>

            <hr style="margin-top: 30px;margin-bottom: 0px">
            <div class="titulo">
                <input type="button" id="btnCancelarEdicao" value="Cancelar" class="button-default">
                <input type="button" id="btnSalvarCadastro" value="Enviar Cadastro" class="button-enviar">
            </div>
        </div>
    </div>
    <div id="ModalJornadaPrestador">
        <?php include_once "CadJornadaPrestadorView.php"; ?>
    </div>
    <div id="ModalServicosPrestador">
        <?php include_once "CadServicoPrestadorView.php"; ?>
    </div>
</body>