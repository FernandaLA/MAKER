function CarregaMenu(){
    ExecutaDispatch('MenuPrincipal', 'CarregaMenuNew', '', MontaMenuNew);    
}

function MontaMenuNew(dados) {
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
    $('#CriaMenu').jqxMenu({ width: '99,5%', height: 35, theme: 'maker' });
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
        theme: 'maker',
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
    if (arrDados[1] !== null){
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
function preencheCamposForm(arrCampos, final = "", valorPadrao){
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
                $("#"+campo+final).val(arrCampos[k]);
            }
        }
    }
}

// /**
//  * 
//  * @param {type} arrCampos
//  * @param {type} valorPadrao (Passar o nome do campo concatenado com ';' e após o tipo do campo e depois '|' ex.:IND_ATIVO;B|
//  * @returns {undefined}
//  */
// function preencheCamposFormPre(arrCampos, final, valorPadrao){
//     var entrou = false;
//     for (var k in arrCampos){
//         if (typeof arrCampos[k] !== 'function') {
//             var LK = k.toLowerCase();
//             var ret = LK.split('_');
//             var campo='';
//             for (var i=0;i<ret.length;i++){
//                 if (i>0){
//                     campo += ret[i].substring(0,1).toUpperCase()+ret[i].substring(1,ret[i].lenght);
//                 }else{
//                     campo = ret[i];
//                 }
//             }
//             if (valorPadrao!=undefined){
//                 var valores = valorPadrao.split('|');
//                 for (i=0;i<valores.length;i++){
//                     var tipo = valores[i].split(';');
//                     var entrou = false;
//                     if (tipo[0]==campo){
//                         switch (tipo[1]) {
//                             case 'B':
//                                 if (arrCampos[k]=='S'){
//                                     $("#"+campo).prop('checked', true);
//                                 }else{
//                                     $("#"+campo).prop('checked', false);
//                                 }
//                                 break;
//                             default:
//                                 $("#"+campo).val(arrCampos[k]);
//                                 break;
//                         }
//                         entrou=true;
//                     }
//                 }
//             }
//             if (!entrou){
//                 $("#"+campo+"Pre").val(arrCampos[k]);
//             }
//         }
//     }
// }

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

function MontaCardServico(lista, nmeCampo, acao = false){
    var html = "";
    if (lista!=null){
        for (var i = 0;i < lista.length; i++) {
            var categorias = "";
            for(var j = 0; j<lista[i]['LISTA_CATEGORIAS'].length; j++) {
                if(lista[i]['LISTA_CATEGORIAS'][j]['COD'] != 0) {
                    categorias += "<u>"+lista[i]['LISTA_CATEGORIAS'][j]['DSC']+"</u> - ";
                }
            }
            var listaCategorias = categorias.substr(0, categorias.length-3);
            if (lista[i]['DSC_CAMINHO_FOTO'] !== '') {
                var fotoHome = lista[i]['DSC_CAMINHO_FOTO'];
            }

            var DIAS = lista[i]['DIAS_ATENDIMENTO'];
            var jornadaDias = "";
            if (DIAS != null) {
                for (var h=0;h<DIAS.length;h++) {
                    jornadaDias += DIAS[h]['DSC_DIA']+'-';
                }
                jornadaDias = jornadaDias.substr(0, jornadaDias.length-1);
            }
            html +=" <div class='card-prestador'>";
            html +=" <table width='100%'>";
            html +=" <tr>";
            html +="  <td width='8%'>";
            html +="   <img id='fotoHome' style='border-radius:50%' src='"+fotoHome?fotoHome:+"../../Resources/images/maker/semFoto.jpeg' width='75' alt='foto de Perfil'>";
            html +="  </td>";
            html +="  <td width='70%' style='text-align:left'>";
            html +="   <table width='100%'>";
            html +="    <tr><td class='labelFont14' style='font-size: 19px'>"+lista[i]['NME_USUARIO_COMPLETO']+"</td></tr>";
            html +="    <tr>";
            html +="     <td class='labelFont14' >Avaliação: "+lista[i]['NOTA_PRESTADOR']+" <span class='oi oi-star' style='color:gold;border-color:khaki;'></span></td>";
            html +="    </tr>";
            html +="   </table>";
            html +="  </td>";
            if (acao) {
                html +="  <td rowspan=3 style='font-size: 25px;text-align: right;color:grey' title='Agendar com esse prestador' onClick='javascript: AbreModalAgendamento("+lista[i]['COD_USUARIO']+")'>";
                html +="    <span class='oi oi-chevron-right'></span>"; // icone seta '>'
                html +="  </td>";
            }
            html +=" </tr>";
            html +=" <tr>";
            html +="  <td colspan='3'>";
            html +="   <table width='100%' style='border-spacing: 4px'>";
            html +="    <tr>";
            html +="     <td class='labelFont15'>Jornada: "
            html +="      <span style='color: magenta'>"+lista[i]['JORNADA_PRESTADOR']+"</span>";
            html +="     </td>";
            html +="    </tr>";
            html +="    <tr>";
            html +="     <td class='labelFont15'>Dias de Atendimento: ";
            html +="      <span style='color: magenta'>"+jornadaDias+"</span>";
            html +="     </td>";
            html +="    </tr>";
            html +="   </table> ";
            html +="  </td>";
            html +=" </tr>";
            html +=" <tr>";
            html +="  <td colspan='3' class='titulo' style='color: purple'>"+listaCategorias+"</td>";
            html +=" </tr>";
            html +=" </table>";
            if(lista[i]['SITUACAO'] == 'Realizado') {
                html +="<hr>";
                html +="<table>";
                html +=" <tr>";
                html +="  <td>";
                html +="   <button class='btn-success'>";
                html +="    <span class='oi oi-circle-check'></span> Finalizar";
                html +="   </button> ";
                html +="  </td>";
                html +=" </tr>";
                html +="</table>";
            }
            if(lista[i]['SITUACAO'] == 'Pendente') {
                html +="<hr>";
                html +="<table>";
                html +=" <tr>";
                html +="  <td>";
                html +="   <button class='btn-danger'>";
                html +="    <span class='oi oi-thumbs-down'></span> Recusar";
                html +="   </button> ";
                html +="  </td>";
                html +="  <td>";
                html +="   <button class='btn-success'>";
                html +="    <span class='oi oi-thumbs-up'></span> Aceitar";
                html +="   </button> ";
                html +="  </td>";
                html +=" </tr>";
                html +="</table>";
            }
            if(lista[i]['SITUACAO'] == 'Confirmado') {
                html +="<hr>";
                html +="<table>";
                html +=" <tr>";
                html +="  <td>";
                html +="   <button class='button-default'>";
                html +="    <span class='oi oi-x'></span> Cancelar";
                html +="   </button> ";
                html +="  </td>";
                html +=" </tr>";
                html +="</table>";
            }
            html +=" </div>";
        }
    } else {
        html += "<h4 style='text-align: center;'>NENHUM REGISTRO ENCONTRADO</h4>"
    }

    $("#"+nmeCampo).html(html);
}