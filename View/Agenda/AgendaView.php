<?php 
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<head>
    <title>MAKER - Agenda</title>
    <script src="../../View/Agenda/js/AgendaView.js"></script>
</head>
<body class="body">
    <div class="card">
        <?php include_once "../../View/MenuPrincipal/Cabecalho.php"; ?>

        <div id="scheduler"></div>
    </div>
</body>