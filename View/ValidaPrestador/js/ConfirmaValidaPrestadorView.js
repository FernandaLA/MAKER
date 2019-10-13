$(function() {
    $("#btnReprovar").click(function() {
        var params = retornaParametros();
        params += 'indAtivo;R|';
        ExecutaDispatch('ValidaPrestador', 'UpdateStatusPrestador', params, retornoValidacao, "Aguarde, atualizando Prestador", "Prestador reprovado com sucesso!" )
    });
    $("#btnAprovar").click(function() {
        var params = retornaParametros();
        params += 'indAtivo;S|';
        ExecutaDispatch('ValidaPrestador', 'UpdateStatusPrestador', params, retornoValidacao, "Aguarde, atualizando Prestador", "Prestador aprovado com sucesso!" )
    });
});