<script src="js/CadUsuarioView.js?rdm=<?php echo time();?>"></script>
<form name="UsuarioForm" method="post" action="Controller/Usuario/UsuarioController.php">
    <input type="hidden" id="method" name="method">
    <input type="hidden" id="codUsuario" name="codUsuario" class="persist">
    <table width="100%">
        <tr>
            <td class="titulo">Nome Completo</td>
            <td><input type="text" id="nmeUsuario" name="nmeUsuario" class="persist input"></td>
        </tr>
        <tr>
            <td class="titulo">Login</td>
            <td><input type="text" id="nmeLogin" name="nmeLogin" class="persist input"></td>
        </tr>
        <tr>
            <td class="titulo">CPF</td>
            <td><input type="text" id="nroCpf" name="nroCpf" class="persist input"></td>
        </tr>
        <tr>
            <td class="titulo">Email</td>
            <td><input type="text" id="txtEmail" name="txtEmail" class="persist input"></td>
        </tr>
        <tr>
            <td class="titulo">Perfil</td>
            <td><div id="tdcodPerfil"></div></td>
        </tr>
        <tr>
            <td class="titulo"><input type="checkbox" name="indAtivo" id="indAtivo" class="persist">Ativo</td>
        </tr>         
        <tr>
            <td>
                <input type="button" id="btnSalvar" value="Salvar" class="button">
            </td>
            <td>
                <input type="button" id="btnReiniciarSenha" value="Reiniciar Senha" class="button" style="width: 180px; background-color: darkkhaki;">
            </td>            
        </tr>
    </table>
</form>