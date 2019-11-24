$(function () {
    $("#btnDeletar").click(function () {
        DeleteMenu();
    });
    $("#btnSalvar").click(function () {
        salvarMenu();
    });
    $("#btnListarController").click(function () {
        ListarController(undefined);
        $("#ListaController").jqxWindow('open');
    });
    $("#btnListarMetodos").click(function () {
        ListarMetodos($("#nmeClasse").val());
    });
});

function salvarMenu(data) {
    // swal({
    //     title: 'Aguarde, salvando menu!',
    //     imageUrl: "../../Resources/images/preload.gif",
    //     showConfirmButton: false
    // });
    if ($('#codMenu').val() == '') {
        $("#method").val('AddMenu');
    } else {
        $("#method").val('UpdateMenu');
    }
    var parametros = retornaParametros();
    parametros +="codMenuPai;"+$("#codMenuPai").val()+"|";
    ExecutaDispatch('Menu', $("#method").val(), parametros, fecharTelaCadastro, 'Aguarde, salvando menu!', 'Menu salvo com sucesso!');
}

function fecharTelaCadastro(dados) {
    $("#CadMenus").jqxWindow("close");
    ExecutaDispatch('Menu', 'ListarMenusGrid', '', CarregaGridMenu);
    // swal({
    //     title: "Sucesso!",
    //     text: dados[2],
    //     type: "info"
    // });
}

function MontaComboMenu(arrDados) {
    CriarComboDispatch('codMenuPai', arrDados, 0, 'persist');
}

function DeleteMenu() {
    ExecutaDispatch('Menu', 'DeleteMenu', 'codMenu;' + $("#codMenu").val() + '|', retornoDeleteMenu, "Aguarde, removendo menu", "Menu removido com sucesso!");
}

function retornoDeleteMenu(retorno) {
    $("#CadMenus").jqxWindow("close");
    CarregaGridMenu();
}