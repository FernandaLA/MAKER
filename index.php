<?php
session_start();
session_unset();
include_once getenv("CONSTANTES");
?>
<html>
    <head>
        <title>MAKER</title>
        <script src="Resources/JavaScript.js"></script>
        <link rel="stylesheet" href="Resources/css/style.css?random=<?php echo time(); ?>" type="text/css" />
        <link href="Resources/css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet">
        <link rel="stylesheet" href="Resources/jqx/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="Resources/jqx/jqwidgets/styles/jqx.bootstrap.css" type="media" />
        <link rel="stylesheet" href="Resources/jqx/jqwidgets/styles/jqx.maker.css" type="text/css" />
        <script src="Resources/js/jquery-1.9.0.js"></script>
        <script src="Resources/js/jquery-ui-1.10.0.custom.js"></script>
        <script src="Resources/js/jquery.maskedinput.js" type="text/javascript"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxcore.js"></script>       
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxchart.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxinput.js"></script> 
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxmenu.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.edit.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.sort.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.columnsresize.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.filter.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.grouping.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.selection.js"></script> 
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxdata.js"></script> 
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxdata.export.js"></script> 
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxgrid.export.js"></script> 
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxcheckbox.js"></script> 
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxradiobutton.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxcalendar.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxnumberinput.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxdatetimeinput.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/globalization/globalize.js"></script>        
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxwindow.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxtabs.js"></script>
        <script type="text/javascript" src="Resources/jqx/jqwidgets/jqxtooltip.js"></script>
        <script src="Resources/js/jquery.maskMoney.js"></script>
        <script src="View/MenuPrincipal/js/FuncoesGerais.js?random=<?php echo time(); ?>"></script>
        <script src="Resources/swal/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Resources/swal/dist/sweetalert.css"> 
        <script src="index.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=IBM850; ISO-8859-1">
    </head>
    <body class="body">
        <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N" class="persist">
        <div class="card" style="max-width: 300px;margin-top: 50px;padding-bottom: 20px;">
            <div class="cabecalho" style="margin-top: 0px;margin-bottom: 20px"><img src="Resources/images/maker/logoOficial.png" width="280" alt="Logo MAKER"></div>
            
            <label for="nmeLogin" class="titulo">Login</label>
            <input type="text" id="nmeLogin" name="nmeLogin" class='login input persist' placeholder="Informe o CPF">

            <label for="txtSenha" class="titulo">Senha</label>   
            <input type="password" id="txtSenha" name="txtSenha" class='login input persist' placeholder="Senha">

            <div style="padding-top: 20px;text-align: center;font-size: 16px;">
                <input type="button" id="btnLogin" value="Login" class="button">
            </div>
            
            <div style="padding:20px;text-align:center;">
                <a href="javascript:return false" id="btnEsqueciSenha">Esqueci a senha</a>
            </div>
            
            <div class="titulo">
                <input type="button" id="btnCadastrarParceira" value="Cadastro Parceira" class="button-cadastro" style="margin-left: 5px">
                <input type="button" id="btnCadastrarCliente" value="Cadastro Cliente" class="button-cadastro" style="margin-left: 45px">
            </div>
        </div>
        <div id="ModalPrestador">
            <?php include_once "View/Prestador/CadPrestadorView.php"; ?>
        </div>
        <div id="ModalCliente">
            <?php include_once "View/Cliente/CadClienteView.php"; ?>
        </div>
        <div id="ModalRecuperaSenha">
            <?php include_once "View/Usuario/RecuperaSenhaView.php"; ?>
        </div>
    </body>
</html>
