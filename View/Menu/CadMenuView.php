<script src="js/CadMenuView.js?rdm=<?php echo time();?>"></script>
<form name="menuForm" enctype="multpart/form-data" id="cadastroMenuForm" method="post" action="../../Controller/Menu/CadastroMenuController.php">
    <input type="hidden" id="codMenu" name="codMenu" value="0" class="persist">    
    <input type="hidden" id="dscCaminhoImagem" name="dscCaminhoImagem" class="persist">
    <table width="100%" align="left">
        <tr>
            <td>
                <label class="titulo" style="padding-top: 0px;" for="dscMenu">Menu</label>
                <input type="text" name="dscMenu" id="dscMenu" class="persist input">
            </td>
        </tr>
        <tr>
            <td class="titulo" style="padding-top: 0px;">Controller</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="nmeController" id="nmeController" class="persist input" style="width: 480px;">
                <input type="hidden" name="nmeClasse" id="nmeClasse" class="persist">
                <input type="button" id="btnListarController" value="Listar Controllers">
            </td>
        </tr>
        <tr>
            <td class="titulo" style="padding-top: 0px;">Method</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="nmeMethod" id="nmeMethod" class="persist input" style="width: 480px;">
                <input type="button" id="btnListarMetodos" value="Listar Métodos">
            </td>
        </tr>
        <tr>
            <td class="titulo">
                <!-- <input type="checkbox" name="indAtalho" id="indAtalho" class="persist">Atalho &nbsp;&nbsp; -->
                <input type="checkbox" name="indAtivo" id="indAtivo" class="persist">Ativo &nbsp;&nbsp;
                <input type="checkbox" name="indVisible" id="indVisible" class="persist">Visivel
            </td>
        </tr>
        <tr>
            <td class="titulo">
            <label for="codMenuPai">Menu Pai </label>
                <div id="tdcodMenuPai"></div>
            </td>
        </tr>
        <tr>
            <td class="titulo">
                <label for="dscCaminhoImagem">Ícone Menu </label>
                <input type="text" name="dscCaminhoImagem" id="dscCaminhoImagem" class="persist input">
            </td>
        </tr>
        <!-- <tr>
            <td class="titulo">
                Ícone do Atalho
                <div style="border-top:1px solid;padding-top: 5px;width: 220px;">
                    Selecione o arquivo:<br>
                    <input type="file" name="arquivo" id="arquivo" class="persist"/>
                    <br />
                    <progress value="0" max="100"></progress>
                    <span id="porcentagem">0%</span>
                    <br />
                </div>
            </td>
        </tr> -->
    </table>   
</form>
<table>
    <tr style="padding-top:20px;">
        <td>
            <input type="button" id="btnSalvar" value="Salvar" class="button">
        </td>
        <td>
            <input type="button" id="btnDeletar" value="Deletar" class="button" style="background-color: darkred;">
        </td>
    </tr>
</table>
