<?php
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<html>
    <head>
        <title>MAKER - Validar Prestador</title>
        <script src="js/ValidaPrestadorView.js?rdm=<?php echo time(); ?>"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
    </head>
    <body>
        <div class="card" style="max-width: 710px;">
            <?php include_once "../../View/MenuPrincipal/Cabecalho.php";?>
            <div class="cabecalho">Prestadores Pendentes de Aprovação</div>
            
            <div class="titulo">
                <div id="listaPrestadores"></div>
            </div>
        </div>
        <div id="ConfirmaValidacao">
            <div id="windowHeader"></div>
            <div style="overflow: hidden;" id="windowContent">
                <?php include_once "ConfirmaValidaPrestadorView.php"; ?>
            </div>
        </div>
    </body>
</html>