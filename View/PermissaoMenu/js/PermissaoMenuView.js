$(function () {
    $("#btnSalvar").click(function () {
        MontaComboSelecionado();
    });
});

function MontaComboSelecionado() {
    var checkBoxes = '';
    $(".check").each(function () {
        if ($(this).jqxCheckBox('val')) {
            checkBoxes += $(this).attr('codMenu') + '=>SP';
        } else {
            checkBoxes += $(this).attr('codMenu') + '=>NP';
        }
    });
    SalvarPermissoes(checkBoxes);
}

function SalvarPermissoes(checkBoxes) {
    $('#method').val('AtualizaPermissoes');
    ExecutaDispatch('PermissaoMenu', $('#method').val(), 'codPerfil;' + $("#codPerfil").val() + '|C;' + checkBoxes +"|", CarregaListaMenus, 'Aguarde, salvando permissões', 'Permissões Salvas com Sucesso!');
}
function CarregaListaMenus() {
    ExecutaDispatch('PermissaoMenu', 'ListarMenus', 'codPerfil;' + $("#codPerfil").val() + '|', ListaMenus);
}
function ListaMenus(ListaMenus) {
    ListaMenus = ListaMenus[1];
    count = 3;
    tabela = '';
    for (i = 0; i < ListaMenus.length; i++) {
        if (count == 3) {
            tabela += "<tr>";
            count = 0;
        }
        if (ListaMenus[i].DSC_MENU_PAI != null) {
            dscMenu = "<strong>" + ListaMenus[i].DSC_MENU_PAI + "</strong>>>>" + ListaMenus[i].DSC_MENU;
        } else {
            dscMenu = ListaMenus[i].DSC_MENU;
        }
        tabela += "<td width='400px'>";
        tabela += "<div id='chk" + ListaMenus[i].COD_MENU + "' codMenu='" + ListaMenus[i].COD_MENU + "' style='margin-left: 10px; float: left;' class='check'><span>" + dscMenu + "</span></div><br>";
        tabela += "</td>";
        count++;
        if (count == 3) {
            tabela += "</tr>";
        }
    }
    $("#checkboxes").html(tabela);
    var theme = 'maker';
    // Create jqxCheckBox
    $(".check").jqxCheckBox({ height: 25, theme: theme});
    $('.check').jqxCheckBox('uncheck');
    for (i = 0; i < ListaMenus.length; i++) {
        if (ListaMenus[i].PERFIL == null) {
            $("#chk" + ListaMenus[i].COD_MENU).jqxCheckBox('uncheck');
        } else {
            $("#chk" + ListaMenus[i].COD_MENU).jqxCheckBox('check');
        }
    }
    $(".MenusExistentes").show();
}

function CarregaComboPerfil(arrDados) {
    CriarComboDispatch('codPerfil', arrDados, 0, 'persist');
    $("#codPerfil").change(function () {
        if ($(this).val() != 0) {
            CarregaListaMenus();
        } else {
            $(".MenusExistentes").hide();
        }
    });
}

$(document).ready(function () {
    $(".MenusExistentes").hide();
    ExecutaDispatch('Perfil', 'ListarPerfilAtivo', '', CarregaComboPerfil);
});