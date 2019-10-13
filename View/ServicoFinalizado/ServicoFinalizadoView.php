<?php
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>

<head>
    <title>MAKER - Servicos Finalizados</title>
    <script src="../../View/ServicoFinalizado/js/ServicoFinalizadoView.js"></script>
</head>

<body class="body">
    <div class="card">
        <?php include_once "../../View/MenuPrincipal/Cabecalho.php"; ?>

        <div class="grid-container">
            <div class="item1" style="text-align: left;">
                <!-- <div class="card-principal"> -->
                <table width="100%" align="center">
                    <tr>
                        <td>
                            <span style="font-size: 26px;font-weight: bold;color: purple;padding-left: 5px">Serviços Finalizados</span>
                        </td>
                    </tr>
                </table>
                <!-- </div> -->
            </div>
            <div class="item3" style="width: 600px;">
                <div id="listagemFinalizados"></div>
            </div>
        </div>

    </div>
</body>