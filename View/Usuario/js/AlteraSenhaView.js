$(function() {
    $("#btnAlterar").click(function() {
        AlterarSenha();
    });
});

function AlterarSenha(){
        if ($("#txtSenhaNova").val()==$("#txtConfirmacao").val()){
            ExecutaDispatch('Login', 'AlterarSenha', 'txtSenhaAtual;'+$("#txtSenha").val()+'|txtSenhaNova;'+$("#txtSenhaNova").val()+'|verificaPermissao;N|', RedirecionaTela);
        }else{
            swal({
                title: 'AVISO!',
                text: 'Senha nova e de confirmação estão divergentes!',
                confirmButtonText: 'OK',
                type: 'warning'
            });
        }
}
function RedirecionaTela(logar){
    $(location).attr('href', '../../Dispatch.php?controller=' + logar[1][0]['DSC_PAGINA'] + '&method=' + logar[1][0]['NME_METHOD']+'&verificaPermissao=N');
}