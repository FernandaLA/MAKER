function ListarMetodos(classe){
    ExecutaDispatch('Menu', 'ListarMetodos', 'classe;'+classe+'|'+'pastaAtual;'+$("#pastaAtual").val()+'|', MontaTabelaMetodos);
}

function MontaTabelaMetodos(data){
    if (data[0]){
        data = data[1];
        tabela = '<table>';
        for (i=0;i<data.length;i++){
            tabela += '<tr>';        
            tabela += '<td><a href="javascript:Utilizar(\''+data[i]+'\');">'+data[i]+'</a></td>';
            tabela += '</tr>';
        }
        tabela += '</table>';
        $("#listaMetodos").html(tabela);
        $("#ListaMetodos").jqxWindow('open');
    }
}

function Utilizar(metodo){
    $("#nmeMethod").val(metodo);
    $("#ListaMetodos").jqxWindow('close');
}