<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
        <script src="View/Prestador/js/CadPrestadorView.js?rdm=<?php echo time(); ?>"></script>
    </head>
    <body>
        <div id="CadPrestador" class="modal">
            <input type="hidden" id="codUsuarioPre" name="codUsuario" class="cadPrestador">
            <input type="hidden" id="codPerfilPre" name="codPerfil" class="cadPrestador" value="3">
            <input type="hidden" id="dscCaminhoFotoPre" name="dscCaminhoFoto" class="cadPrestador">
            <input type="hidden" id="dscCaminhoCertificado" name="dscCaminhoCertificado" class="cadPrestador">
            <input type="hidden" id="verificaPermissao" name="verificaPermissao" class="cadPrestador" value="N">
            <div class="card" style="margin-top: 0px; padding-top: 2px; max-width: 800px;">
                <span id="fechaModalPre" class="close" style="margin-top: 8px;">&times;</span>
                <div style="width: 100%;text-align: center">
                    <img src="../../Resources/images/maker/logoOficial.png" width="280" alt="Logo Maker" />
                </div>

                <hr>
                <h1 class="titulo-cadastro">Cadastro Prestador</h1>
                <h2 class="titulo-cadastro">Dados Pessoais</h2>

                
                <table width="100%" cellspacing="8px">
                    <tr>
                        <td colspan="2">
                            <form id="formFotoPre" enctype="multpart/form-data" name="formFoto" action="">
                                <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N">
                                <!-- previa da foto -->
                                <div style="padding-top: 10px;width: 220px;">
                                    Escolher uma foto:
                                    <input type="file" name="fotoPre" id="fotoPre" class="cadPrestador"/>
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
                            <label for="nroCpfPre" class="titulo">CPF *</label>
                            <input type="text" id="nroCpfPre" name="nroCpf" class="cadPrestador input" onblur="validaCpfPre()">
                        </td>
                        <td>
                            <label for="nmeUsuarioPre" class="titulo">Nome *</label>
                            <input required type="text" id="nmeUsuarioPre" name="nmeUsuario"
                                class="cadPrestador input" style="text-transform:uppercase;">
                        </td>
                        <td>
                            <label for="dscSobrenomePre" class="titulo">Sobrenome *</label>
                            <input required type="text" id="dscSobrenomePre" name="dscSobrenome"
                                class="cadPrestador input" style="text-transform:uppercase;">
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
                            <label for="txtEmailPre" class="titulo">E-mail *</label>
                            <input required type="text" id="txtEmailPre" name="txtEmail" class="cadPrestador input">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="titulo-cadastro" style="font-size: 20px">Endereço</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nroCepPre" class="titulo">CEP *</label>
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
                            <label for="dscEstadoPre" class="titulo">UF *</label>
                            <div id="tdsglUfPre" ></div>
                        </td>
                    </tr>
                </table>
                
                
                <hr style="margin-top: 20px">
                <h2 class="titulo-cadastro">Informações Profissionais</h2>
                
                <label for="servicosBox" class="titulo">Serviços Prestados *</label><br>
                <span style="color: #303030;padding-left: 35px;font-size: 0.90em;font-weight: bold;margin-bottom: 5px">
                    Obs.: Informe apenas as categorias, em outro momento pediremos os serviços detalhados
                </span>
                <!-- checkbox  -->
                <div style="margin-bottom: 1em;margin-top: 1em">
                    <table width="100%" id="servicosBox" class="cadPrestador"></table>
                </div>

                <form id="formCertificado" enctype="multpart/form-data" name="formCertificado" action="">
                    <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N">

                    <label for="arquivo" class="titulo">Envio do Certificado *</label>

                    <div style="padding-top: 10px;width: 220px;">
                        Selecione o arquivo:
                        <input type="file" name="arquivo" id="arquivo" class="cadPrestador"/>
                        <br />
                        <progress value="0" max="100"></progress>
                        <span id="porcentagem">0%</span>
                        <br />
                    </div>
                    <small style="color: #505050">
                        Tamanho máximo: 200KB. Apenas .pdf
                    </small>
                </form>
                
                <hr style="margin-top: 20px">
                <h2 class="titulo-cadastro">Dados de Acesso</h2>

                <table  width="80%" cellspacing="8px">
                    <tr>
                        <td>
                            <label for="txtSenhaCadPre" class="titulo">Senha *</label>
                            <input required type="password" id="txtSenhaCadPre" name="txtSenha" class="cadPrestador input" minlength="6" maxlength="8">
                        </td>
                        <td>
                            <label for="txtSenhaConfPre" class="titulo">Confirme a Senha *</label>
                            <input required type="password" id="txtSenhaConfPre" name="txtSenhaConf" class="cadPrestador input" minlength="6" maxlength="8">
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
                    <input type="button" id="btnVoltarPre" value="Cancelar" class="button-default">
                    <input type="button" id="btnSalvarPre" value="Enviar Cadastro" class="button-enviar">
                </div>
            </div>
        </div>
    </body>
</html>