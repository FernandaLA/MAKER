<script src="js/ConfirmaValidaPrestadorView.js?rdm=<?php echo time();?>"></script>
    <input type="hidden" id="codUsuario" name="codUsuario" class="persist">
    <table width="100%" align="left">
        <tr>
            <td class="titulo" style="padding-top: 0px;">Nome: </td>
            <td class="titulo" style="padding-top: 0px;">CPF: </td>
        </tr>
        <tr>
            <td>
                <span id="nmeUsuario"></span>
            </td>
            <td>
                <span id="nroCPF"></span>
            </td>
        </tr>
        <tr style="padding-top:20px;">
            <td>
                <input type="button" id="btnReprovar" value="Reprovar" class="button" style="background-color: darkred;">
            </td>
            <td>
                <input type="button" id="btnAprovar" value="Aprovar" class="button">
            </td>
        </tr>
    </table>
