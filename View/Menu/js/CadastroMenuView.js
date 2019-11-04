$(function () {
    $("#CadMenus").jqxWindow({
        title: 'Cadastro de Menus',
        height: 550,
        width: 650,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: 'maker',
        isModal: true,
        autoOpen: false,
        position: { x: 435, y: 90 }
    });
    $("#ListaController").jqxWindow({
        title: 'Lista de Controllers',
        height: 450,
        width: 700,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: 'maker',
        isModal: true,
        autoOpen: false
    });
    $("#ListaMetodos").jqxWindow({
        title: 'Lista de Metodos',
        height: 450,
        width: 700,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: 'maker',
        isModal: true,
        autoOpen: false
    });

    $("#btnNovo").click(function () {
        ExecutaDispatch('Menu', 'ListaMenus', '', MontaComboMenu);
        LimparCampos();
        $("#CadMenus").jqxWindow("open");
    });
});

function CarregaGridMenu(listaMenus) {
    MontaTabelaMenu(listaMenus[1]);
}

function MontaTabelaMenu(listaMenus) {
    var nomeGrid = 'listaMenus';
    var contextMenu = $("#jqxMenu").jqxMenu({ width: '120px', autoOpenPopup: false, mode: 'popup', theme: 'maker' });
    var source =
    {
        localdata: listaMenus,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
            [
                { name: 'COD_MENU', type: 'string' },
                { name: 'DSC_MENU', type: 'string' },
                { name: 'NME_CONTROLLER', type: 'string' },
                { name: 'NME_METHOD', type: 'string' },
                { name: 'DSC_CAMINHO_IMAGEM', type: 'string' },
                { name: 'COD_MENU_PAI', type: 'string' },
                { name: 'DSC_MENU_PAI', type: 'string' },
                { name: 'ATIVO', type: 'boolean' },
                { name: 'ATALHO', type: 'boolean' },
                { name: 'VISIBLE', type: 'boolean' }
            ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#" + nomeGrid).jqxGrid(
        {
            width: "100%",
            source: dataAdapter,
            theme: 'maker',
            sortable: true,
            filterable: true,
            pageable: true,
            columnsresize: true,
            selectionmode: 'singlerow',
            columns: [
                { text: 'C&oacute;d.', columntype: 'textbox', datafield: 'COD_MENU', width: 40 },
                { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_MENU', columntype: 'textbox', width: 195 },
                { text: 'Controller', datafield: 'NME_CONTROLLER', columntype: 'textbox', width: 110 },
                { text: 'Method', datafield: 'NME_METHOD', columntype: 'textbox', width: 185 },
                // { text: 'Imagem', datafield: 'DSC_CAMINHO_IMAGEM', columntype: 'textbox', width: 180 },
                { text: 'Menu Pai', datafield: 'DSC_MENU_PAI', columntype: 'textbox', width: 100 },
                { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 48, align: 'center' },
                // { text: 'Atalho', datafield: 'ATALHO', columntype: 'checkbox', width: 50, align: 'center' },
                { text: 'Visível', datafield: 'VISIBLE', columntype: 'checkbox', width: 55, align: 'center' }
            ]
        });
    // events
    $('#' + nomeGrid).on('rowclick', function (event) {
        var args = event.args;

        if (event.args.rightclick) {

            $("#listaMenus").jqxGrid('selectrow', event.args.rowindex);
            var scrollTop = $(window).scrollTop();
            var scrollLeft = $(window).scrollLeft();
            contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
            $("#codMenu").val($('#listaMenus').jqxGrid('getrowdatabyid', args.rowindex).COD_MENU);
            $("#dscMenu").val($('#listaMenus').jqxGrid('getrowdatabyid', args.rowindex).DSC_MENU);
            $("#nmeController").val($('#listaMenus').jqxGrid('getrowdatabyid', args.rowindex).NME_CONTROLLER);
            $("#nmeMethod").val($('#listaMenus').jqxGrid('getrowdatabyid', args.rowindex).NME_METHOD);
            $("#dscCaminhoImagem").val($('#listaMenus').jqxGrid('getrowdatabyid', args.rowindex).DSC_CAMINHO_IMAGEM);
            $("#codMenuPai").val($('#listaMenus').jqxGrid('getrowdatabyid', args.rowindex).COD_MENU_PAI);
            $("#indAtivo").prop("checked", $('#listaMenus').jqxGrid('getrowdatabyid', args.rowindex).ATIVO);
            $("#indAtalho").prop("checked", $('#listaMenus').jqxGrid('getrowdatabyid', args.rowindex).ATALHO);
            $("#indVisible").prop("checked", $('#' + nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).VISIBLE);
            return false;
        }
    });
    $("#" + nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#' + nomeGrid).on('rowdoubleclick', function (event) {
        var args = event.args;
        var rows = $('#' + nomeGrid).jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;

        preencheCamposForm(listaMenus[rowID], '', 'indAtivo;B|indAtalho;B|indVisible;B|');
        $("#method").val("UpdateMenu");
        $("#CadMenus").jqxWindow("open");
    });

}
$(document).ready(function () {
    ExecutaDispatch('Menu', 'ListaMenus', '', MontaComboMenu);
    ExecutaDispatch('Menu', 'ListarMenusGrid', '', CarregaGridMenu);
    $(document).on('contextmenu', function (e) {
        return false;
    });
    $("#jqxMenu").on('itemclick', function (event) {
        var args = event.args;
        if ($.trim($(args).text()) == "Editar") {
            $("#CadMenus").jqxWindow("open");
        } else if ($.trim($(args).text()) == "Novo") {
            LimparCampos();
            $("#CadMenus").jqxWindow("open");
        }
    });
});