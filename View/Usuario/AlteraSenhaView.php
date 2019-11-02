<html>
    <head>
        <title>MAKER - Alterar Senha</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
        <script language="JavaScript" type="text/JavaScript"></script>
        <script src="../../Resources/JavaScript.js"></script>
        <script src="../../Resources/js/jquery-1.9.0.js"></script>
        <script src="../../Resources/js/jquery-ui-1.10.0.custom.js"></script>
        <link href="../../Resources/css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet">
        <script src="../../View/MenuPrincipal/js/FuncoesGerais.js?random=<?php echo time(); ?>"></script>
        <script src="../../Resources/swal/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../Resources/swal/dist/sweetalert.css">
        <script src="js/AlteraSenhaView.js?rdm=<?php echo time();?>"></script>
        <style>
            #table_form tr{
                padding-bottom: 2px;
            }
            #table_form{
                border: 1px solid; 
                margin-top: 180; 
                background-color: #CEE3F6;
                width: 430px;
                height: 250px;
                color: preto;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <form name="AlteraSenhaForm" id="AlteraSenhaForm" method="post" action="../../Controller/Login/LoginController.php">
            <table align=center id="table_form">
                <tr align="center">
                    <td colspan="2" style="font-family:Times New Roman;
                                           font-size:30;
                                           color: darkcyan;
                                           border-bottom: 1px solid darkcyan">
                        <b>Alteração de Senha</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Senha Atual
                    </td>
                    <td><input type="password" id="txtSenha" name="txtSenha" class="persist"></td>
                </tr>
                <tr>
                    <td>
                        Nova Senha
                    </td>
                    <td><input type="password" id="txtSenhaNova" name="txtSenhaNova" class="persist"></td>
                </tr>
                <tr>
                    <td>
                        Confirmar <br>Nova Senha
                    </td>
                    <td><input type="password" id="txtConfirmacao" name="txtConfirmacao" class="persist"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="button" id="btnAlterar" value="Alterar">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>