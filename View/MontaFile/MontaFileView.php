<?php
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MAKER - Monta File</title>
        <script src="../MontaFile/JavaScript/MontaFileView.js?rdm=<?php echo time();?>"></script>        
    </head>
    <body class="body">
        <input type="hidden" id="method">
        <input type="hidden" id="codUsuario">
        <div class="card">
            <?php include_once "../../View/MenuPrincipal/Cabecalho.php";?>
            <div class="cabecalho">Monta File</div>
            
            <div class="titulo" style="margin-bottom: 30px;">
                <input type="button" id="Refresh" value="Atualiza" onclick="javascript:MontaListaTabelas();" class="button-novo">
            </div>
            
            <div class="titulo">
                <div id="listaTabelas"></div>
            </div>
        </div>
    </body>
</html>
