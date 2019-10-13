$(function () {
    $("#ConfirmaValidacao").jqxWindow({
        autoOpen: false,
        height: 360,
        width: 480,
        theme: 'darkcyan',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Cadastro de Usu&aacute;rios',
        isModal: true
    });
    $("#btnNovo").click(function () {
        LimparCampos();
        $("#ConfirmaValidacao").jqxWindow("open");
    });
});

function CarregaGridUsuario() {
    ExecutaDispatch('ValidaPrestador', 'ListarPrestadoresPendentes', undefined, retornoGridUsuario);
}

function retornoGridUsuario(retorno) {
    $("#codUsuario").val('');
    MontaTabelaUsuario(retorno[1]);
}

function MontaTabelaUsuario(listaUsuario) {
    var nomeGrid = 'listaPrestadores';
    var source =
    {
        localdata: listaUsuario,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
            [
                { name: 'COD_USUARIO', type: 'string' },
                { name: 'NME_COMPLETO', type: 'string' },
                { name: 'NRO_CPF', type: 'string' },
                { name: 'DSC_CAMINHO_CERTIFICADO', type: 'string' }

            ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#" + nomeGrid).jqxGrid(
        {
            width: 700,
            source: dataAdapter,
            theme: 'styleMaker',
            sortable: true,
            filterable: true,
            pageable: true,
            columnsresize: true,
            selectionmode: 'singlerow',
            columns: [
                { text: 'C&oacute;d', columntype: 'textbox', datafield: 'COD_USUARIO', width: 50 },
                { text: 'Nome Completo', datafield: 'NME_COMPLETO', columntype: 'textbox', width: 320 },
                { text: 'CPF', datafield: 'NRO_CPF', columntype: 'textbox', width: 150 }
            ]
        });
    // events

    $("#" + nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#' + nomeGrid).on('rowdoubleclick', function (event) {
        var args = event.args;
        var rows = $('#listaPrestadores').jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;
        preencheCamposForm(listaUsuario[rowID]);
        $("#ConfirmaValidacao").jqxWindow("open");
    });
}

$(document).ready(function () {
    CarregaGridUsuario();
});