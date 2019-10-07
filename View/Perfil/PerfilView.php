<?php 
include_once getenv("CONSTANTES");
include_once "../Scripts.php";
?>
<html>
    <head>
        <title>MAKER - Cadastro de Perfil</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; IBM850; ISO-8859-1">
        <script src="js/PerfilView.js?rdm=<?php echo time();?>"></script>
        
    </head>
    <body>
        <input type="hidden" id="method" name="method" value="">
        <input type="hidden" id="codPerfil" name="codPerfil" class="persist">
        <div class="card" style="max-width: 510px;">
            <?php include_once "View/MenuPrincipal/Cabecalho.php";?>
            <div class="cabecalho">Cadastro de Perfil</div>
            
            <div class="titulo" style="margin-bottom: 30px;">
                <input type="button" id="btnNovo" value="Novo Perfil" class="button-novo">
            </div>
            
            <label for="dscPerfil" class="titulo">Descrição</label>
            <input type="text" id="dscPerfil" name="dscPerfil" class="persist input">

            <input type="checkbox" id="indAtivo" name="indAtivo" class="persist input" style="width: 3%;">
            <label for="indAtivo" class="titulo">Ativo</label>
            
            <div class="titulo" style="text-align: right;">
                <input type="button" id="btnSalvar" value="Salvar" class="button" style="width: 100px;">
            </div>
            
            <div class="titulo">
                <div id="listaPerfil"></div>
            </div>
        </div>
    </body>
</html>
