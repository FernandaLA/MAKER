<?php
include_once "../Dao/BaseDao.php";
class BaseModel {
    Protected $objRequest;
    
    Public Static Function PermissaoMetodoUsuario($controller, $method){
        $result = BaseDao::PermissaoMetodoUsuario($_SESSION['cod_usuario'], $controller, $method);
        if ($result[0]){
            if ($result[1][0]['QTD']>0){
                return true;
            }
        }
        return false;
    }
    
    Public Function PopulaObjetoComRequest($columns){
        $this->objRequest = new stdClass();
        foreach($columns as $key => $value){
            $campo = BaseDao::Populate($key, $value['typeColumn']);
            if ($campo){
                $this->objRequest->$key = $campo;
            }
        }
    }
    
    Public Function RecuperaRequest($encript=false){
        $this->objRequest = new stdClass();
        foreach($_REQUEST as $key => $value){
            $val = $encript?base64_encode($value):$value;
            $this->objRequest->$key = $val;
        }
    }
//     Public Function EnviaEmail($nomeDestinatario, $emailDestinatario, $titulo, $mensagem){
//         $mail             = new PHPMailer();
//         //$body             = file_get_contents('contents.html');
//         //$body             = preg_replace('/[\]/','',$body);
//         $mail->IsSMTP(); // telling the class to use SMTP
//         $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
//                                                    // 1 = errors and messages
//                                                    // 2 = messages only
//         $mail->SMTPAuth   = true;                  // enable SMTP authentication
//         $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
//         $mail->Host       = SMTP_EMAIL;      // sets GMAIL as the SMTP server
//         $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
//         $mail->Username   = USER_EMAIL;  // GMAIL username
//         $mail->Password   = USER_PWD;            // GMAIL password
//         $mail->SetFrom("sistemasiscove@gmail.com", "No-Reply");
//         $mail->Subject    = utf8_decode($titulo);
//         //$arqDestino = '/var/www/html/siscovehmg/Resources/notas/nota'.$NfeDao->Populate('codVenda').'.pdf';
//         //copy($nfeVenda, $arqDestino);
//         $mail->MsgHTML($mensagem);
// //        $mail->AddAttachment($arqDestino);   
//         $mail->AddAddress($emailDestinatario, $nomeDestinatario);
//         $envio = $mail->Send();
//         if(!$envio) {
//             echo "Mailer Error: " . $mail->ErrorInfo;
//             $result[0] = false;
//             $result[1] = "Erro ao enviar o email!";
//         } else {
//             $result[0] = true;
//             $result[1] = "Email enviado!";
//         }
// //        unlink($arqDestino);        
//     }
}
?>