function CarregaMenu(){
    ExecutaDispatch('MenuPrincipal', 'CarregaMenuNew', '', MontaMenuNew);    
}

function MontaMenuNew(dados) {
    // console.log(dados);
    var DadosMenu = dados;
    var html = "<ul style='list-style: none;'>";
    for(var i=0;i<dados[1].length; i++){
        if(dados[1][i]['COD_MENU_PAI'] == 0){
            html += "<li style='display: inline-block;' id='"+dados[1][i]['COD_MENU']+"'>";
            html += dados[1][i]['LABEL'];
            if (dados[1][i]['COD_MENU'] == 1){
                html += "<ul style='list-style: none;width: 200px;'>";
                for(var j=0;j<dados[1].length; j++){
                    if(dados[1][j]['COD_MENU_PAI'] == 1){
                        html += "<li style='width: 99%;' id='"+dados[1][j]['COD_MENU']+"'>";
                        html += dados[1][j]['LABEL'];
                        html += "</li>";
                    }
                }
                html += "</ul>";
            }
            html += "</li>";
        }
    }
    html += "</ul>";
    $('#CriaMenu').html(html);
    $('#CriaMenu').jqxMenu({ width: '99,5%', height: 35, theme: 'styleMaker' });
    $("#CriaMenu").on('itemclick', function (event) {
        for(var i=0;i<DadosMenu[1].length; i++){

            if (event.args.id==DadosMenu[1][i].COD_MENU){                    
                if((DadosMenu[1][i].NME_CONTROLLER!='#') && (DadosMenu[1][i].NME_CONTROLLER!=null) && (DadosMenu[1][i].NME_CONTROLLER!='')){
                    RedirecionaController(DadosMenu[1][i].NME_CONTROLLER, DadosMenu[1][i].NME_METHOD);
                }
            }
        }
    });
}

// function MontaMenu(menu){
//     var DadosMenu = '';
//     DadosMenu = menu;
//     if (DadosMenu[0]){
//         var source =
//         {
//             datatype: "json",
//             datafields: [
//                 { name: 'id', map: 'COD_MENU' },
//                 { name: 'idPai', map: 'COD_MENU_PAI' },
//                 { name: 'dscMenu', map: 'DSC_MENU' },
//                 { name: 'labelMenu', map: 'LABEL' },
//                 { name: 'subMenuWidth', map: 'VLR_TAMANHO_SUBMENU' }
//             ],
//             id: 'id',
//             localdata: DadosMenu[1]
//         };
//         var dataAdapter = new $.jqx.dataAdapter(source);
//         dataAdapter.dataBind();
//         var records = dataAdapter.getRecordsHierarchy('id', 'idPai', 'items', [
//             // {name: 'dscMenu', map: 'label'},
//             {name: 'labelMenu', map: 'label'},
//             {name: 'id', map: 'id'}
//         ]);
//         $('#CriaMenu').jqxMenu({ source: records, height: 45, theme: 'styleMaker' });
//         $("#CriaMenu").on('itemclick', function (event) {
//             for(var i=0;i<DadosMenu[1].length; i++){

//                 if (event.args.id==DadosMenu[1][i].COD_MENU){                    
//                     if((DadosMenu[1][i].NME_CONTROLLER!='#') && (DadosMenu[1][i].NME_CONTROLLER!=null) && (DadosMenu[1][i].NME_CONTROLLER!='')){
//                         RedirecionaController(DadosMenu[1][i].NME_CONTROLLER, DadosMenu[1][i].NME_METHOD);
//                     }
//                 }
//             }
//         });
//     }
// }

function CriarDivAutoComplete(nmeInput, url, method, dataFields, displayMember, valueMember, callback, width){ 
    if ( $("#divAutoComplete").length ){
        $("#divAutoComplete").jqxWindow("destroy");
    }
    $("#teste").html("");
    $("#teste").html('<div id="divAutoComplete"><div id="windowHeader" style="display: none;"></div><div style="overflow: hidden;" id="windowContent"><div id="listaPesquisa"></div></div> ');
    var largura = $("#"+nmeInput).width();
    if (width!=undefined){
        largura = width;
    }
    $("#divAutoComplete").jqxWindow({ 
        height: 250,
        width: largura,
        showCloseButton: false,
        maxWidth: 1200,
        position: { x: $("#"+nmeInput).offset().left, y: $("#"+nmeInput).offset().top+25 },
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: 'darkcyan',
        isModal: false,
        autoOpen: false
    });           
    $("#divAutoComplete").jqxWindow("open");
    var dados = dataFields.split('|');
    var lista = new Array();
    for (var i=0;i<dados.length;i++){
        var data = new Object();
        var campos = dados[i].split(';');
        data.name = campos[1];
        lista.push(data);
    }
    var url = url;
    var source =
    {
        datatype: "json",
        datafields: lista,
        type: "POST",
        id: valueMember,
        url: url,
        data: 
            {method: method,
            term: $("#"+nmeInput).val()}
        
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    // Create a jqxListBox
    $("#listaPesquisa").jqxListBox({ 
        source: dataAdapter, 
        displayMember: displayMember, 
        valueMember: valueMember, 
        width: largura-5, 
        height: 240
    });
    $("#listaPesquisa").on('keyup', function(event){       
       if (event.keyCode==13){
           SelecionaItem($("#listaPesquisa").jqxListBox('getSelectedItem'), dataAdapter, dataFields, callback);
       }
    });
    $("#listaPesquisa").on('select', function (event) {     
        
        if (event.args.type=='mouse'){ 
            SelecionaItem(event.args.item, dataAdapter, dataFields, callback);
        }
    });
}

function SelecionaItem(event, dataAdapter, dataFields, callback){    
    var item = event;
    if (item) {
        var x=[]       
        $.each(dataAdapter.records, function(i,n) {
            x.push(n);
        });        
        for (var j=0;j<x.length;j++){
            var dados = dataFields.split('|');
            for (var i=0;i<dados.length;i++){ 
                if (item.originalItem.id==x[j]['id']){
                    
                    var campos = dados[i].split(';');
                    if (campos[0]!=''){
                        $("#"+campos[0]).val(x[j][campos[1]]);
                        if ( $("#divAutoComplete").length ){
                            $("#divAutoComplete").jqxWindow("destroy");
                        }
                    }
                }
            }              
        }
        if (callback!=null){
            eval(callback);
        }                
    }
}

function CriarComboDispatch(nmeCombo, arrDados, valor, classe, name){ 
    if(name == undefined){
        name = nmeCombo;
    }
    $("#td"+nmeCombo).html('');
    var select = '<select id="'+nmeCombo+'" name="'+name+'" class="'+classe+' input" style="background-color: white;">';
    select += '<option value="'+valor+'" disabled selected>Selecione...</option>';
    for (var i=0;i<arrDados[1].length;i++){
        select += '<option value="'+arrDados[1][i]['COD']+'">'+arrDados[1][i]['DSC']+'</option>';
        
    }
    select += '</select>';
    $("#td"+nmeCombo).html(select);
    $("#"+nmeCombo).jqxDropDownList({dropDownHeight: '150px'});
    $("#"+nmeCombo).attr('parm', name);
    return false;
}


/**
 * 
 * @param {*} Controller 
 * @param {*} Method 
 * @param {*} Parametros // NÂO UTULIZE ; PARA CONCATENAR INFORMAÇÕES DE UM CAMPO!!! 
 * @param {*} Callback 
 * @param {*} MensagemAguarde 
 * @param {*} MensagemRetorno 
 */
function ExecutaDispatch(Controller, Method, Parametros, Callback, MensagemAguarde, MensagemRetorno){
    if (MensagemAguarde!=undefined){
        swal({
            title: MensagemAguarde,
            imageUrl: "../../Resources/images/preload.gif",
            showConfirmButton: false
        });
    }
    var obj = new Object();
    Object.defineProperty(obj, 'method', {
        __proto__: null,
        enumerable : true,
        configurable : true,
        value: Method
    });    
    Object.defineProperty(obj, 'controller', {
        __proto__: null,
        enumerable : true,
        configurable : true,
        value: Controller
    });        
    if (Parametros != undefined){
        var dados = Parametros.split('|'); 
        for (var i=0;i<dados.length;i++){
            var campos = dados[i].split(';');
            Object.defineProperty(obj, campos[0], {
                                __proto__: null,
                                enumerable : true,
                                configurable : true,
                                value: campos[1] });
        }    
    }
    $.post('../../Dispatch.php',
        obj,
        function(retorno){
            retorno = eval ('('+retorno+')');
            if (retorno[0]==true){
                if (MensagemRetorno!=undefined){
                    $(".jquery-waiting-base-container").fadeOut({modo:"fast"});
                    swal({
                        title: "Sucesso!",
                        text: MensagemRetorno,
                        showConfirmButton: false,
                        type: "success"
                    });
                    setTimeout(function(){
                        swal.close();
                    }, 2000);
                }
                if (Callback!=undefined){
                    Callback(retorno);
                }
            }else{
                $(".jquery-waiting-base-container").fadeOut({modo:"fast"});
                swal({
                    title: "Erro ao executar!",
                    text: "Erro: "+retorno[1],
                    type: "error",
                    confirmButtonText: "Fechar"
                });
             }
        }
    );     
}

function ExecutaDispatchUpload(Controller, Method, Parametros, Callback, MensagemAguarde, MensagemRetorno){
    if (MensagemAguarde!=undefined){
        swal({
            title: MensagemAguarde,
            imageUrl: "../../Resources/images/preload.gif",
            showConfirmButton: false
        });
    }
    $.ajax({
        url: '../../Dispatch.php?controller='+Controller+'&method='+Method,
        type: 'POST',
        // Form data
        data: Parametros,
        //Options to tell JQuery not to process data or worry about content-type
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            data = eval('('+data+')');
            if(data[0] == true){
                if (MensagemRetorno!=undefined){
                    $(".jquery-waiting-base-container").fadeOut({modo:"fast"});
                    swal({
                        title: "Sucesso!",
                        text: MensagemRetorno,
                        showConfirmButton: false,
                        type: "success"
                    });
                    setTimeout(function(){
                        swal.close();
                    }, 2000);
                }                
                if (Callback!=undefined){
                    Callback(data);
                }
            } else {
                $(".jquery-waiting-base-container").fadeOut({modo:"fast"});
                swal({
                    title: "Erro!",
                    text: "Erro ao fazer upload do arquivo!",
                    type: "error",
                    confirmButtonText: "Fechar"
                });
            }
        }
    });     
}

function retornaParametros(classe){
    if (classe==undefined){
        classe = 'persist';
    }
    var name;
    var value;
    var retorno='';
    $("."+classe).each(function(index) { 
        if ($(this).attr('parm')!=undefined){
            name = $(this).attr('parm');
        }else{
            name = $(this).prop('name');
        }
        switch ($(this).attr('type')) {
            case 'checkbox':
                if ($(this).is(":checked")){
                    value = 'S';
                }else{
                    value = 'N';
                }
                break;
                
            default:
                value = $(this).val();
                break;
        }
        retorno += name+';'+value+'|';
    });
    return retorno;
}

/**
 * 
 * @param {type} arrCampos
 * @param {type} valorPadrao (Passar o nome do campo concatenado com ';' e após o tipo do campo e depois '|' ex.:IND_ATIVO;B|
 * @returns {undefined}
 */
function preencheCamposForm(arrCampos, valorPadrao){
    var entrou = false;
    for (var k in arrCampos){
        if (typeof arrCampos[k] !== 'function') {
            var LK = k.toLowerCase();
            var ret = LK.split('_');
            var campo='';
            for (var i=0;i<ret.length;i++){
                if (i>0){
                    campo += ret[i].substring(0,1).toUpperCase()+ret[i].substring(1,ret[i].lenght);
                }else{
                    campo = ret[i];
                }
            }
            if (valorPadrao!=undefined){
                var valores = valorPadrao.split('|');
                for (i=0;i<valores.length;i++){
                    var tipo = valores[i].split(';');
                    var entrou = false;
                    if (tipo[0]==campo){
                        switch (tipo[1]) {
                            case 'B':
                                if (arrCampos[k]=='S'){
                                    $("#"+campo).prop('checked', true);
                                }else{
                                    $("#"+campo).prop('checked', false);
                                }
                                break;
                            default:
                                $("#"+campo).val(arrCampos[k]);
                                break;
                        }
                        entrou=true;
                    }
                }
            }
            if (!entrou){
                $("#"+campo).val(arrCampos[k]);
            }
        }
    }
}

function LimparCampos(classe){
    if (classe == undefined) {
        classe = 'persist';
    }
    $("."+classe).each(function(index) { 
        switch ($(this).attr('type')) {
            case 'radio':
            case 'checkbox':
                $(this).prop("checked", false);
                break;                
            case 'file':
                $(this).replaceWith($(this).val('').clone(true));
                break;
            case 'text':
            case 'hidden':
                $(this).val('');
                break;                
            default:
                $(this).val('0');
                break;
        }
    });
}


function RedirecionaController(Controller, Method){
    $(location).attr('href','../../Dispatch.php?controller='+Controller+'&method='+Method);
}