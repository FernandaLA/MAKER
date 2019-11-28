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
    </table>
    <table width="100%" style="padding-top:10px;">
            <tr>
                <td align="center" style="padding-top:10px;font-size:20px;">
                    <a id="linkCertificado" href="" target="_blank" title="Certificado"></a>
                </td>
            </tr>
    </table>
    <table width="100%" style="padding-top:40px;">
        <tr>
            <td>
                <input type="button" id="btnReprovar" value="Recusar" class="button" style="background-color: darkred;">
            </td>
            <td>
                <input type="button" id="btnAprovar" value="Aprovar" class="button">
            </td>
        </tr>
    </table>
