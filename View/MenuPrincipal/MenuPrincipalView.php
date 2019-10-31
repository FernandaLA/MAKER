<?php 
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<head>
    <title>MAKER - Home</title>
    <script src="../../View/MenuPrincipal/js/MenuPrincipalView.js"></script>
<style>
    
    /*Card*/
    .card-principal {
        box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.3);
        max-width: 100%;
        padding: 10px 20px;
        margin: 5px;
        background-color: white;
        border-radius: 4px;
        color: white;
        font-family: 'Times New Roman';
        font-size: 22px;
    }
    
    .alert {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding: 14px 10px;
        margin: 10px;
        background-color: #1E90FF;
        border-radius: 5px;
        color: white;
        font-size: 20px;
        font-family: 'Courier New';
        font-weight: bold;
        width: 380;
        height: auto;
    }

    /*Quadro de avisos*/
    .topo-avisos {
        padding: 12px 0px;
        margin: 0px;
        background-color: #CD6600;
        color: white;
        text-align: center;
        font-size: 22px;
        font-family: 'times new roman';
        width: auto;
        height: 20;
    }

    /*chip -- recados do quadro de avisos*/
    .chip {
        display: inline-block;
        padding: 0 10px;
        margin: 8px 10px;
        width: 460px;
        height: auto;
        font-size: 18px;
        line-height: 50px;
        border-radius: 10px;
        background-color: #E8E8E8;
    }
    .closebtn {
        padding-left: 10px;
        color: #888;
        font-weight: bold;
        float: right;
        font-size: 20px;
        cursor: pointer;
    }
    .closebtn:hover {
        color: #000;
    }
</style>
</head>
<body class="body">
    <div class="card">
        <?php include_once "Cabecalho.php"; ?>
        <div class="grid-container" id="telaCliente">
            <div class="item1" style="text-align: left;">
                <table width="100%" align="center">
                    <tr>
                        <td width="50%">
                            <span style="font-size: 26px;font-weight: bold;color: purple;padding-left: 5px">Nossos Prestadores</span>
                        </td>
                        <td width="35%">
                            <label for="tdcodCategoria" class="titulo">Categoria: </label>
                            <div id="tdcodCategoria"></div>
                        </td>
                        <td width="15%">
                            <button class="button-search" id="btnPesquisar" title="Filtrar Prestadores">
                                <span class="oi oi-magnifying-glass"></span>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="item3" style="width: 600px;">
                <div id="listagemPrestadores"></div>
            </div>
        </div>

        <div class="grid-container" id="telaPrestador">
            <div class="item3" style="text-align: center;">
                <!-- <table width="100%" align="center">
                    <tr>
                        <td width="50%"> -->
                            <span style="font-size: 26px;font-weight: bold;color: purple;padding-left: 5px">Serviços Futuros</span>
                        <!-- </td>
                    </tr>
                </table> -->
            </div>
            <div class="item3" style="width: 600px;">
                <div id="listagemServicosFuturos"></div>
            </div>
        </div>
    </div>
    <div id="ModalJornadaPrestador">
        <?php include_once "CadAgendamentoView.php"; ?>
    </div>
</body>