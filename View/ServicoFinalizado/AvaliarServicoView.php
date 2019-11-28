<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
        <script src="js/AvaliarServicoView.js?rdm=<?php echo time(); ?>"></script>
    </head>

    <body>
        <div id="AvaliacaoServico" class="modal">
            <input type="hidden" id="codAgendamento" name="codAgendamento" class="avaliacaoServico">
            <input type="hidden" id="codUsuarioAvaliado" name="codUsuarioAvaliado" class="avaliacaoServico">
            <input type="hidden" id="nroNotaAvaliacao" name="nroNotaAvaliacao" class="avaliacaoServico">
            <div class="card" style="margin-top: 0px; padding-top: 2px; max-width: 650px;">
                <span id="fechaModalAvaliacao" class="close" style="margin-top: 8px;">&times;</span>
                <table>
                    <tr>
                        <td>
                            <img src="../../Resources/images/maker/logoOficial.png" width="150" alt="Logo Maker" />
                        </td>
                        <td>
                            <h1 class="titulo-cadastro" style="margin-left: 90px">Avaliar Serviço</h1>
                        </td>
                    </tr>
                </table>

                <hr>
                <table width="100%">
                    <tr>
                        <td style="text-align: center;">
                            <span class="titulo">Como foi o serviço com <strong id="nmeUsuario"></strong>?</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding-left: 160px;padding-top: 35px;">
                            <div id='notaAvaliacao' style="margin: 0px"></div>
                            <div style='display: contents;' class="labelFont15" id='infoNota'></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 35px;">
                            <label for="dscAvaliacao" style="padding-left: 70px" class="labelFont15">Mensagem: </label>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <textarea name="dscAvaliacao" placeholder="Deixe um comentário aqui..." id="dscAvaliacao" cols="60" rows="4" class="text-area avaliacaoServico"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;padding-top: 35px;">
                            <button class="btn-success" style="margin: 0px;" id="btnAvaliar">Avaliar</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>