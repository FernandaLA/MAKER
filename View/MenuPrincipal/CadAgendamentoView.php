<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
        <script src="js/CadAgendamentoView.js?rdm=<?php echo time(); ?>"></script>
    </head>
    <body>
        <div id="CadAgendamento" class="modal">
            <input type="hidden" id="codPrestador" name="codPrestador" class="cadAgendamento">
            <input type="hidden" id="method" name="method">
            <div class="card" style="margin-top: 0px; padding-top: 2px; max-width: 650px;">
                <span id="fechaModalAgendamento" class="close" style="margin-top: 8px;">&times;</span>
                <table>
                    <tr>
                        <td>
                            <img src="../../Resources/images/maker/logoOficial.png" width="150" alt="Logo Maker" />
                        </td>
                        <td>
                            <h1 class="titulo-cadastro" style="margin-left: 90px">Solicitar Agendamento</h1>
                        </td>
                    </tr>
                </table>

                <hr>

                <table width="100%" cellspacing="8px">
                    <tr>
                        <td width="30%" style="border-right: 1px solid #000">
                            <label for="codServico" class="titulo">Serviço *</label><br>
                            <div id="tdcodServico"></div> <!-- criar combo -->
                            <!-- <input type="text" id="codServico" name="codServico" class="cadAgendamento input-menor" placeholder="08:00" maxlength="5"> -->
                        </td>
                        <td>
                            <label for="dtaAgendamento" class="titulo">Data *</label>
                            <input type="input" id="dtaAgendamento" class="input">
                        </td>
                        <td>
                            <label for="dscHorario" class="titulo">Horário *</label>
                            <!-- combo com horários disponíveis -->
                            <input type="input" id="dtaAgendamento" class="input">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <input type="button" id="btnCancelar" value="Cancelar" class="button-default" style="margin-left: 0px;margin-top: 10px">                            
                        </td>
                        <td style="text-align: center;">
                            <input type="button" id="btnSalvarAgendamento" value="Salvar" class="button-enviar" style="margin-left: 0px;margin-top: 10px">                            
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>