$(function() {
    $("#tmpDuracaoServico").mask('99:99');
    $("#vlrServico").maskMoney({symbol:"R$ ",decimal:",",thousands:"."});

    $('#fechaModalServico').click(function () {
        LimparCampos('cadServico');
        $('#CadServicoPrestador').hide('fade');
    });
    
    $('#btnNovoServico').click(function () {
        LimparCampos('cadServico');
        $(".formServico").show();
        $("#btnNovoServico").hide();
    });

    $('#btnCancelarServico').click(function () {
        LimparCampos('cadServico');
        $(".formServico").hide();
        $("#btnNovoServico").show();
    });

    $('#btnSalvarServico').click(function () {
        var parametros = retornaParametros('cadServico');
        ExecutaDispatch('ServicoPrestador', 'InsertServicoPrestador', parametros, atualizaGridServicos, "Aguarde, salvando serviço", "Serviço cadastrado com sucesso!");
    });

});

function EditarServico(codServicoPrestador, codCategoria, dscServico, vlrServico, duracaoServico) {
    $("#codServico").val(codServicoPrestador);
    $("#codCategoriaSer").val(codCategoria);
    $("#dscServico").val(dscServico);
    $("#vlrServico").val(vlrServico);
    $("#tmpDuracaoServico").val(duracaoServico);
    $(".formServico").show();


}

function ExcluirServico(codServicoPrestador) {
    ExecutaDispatch('ServicoPrestador', 'UpdateServicoPrestador', 'codServicoPrestador;'+codServicoPrestador+'|indAtivo;N', atualizaGridServicos, "Aguarde, excluindo serviço", "Serviço excluído com sucesso!" );
}

function atualizaGridServicos() {
    ExecutaDispatch('ServicoPrestador','ListarServicoPrestador', undefined, MontaGridServicos);
    LimparCampos('cadServico');
    $(".formServico").hide();
    $("#btnNovoServico").show();
}

function montaComboCategoria(arrDados) {
    CriarComboDispatch('codCategoriaSer', arrDados, 0, 'cadServico', 'codCategoria');
}

function MontaGridServicos(lista) {
    var listaServicos = lista[1];
    var nomeGrid = 'listaServicos';
    var source =
    {
        localdata: listaServicos,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
            [
                { name: 'COD_SERVICO_PRESTADOR', type: 'string' },
                { name: 'COD_CATEGORIA', type: 'string' },
                { name: 'DSC_CATEGORIA', type: 'string' },
                { name: 'DSC_SERVICO', type: 'string' },
                { name: 'VLR_SERVICO', type: 'string' },
                { name: 'TMP_DURACAO_SERVICO', type: 'string' },
                { name: 'ACAO', type: 'string' }
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
                { text: 'C&oacute;d.', columntype: 'textbox', datafield: 'COD_SERVICO_PRESTADOR', width: 50 },
                { text: 'Categoria', datafield: 'DSC_CATEGORIA', columntype: 'textbox', width: 150 },
                { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_SERVICO', columntype: 'textbox', width: 230 },
                { text: 'Valor', datafield: 'VLR_SERVICO', columntype: 'textbox', width: 90 },
                { text: 'Dura&ccedil;&atilde;o', datafield: 'TMP_DURACAO_SERVICO', columntype: 'textbox', width: 90 },
                { text: 'A&ccedil;&atilde;o', datafield: 'ACAO', columntype: 'textbox', width: 90, cellsalign: 'center' },
            ]
        });
    // events
    $("#" + nomeGrid).jqxGrid('localizestrings', localizationobj);
    // $('#' + nomeGrid).on('rowdoubleclick', function (event) {
    //     var args = event.args;
    //     var rows = $('#' + nomeGrid).jqxGrid('getdisplayrows');
    //     var rowData = rows[args.visibleindex];
    //     var rowID = rowData.uid;

    //     preencheCamposForm(listaServicos[rowID]);
    //     $("#method").val("UpdateServico");
    // });
}

$(document).ready(function() {
    ExecutaDispatch('CategoriaServico','ListarCategoriaServicoPrestador', undefined, montaComboCategoria);
    ExecutaDispatch('ServicoPrestador','ListarServicoPrestador', undefined, MontaGridServicos);
    $(".formServico").hide();
});