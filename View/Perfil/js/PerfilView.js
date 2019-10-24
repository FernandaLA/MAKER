$(function () {
    $("#listaPerfil").jqxTooltip({
        content: 'D&ecirc; um duplo clique para editar',
        position: 'mouse',
        name: 'movieTooltip',
        theme: 'maker'
    });

    $("#btnNovo").click(function () {
        LimparCampos();
    });

    $("#btnSalvar").click(function () {
        SalvarPerfil();
    });
});

function SalvarPerfil(method){
    var method='';
    if ($("#codPerfil").val() != '') {
        method = "UpdatePerfil";
    } else {
        method = "AddPerfil";
    }
    var parametros = retornaParametros();
    ExecutaDispatch('Perfil', method, parametros, retornoSalvarPerfil, 'Aguarde, Salvando Perfil!', 'Perfil Salvo com Sucesso!');
}

function retornoSalvarPerfil() {
    LimparCampos();
    carregaGridPerfil();
}

function carregaGridPerfil() {
    ExecutaDispatch('Perfil', 'ListarPerfil', undefined, montaTabelaPerfil);
}

function montaTabelaPerfil(listaPerfil) {
    listaPerfil = listaPerfil[1];
    var nomeGrid = 'listaPerfil';
    var source =
    {
        localdata: listaPerfil,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
            [
                { name: 'COD_PERFIL', type: 'string' },
                { name: 'DSC_PERFIL', type: 'string' },
                { name: 'IND_ATIVO', type: 'string' },
                { name: 'ATIVO', type: 'boolean' }
            ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#" + nomeGrid).jqxGrid(
        {
            width: 500,
            source: dataAdapter,
            theme: 'maker',
            selectionmode: 'singlerow',
            sortable: true,
            filterable: true,
            pageable: true,
            columnsresize: true,
            columns: [
                { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_PERFIL', width: 80 },
                { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_PERFIL', columntype: 'textbox', width: 280 },
                { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 67 }
            ]
        });
    $("#" + nomeGrid).jqxGrid('localizestrings', localizationobj);
    // events
    $('#' + nomeGrid).on('rowdoubleclick', function (event) {
        var args = event.args;
        var rows = $('#' + nomeGrid).jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;
        preencheCamposForm(listaPerfil[rowID],'indAtivo;B|');
    });
}

$(document).ready(function () {
    carregaGridPerfil();
});

