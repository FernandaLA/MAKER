$(function () {
    $("#CadUsuarios").jqxWindow({
        autoOpen: false,
        height: 360,
        width: 480,
        theme: 'maker',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Cadastro de Usu&aacute;rios',
        isModal: true
    });
    $("#btnNovo").click(function () {
        LimparCampos();
        $("#CadUsuarios").jqxWindow("open");
    });
});

function CarregaGridUsuario() {
    ExecutaDispatch('Usuario', 'ListarUsuario', undefined, retornoGridUsuario);
}

function retornoGridUsuario(retorno) {
    $("#codUsuario").val('');
    MontaTabelaUsuario(retorno[1]);
}

function MontaTabelaUsuario(listaUsuario) {
    var nomeGrid = 'listaUsuarios';
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
                { name: 'NME_USUARIO', type: 'string' },
                { name: 'COD_PERFIL', type: 'string' },
                { name: 'DSC_PERFIL', type: 'string' },
                { name: 'IND_ATIVO', type: 'string' },
                { name: 'ATIVO', type: 'boolean' },
                { name: 'NRO_CPF', type: 'string' },
                { name: 'TXT_EMAIL', type: 'string' }
            ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#" + nomeGrid).jqxGrid(
        {
            width: 700,
            source: dataAdapter,
            theme: 'maker',
            sortable: true,
            filterable: true,
            pageable: true,
            columnsresize: true,
            selectionmode: 'singlerow',
            columns: [
                { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_USUARIO', width: 70 },
                { text: 'Login', datafield: 'NME_USUARIO', columntype: 'textbox', width: 170 },
                { text: 'Perfil', datafield: 'DSC_PERFIL', columntype: 'textbox', width: 180 },
                { text: 'CPF', datafield: 'NRO_CPF', columntype: 'textbox', width: 180 },
                { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 60, align: 'center' }
            ]
        });
    // events
    $('#' + nomeGrid).jqxGrid('hidecolumn', 'NRO_CPF');

    $("#" + nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#' + nomeGrid).on('rowdoubleclick', function (event) {
        var args = event.args;
        var rows = $('#listaUsuarios').jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;
        preencheCamposForm(listaUsuario[rowID],'indAtivo;B|');
        $("#method").val("UpdateMenu");
        $("#CadUsuarios").jqxWindow("open");
    });
}

$(document).ready(function () {
    ExecutaDispatch('Perfil', 'ListarPerfilAtivo', undefined, CarregaComboPerfil);
    CarregaGridUsuario();
});