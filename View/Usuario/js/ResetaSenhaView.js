$(function () {
    valor = '{x:' + $(window).width / 2 + ', y:' + $(window).heigth / 2 + '}';
    $("#ReiniciaSenhaForm").jqxWindow({
        autoOpen: true,
        height: 150,
        width: 450,
        theme: 'darkcyan',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        position: { x: 400, y: 300 },
        title: 'Esqueci Minha Senha'
    });
    $("#nroCpf").mask('999.999.999-99');
    $("#btnResetar").jqxButton({ width: '150', theme: 'darkcyan' });
    $("#btnResetar").click(function () {
        ExecutaDispatch('Usuario', 'ResetaSenha', 'nroCpf;' + $("#nroCpf").val() + '|', retornoResetaSenha, "Aguarde, resetando senha");
    });

});

function retornoResetaSenha(retorno) {
    window.location.href = '../../index.php';
}

$(document).ready(function () {
    $("#nmeLogin").focus();
});