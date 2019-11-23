<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
        <script src="View/Cliente/js/CadClienteView.js?rdm=<?php echo time(); ?>"></script>
    </head>
    <body class="body">
        <div id="CadCliente" class="modal">
            <input type="hidden" id="codUsuarioCli" name="codUsuario" class="cadCliente">
            <input type="hidden" id="codPerfilCli" name="codPerfil" class="cadCliente" value="4">
            <input type="hidden" id="dscCaminhoFotoCli" name="dscCaminhoFoto" class="cadCliente">
            <input type="hidden" id="verificaPermissao" name="verificaPermissao" class="cadCliente" value="N">
            <div class="card" style="margin-top: 0px; padding-top: 2px; max-width: 800px;">
                <span id="fechaModalCli" class="close" style="margin-top: 8px;">&times;</span>
                <div style="width: 100%;text-align: center">
                    <img src="../../Resources/images/maker/logoOficial.png" width="280" alt="Logo Maker" />
                </div>

                <hr>
                <h1 class="titulo-cadastro">Cadastro Cliente</h1>
                <h2 class="titulo-cadastro">Dados Pessoais</h2>

                <table width="100%" cellspacing="8px">
                    <tr>
                        <td colspan="2">
                            <form id="formFotoCli" enctype="multpart/form-data" name="formFotoCli" action="">
                                <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N">
                                <!-- previa da foto -->
                                <div style="padding-top: 10px;width: 220px;">
                                    Escolher uma foto:<br>
                                    <input type="file" name="fotoCli" id="fotoCli"/>
                                    <br />
                                    <progress value="0" max="100"></progress>
                                    <span id="porcentagem">0%</span>
                                    <br />
                                </div>
                                <span style="color: #505050">
                                    Tamanho máximo: 80KB. Formatos: .jpg, .jpeg ou .png
                                </span>
                            </form>
                        </td>
                        <td>
                            <h5 style="width: 100%;margin: 0px;text-align: right;color:#7c15c0">* Campos Obrigatórios</h5>
                        </td>
                    </tr>
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
                            <label for="txtEmail" class="titulo">E-mail *</label>
                            <input required type="text" id="txtEmailCli" name="txtEmail" class="cadCliente input">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="titulo-cadastro" style="font-size: 20px">Endereço</label>
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
                            <label for="dscEstado" class="titulo">UF *</label>
                            <div id="tdsglUfCli"></div>
                        </td>
                    </tr>
                </table>
                
                
                <hr style="margin-top: 20px">
                <h2 class="titulo-cadastro">Dados de Acesso</h2>

                <table  width="80%" cellspacing="8px">
                    <tr>
                        <td>
                            <label for="txtSenhaCad" class="titulo">Senha *</label>
                            <input required type="password" id="txtSenhaCadCli" name="txtSenha" class="cadCliente input" minlength="6" maxlength="8">
                        </td>
                        <td>
                            <label for="txtSenhaConf" class="titulo">Confirme a Senha *</label>
                            <input required type="password" id="txtSenhaConfCli" name="txtSenhaConf" class="cadCliente input" minlength="6" maxlength="8">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <small style="color: #505050">
                                A senha deve ter de 6 a 8 caracteres
                            </small>
                        </td>
                    </tr>
                </table>
   
                <hr style="margin-top: 30px;margin-bottom: 0px">
                <div class="titulo">
                    <input type="button" id="btnVoltarCli" value="Cancelar" class="button-default">
                    <input type="button" id="btnSalvarCli" value="Enviar Cadastro" class="button-enviar">
                </div>
            </div>
        </div>
    </body>
</html>