<?php
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<html>
    <head>
        <title>MAKER - Cadastro de Usuários</title>
        <script src="js/UsuarioView.js?rdm=<?php echo time(); ?>"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
    </head>
    <body>
        <div class="card" style="max-width: 710px;">
            <?php include_once "../../View/MenuPrincipal/Cabecalho.php";?>
            <div class="cabecalho">Usu&aacute;rios</div>
            
            <div class="titulo" style="margin-bottom: 30px;">
                <input type="button" id="btnNovo" value="Novo Usu&aacute;rio" class="button-novo">
            </div>
            
            <div class="titulo">
                <div id="listaUsuarios"></div>
            </div>
        </div>
        <div id="CadUsuarios">
            <div id="windowHeader"></div>
            <div style="overflow: hidden;" id="windowContent">
                <?php include_once "CadUsuarioView.php"; ?>
            </div>
        </div>
    </body>
</html>