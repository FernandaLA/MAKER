$(function() {

});

function CarregaLista(dados) {
    MontaCardServico(dados[1], "listagemPendentes");

    // var lista = dados[1];
    // var html = "";
    // if (lista!=null){
    //     for (var i = 0;i < lista.length; i++) {

    //         html +=" <div class='card-prestador'>";
    //         html +=" <table width='100%'>";
    //         html +=" <tr>";
    //         html +="  <td width='8%'>";
    //         html +="   <img style='border-radius:50%' src='../../Resources/images/maker/fotoPerfil.jpg' width='75' alt='foto de Perfil'>";
    //         html +="  </td>";
    //         html +="  <td width='48%' style='text-align:left'>";
    //         html +="   <table width='100%'>";
    //         html +="    <tr><td class='labelFont14' style='font-size: 19px'>"+lista[i]['NME_USUARIO_COMPLETO']+"</td></tr>";
    //         html +="    <tr>";
    //         html +="     <td class='labelFont14' >Avaliação: "+lista[i]['NOTA_USUARIO']+" <span class='oi oi-star' style='color:gold;border-color:khaki;'></span></td>";
    //         html +="    </tr>";
    //         html +="   </table>";
    //         html +="  </td>";
    //         html +="  <td width='44%' style='text-align:left'>";
    //         html +="   <table width='100%' style='border-spacing: 4px'>";
    //         html +="    <tr>";
    //         html +="     <td class='labelFont15'>Data: <div style='color: magenta'>"+lista[i]['DTA_AGENDAMENTO']+"</div>";
    //         html +="     </td>";
    //         html +="    </tr>";
    //         html +="    <tr>";
    //         html +="     <td class='labelFont15'>Horário: <br>";
    //         html +="      <div style='color: magenta'>"+lista[i]['HRA_AGENDAMENTO']+"</div>";
    //         html +="     </td>";
    //         html +="    </tr>";
    //         html +="   </table> ";
    //         html +="  </td>";
    //         html +=" </tr>";
    //         html +=" <tr>";
    //         html +="  <td colspan='4' class='titulo' style='color: purple'>"+servicoAgendado+"</td>";
    //         html +=" </tr>";
    //         html +=" <tr>";
    //         html +="  <td colspan='4' class='titulo' style='color: purple'>";
    //         html +="   <input type='button' id='btnCancelaAgendamento' class='button-default' value='Cancelar'>";
    //         html +="  </td>";
    //         html +=" </tr>";
    //         html +=" </table>";
    //         html +=" </div>";
    //     }
    // } else {
    //     html += "NENHUM REGISTRO ENCONTRADO"
    // }

    // $("#listagemPendentes").html(html);
}

$(document).ready(function() {
    ExecutaDispatch('ServicoPendente', 'ListarServicoPendente', '', CarregaLista);
});