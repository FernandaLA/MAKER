function ListarController(dir){
    if (dir==undefined){
        ExecutaDispatch('Menu', 'listarController', undefined, MontaTabelaController);
    }else{
        ExecutaDispatch('Menu', 'listarController', 'pasta;'+dir+'|', MontaTabelaController);
        
    }
    $("#pastaAtual").val(dir);
}

function MontaTabelaController(data){
    data = data[1];
    tabela = '<table>';
    for (i=0;i<data.length;i++){
        tabela += '<tr>';        
        if (data[i].dscTipo=='file'){
            tabela += '<td>'+data[i].nmeArquivo+'</td>';
            tabela += '<td><a href="javascript:UtilizarController(\''+data[i].nmeArquivo+'\');">Utilizar</a></td>';
        }else{
            tabela += '<td><a href="javascript:ListarController(\''+data[i].nmeArquivo+'\');">'+data[i].nmeArquivo+'</a></td>';
            tabela += '<td><br></td>';
        }
        
        tabela += '</tr>';
    }
    tabela += '</table>';
    $("#listaController").html(tabela);
}

function UtilizarController(Controller){
    Controller = Controller.replace("Controller.php","");
    $("#nmeController").val(Controller);
    $("#nmeClasse").val(Controller);
    $("#ListaController").jqxWindow('close');
}