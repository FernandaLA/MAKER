$(function() {
    $("#btnReprovar").click(function() {
        var params = retornaParametros();
        params += 'indAtivo;R|';
        ExecutaDispatch('ValidaPrestador', 'UpdateStatusPrestador', params, retornoValidacao, "Aguarde, atualizando Prestador", "Prestador recusado com sucesso!" )
    });
    $("#btnAprovar").click(function() {
        var params = retornaParametros();
        params += 'indAtivo;S|';
        console.log(params);
        ExecutaDispatch('ValidaPrestador', 'UpdateStatusPrestador', params, retornoValidacao, "Aguarde, atualizando Prestador", "Prestador aprovado com sucesso!" )
    });
});

function retornoValidacao() {
    CarregaGridUsuario();
    $("#ConfirmaValidacao").jqxWindow("close");
}