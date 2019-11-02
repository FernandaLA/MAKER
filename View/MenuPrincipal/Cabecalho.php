<?php
error_reporting(E_ALL & ~E_WARNING & ~ E_DEPRECATED);
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['cod_usuario'])) {
    header("Location:../../index.php");
}

include_once "../Scripts.php";
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../../View/MenuPrincipal/js/Cabecalho.js?random=<?php echo time(); ?>"></script>
        <style>
            a:link, a:visited {
                text-decoration: none;
                color: black;
            }
            a:active {
                text-decoration: none
            }
            .jqx-menu-item-top, .jqx-menu-item
            {
                font-size: 14px;
                vertical-align: middle;
            }
            .txt-cabecalho {
                vertical-align:middle;
                text-align: right;
                font-family: Georgia;
                font-size: 22px;
                font-weight: bold;
                color: #bc05bc;
                padding-top: 15px;
            }
        </style>
    </head>
    <body>
        <div id="cabecalho" class="card-cabecalho">
            <table width="100%">
                <tr>
                    <td style="text-align:left;">
                        <?php
                            echo "<a style=\"text-align: left;
                                                height: 10%;
                                                vertical-align: middle;
                                                font-family: Nimbus Mono L;
                                                color: #145b61;\"
                                        href=\"../../View/MenuPrincipal/MenuPrincipalView.php\"><img src='../../Resources/images/maker/logoOficial.png' width='180'></a>";
                        ?>
                    </td>
                    <!-- <td class="txt-cabecalho" width="80%">
                        </td> -->
                    <td style="text-align: right;vertical-align: top;padding-top: 8px;padding-right: 10px" width="40%">
                        <table width="100%">
                            <tr>
                                <td style="text-align: right;">
                                    <a href="../../index.php" style='color: #FFF;background-color: #FA58AC;padding: 4px;border-radius: 5px;'>
                                        <strong>Log Out</strong>
                                    </a>        
                                </td>
                            </tr>
                            <tr>
                                <td class="txt-cabecalho" width="100%">
                                    Olá, <span id="nomeCabecalho"></span>
                                    <!-- Foto do usuario logado! -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div id="CriaMenu"></div>
        </div>
    </body>
</html>