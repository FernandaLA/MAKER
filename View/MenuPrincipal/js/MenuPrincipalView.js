$(function() {
    $("#btnPesquisar").click(function() {
        var parametros = retornaParametros();
        ExecutaDispatch('Cliente', 'CarregaListaPrestadores', parametros, CarregaLista);
    });
});

function CarregaLista(dados) {
    var lista = dados[1];
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

            var DIAS = lista[i]['DIAS_ATENDIMENTO'];
            var jornadaDias = "";
            if (DIAS != null) {
                for (var h=0;h<DIAS.length;h++) {
                    jornadaDias += DIAS[h]['DSC_DIA']+'-';
                }
                jornadaDias = jornadaDias.substr(0, jornadaDias.length-1);
            }
            html +=" <div class='card-prestador' onClick='javascript: SolicitarAgendamento("+lista[i]['COD_USUARIO']+")'>";
            html +=" <table width='100%'>";
            html +=" <tr>";
            html +="  <td width='8%'>";
            html +="   <img style='border-radius:50%' src='../../Resources/images/maker/fotoPerfil.jpg' width='75' alt='foto de Perfil'>";
            html +="  </td>";
            html +="  <td width='48%' style='text-align:left'>";
            html +="   <table width='100%'>";
            html +="    <tr><td class='labelFont14' style='font-size: 19px'>"+lista[i]['NME_USUARIO_COMPLETO']+"</td></tr>";
            html +="    <tr>";
            html +="     <td class='labelFont14' >Avaliação: "+lista[i]['NOTA_PRESTADOR']+" <span class='oi oi-star' style='color:gold;border-color:khaki;'></span></td>";
            html +="    </tr>";
            html +="   </table>";
            html +="  </td>";
            html +="  <td width='44%' style='text-align:left'>";
            html +="   <table width='100%' style='border-spacing: 4px'>";
            html +="    <tr>";
            html +="     <td class='labelFont15'>Jornada: <div style='color: magenta'>"+lista[i]['JORNADA_PRESTADOR']+"</div>";
            html +="     </td>";
            html +="    </tr>";
            html +="    <tr>";
            html +="     <td class='labelFont15'>Dias de Atendimento: <br>";
            html +="      <div style='color: magenta'>"+jornadaDias+"</div>";
            html +="     </td>";
            html +="    </tr>";
            html +="   </table> ";
            html +="  </td>";
            html +="  <td rowspan=2 style='font-size: 14px' title='Agendar com esse prestador' onClick='javascript: SolicitarAgendamento("+lista[i]['COD_USUARIO']+")'>";
            html +="    <span class='io io-chevron-right'></span>"; // icone seta '>'
            html +="  </td>";
            html +=" </tr>";
            html +=" <tr>";
            html +="  <td colspan='4' class='titulo' style='color: purple'>"+listaCategorias+"</td>";
            html +=" </tr>";
            html +=" </table>";
            html +=" </div>";
        }
    } else {
        html += "NENHUM REGISTRO ENCONTRADO"
    }
    
    $("#listagemPrestadores").html(html);
}

function MontaComboCategorias(arrDados) {
    CriarComboDispatch('codCategoria', arrDados, 0, 'persist');
}

function SolicitarAgendamento(codPrestador) {
    $('#codPrestador').val(codPrestador);
    $('#CadAgendamento').show('fade');
}

$(document).ready(function() {
    ExecutaDispatch('Cliente', 'CarregaListaPrestadores', '', CarregaLista);
    ExecutaDispatch('CategoriaServico', 'ListarCategoriaServicoAtivo', undefined, MontaComboCategorias);
});
