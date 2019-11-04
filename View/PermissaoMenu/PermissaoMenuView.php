<?php 
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<HTML>
    <HEAD>
        <title>MAKER - Permissão de Menus</title>
        <script src="js/PermissaoMenuView.js?rdm=<?php echo time();?>"></script>
    </HEAD>
    <BODY class="body">
        <form name="PermissaoForm" id="PermissaoForm" method="post" action="Controller/PermissaoMenu/PermissaoMenuController.php">
        <input type="hidden" value="" name="method" id="method">
        <input type="hidden" value="" name="codMenu" id="codMenu">
        <input type="hidden" value="" name="indAtivo" id="indAtivo">
        <div class="card-maximo">
                <?php include_once "../../View/MenuPrincipal/Cabecalho.php";?>
                <div class="cabecalho">Permissões de Menu</div>
                
                <div class="titulo" style="margin-bottom: 20px;">
                    <label for="codPerfil" class="titulo">Perfil</label>
                    <div id="tdcodPerfil"></div>
                </div>
                <table width="100%">
                    <tr>
                        <td class="MenusExistentes">
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td class="titulo">Menus Existentes</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="ListaMenus"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="jqxWidget" class="titulo" style='border: 1px solid #000000;'>
                                            <table width="100%" id="checkboxes"></table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="MenusExistentes">
                            <input type="button" id="btnSalvar" value="Salvar" class="button">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </BODY>
</HTML>
