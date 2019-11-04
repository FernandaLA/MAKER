<?php
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>

<head>
    <title>MAKER - Servicos Pendentes</title>
    <script src="../../View/ServicoPendente/js/ServicoPendenteView.js"></script>
</head>

<body class="body">
    <div class="card">
        <?php include_once "../../View/MenuPrincipal/Cabecalho.php"; ?>

        <div class="grid-container">
            <div class="item1" style="text-align: left;">
                <!-- <div class="card-principal"> -->
                <table width="100%" align="center">
                    <tr>
                        <td style="text-align: center;">
                            <span style="font-size: 26px;font-weight: bold;color: purple;padding-left: 5px">Serviços Pendentes</span>
                        </td>
                    </tr>
                </table>
                <!-- </div> -->
            </div>
            <div class="item3" style="width: 600px;">
                <div id="listagemPendentes"></div>
            </div>
        </div>

    </div>
</body>