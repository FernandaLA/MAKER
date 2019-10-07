<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
        <script src="js/CadJornadaPrestadorView.js?rdm=<?php echo time(); ?>"></script>
    </head>
    <body>
        <div id="CadJornadaPrestador" class="modal">
            <input type="hidden" id="codJornadaPrestador" name="codJornadaPrestador" class="cadJornada">
            <input type="hidden" id="method" name="method">
            <div class="card" style="margin-top: 0px; padding-top: 2px; max-width: 650px;">
                <span id="fechaModalJornada" class="close" style="margin-top: 8px;">&times;</span>
                <table>
                    <tr>
                        <td>
                            <img src="../../Resources/images/maker/logoOficial.png" width="150" alt="Logo Maker" />
                        </td>
                        <td>
                            <h1 class="titulo-cadastro" style="margin-left: 90px">Editar Jornada</h1>
                        </td>
                    </tr>
                </table>

                <hr>

                <table width="100%" cellspacing="8px">
                    <tr>
                        <td width="30%" style="border-right: 1px solid #000">
                            <label for="hraInicio" class="titulo">Jornada *</label><br>
                            <input type="text" id="hraInicio" name="hraInicio" class="cadJornada input-menor" placeholder="08:00" maxlength="5">
                            às
                            <input type="text" id="hraFim" name="hraFim" class="cadJornada input-menor" placeholder="17:00" maxlength="5">
                        </td>
                        <td>
                            <label for="diasAtendimento" class="titulo">Dias de Atendimento *</label>
                            <input type="checkbox" id="todosDias" class="input-cb">
                            <strong class="checkbox"> Todos os Dias</strong><br>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <input type="checkbox" id="chkDia1" codDia="1"
                                            class="input-cb checkDias"><strong class="checkbox"> Domingo</strong>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="chkDia2" codDia="2"
                                            class="input-cb checkDias"><strong class="checkbox"> Segunda</strong>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="chkDia3" codDia="3"
                                            class="input-cb checkDias"><strong class="checkbox"> Terça</strong>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="chkDia4" codDia="4"
                                            class="input-cb checkDias"><strong class="checkbox"> Quarta</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="chkDia5" codDia="5"
                                        class="input-cb checkDias"><strong class="checkbox"> Quinta</strong>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="chkDia6" codDia="6"
                                            class="input-cb checkDias"><strong class="checkbox"> Sexta</strong>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="chkDia7" codDia="7"
                                            class="input-cb checkDias"><strong class="checkbox"> Sábado</strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <input type="button" id="btnSalvarJornada" value="Salvar" class="button-enviar" style="margin-left: 0px;margin-top: 10px">                            
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>