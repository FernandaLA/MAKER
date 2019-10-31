<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
        <script src="js/CadServicoPrestadorView.js?rdm=<?php echo time(); ?>"></script>
    </head>
    <body>
        <div id="CadServicoPrestador" class="modal">
            <input type="hidden" id="codServico" name="codServico" class="cadServico">
            <div class="card" style="margin-top: 0px; padding-top: 2px; max-width: 700px;">
                <span id="fechaModalServico" class="close" style="margin-top: 8px;">&times;</span>
                <table>
                    <tr>
                        <td>
                            <img src="../../Resources/images/maker/logoOficial.png" width="150" alt="Logo Maker" />
                        </td>
                        <td>
                            <h1 class="titulo-cadastro" style="margin-left: 96px">Meus Serviços</h1>
                        </td>
                    </tr>
                </table>

                <hr>
                <h2 class="titulo-cadastro">Serviços</h2>

                <table width="100%">
                    <tr id='botaoNovo'>
                        <td>
                            <input type="button" id="btnNovoServico" value="Novo Serviço" class="button-novo" style="margin-left: 0px;margin-top: 10px;border-radius: 8px">
                        </td>
                    </tr>
                    <tr class="formServico">
                        <td>
                            <label for="comboCategorias" class="titulo">Categoria *</label>
                            <div id="tdcodCategoriaSer"></div>
                        </td>
                        <td>
                            <label for="dscServico" class="titulo">Descrição *</label>
                            <input type="text" id="dscServico" name="dscServico" class="input cadServico" placeholder="Exemplos: Tintura, Corte..">
                        </td>
                    </tr>
                    <tr class="formServico">
                        <td>
                            <label for="vlrServico" class="titulo">Valor *</label>
                            <input type="text" id="vlrServico" name="vlrServico" class="input cadServico" placeholder="Valor do seu serviço">
                        </td>
                        <td>
                            <label for="tmpDuracaoServico" class="titulo">Tempo de Serviço *</label>
                            <input type="text" id="tmpDuracaoServico" name="tmpDuracaoServico" class="input cadServico" placeholder="Tempo necessário para realização do serviço">
                        </td>
                    </tr>
                    <tr class="formServico">
                        <td style="text-align: center">
                            <input type="button" id="btnCancelarServico" value="Cancelar" class="button-default" style="margin-left: 0px;margin-top: 10px">
                        </td>
                        <td style="text-align: center">
                            <input type="button" id="btnSalvarServico" value="Salvar Serviço" class="button-enviar" style="margin-left: 0px;margin-top: 10px">
                        </td>
                    </tr>
                </table>
                <br>
                <div id="listaServicos"></div>

            </div>
        </div>
    </body>
</html>