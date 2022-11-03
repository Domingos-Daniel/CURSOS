<?php
use PHPMailer\PHPMailer\PHPMailer;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database/dbconn.php');

if(isset($_SESSION['isLogin'])){
    header('location:student');
}else{
    try{
        if(isset($_POST['signup'])){
            if(($_POST['suser'] == "") || ($_POST['semail'] == "") || ($_POST['spass'] == "")){
                $err="Por favor, preencha todos os campos!";
            }else{
                $suser = htmlentities($_POST['suser']);
                $semail = htmlentities($_POST['semail']);
                $spass = password_hash(htmlentities($_POST['spass']),PASSWORD_BCRYPT);
                $token = bin2hex(random_bytes(10));

                $db = new Database();

                $db->select('user_data','uemail',null,'uemail="'.$semail.'"',null,null);
            
                $er=$db->getResult();
                $cc=count($er);
                if($cc > 0){
                    $err = "Email Já existe!";
                }else{

                    if($db->insert('user_verify',['uname'=>$suser,'uemail'=>$semail,'upassword'=>$spass,'token'=>$token,'status'=>'0'])){

                        $subject = "Activação da Conta";
                        $message = "Para activar sua conta no Ango-Cursos <a href='http://localhost/ango-cursos/verify_acc.php?token=$token&type=user'>Clique aqui </a>";
                   
                        require_once "smtp/PHPMailer.php";
                        require_once "smtp/SMTP.php";
                        require_once "smtp/Exception.php";

                        $mail = new PHPMailer();

                        $mail->isSMTP(true); // telling the class to use SMTP
                        $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        )
                        );
                        $mail->SMTPSecure = 'tls';
                        $mail->Host = 'tls://smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->Username = "domingoscahandadaniel@hotmail.com"; // SMTP username
                        $mail->Password = "doming2000$"; // SMTP password
                        // TCP port to connect to
                        // $mail->SMTPDebug = 1;
                        $mail->setFrom('domingoscahandadaniel@hotmail.com');
                        $mail->AddAddress($semail);
                        $mail->Subject = $subject;
                        $mail->Body = $message;
                        $mail->WordWrap = 70;
/* 
                        //smtp settings
                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "domingoscahandadaniel@gmail.com";   //Place you'r mail id here
                        $mail->Password = 'domingoscahandadanel$';  //Place you'r mail password here
                        $mail->Port = 587;
                        $mail->SMTPDebug = 4;
                        $mail->SMTPSecure = "ssl";

                        //email settings
                        $mail->isHTML(true);
                        $mail->setFrom('domingoscahandadaniel@gmail.com','AngoCursos');
                        $mail->addAddress($semail);
                        $mail->Subject = ("domingoscahandadaniel@gmail.com ($subject)");
                        $mail->Body = $message;
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ));
 */
                        if($mail->send()){
                            $msg="O link de activação foi enviado para o seu email, por faor verifique seu email para activar sua conta.";
                        }
                        else
                        {
                            $err="Algo deu errado, por favor tente novamente! 1".$mail->ErrorInfo;
                        }
                    }
                }
            }
        }

    } catch(Exception $e){
        $err = "Algo correu mal, volte a tentar!2";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Ango-Cursos </title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/custom.css">
    <script>
      function goBack() {
        window.location.assign("http://localhost/ango-cursos/")
      }
    </script>
</head>
<body class="backdrop_signups">

    <div class="backdrop_signup" id="backdrop_signup">
        <div class="signup_modal">
            <div class="signup_ttl">Registo</div>
                <form action="" method="POST">
                <div class="sfullnme">
                    <label for="suser" class="signup_lbl">Username</label>
                    <span class="sg_user"><i class="fas fa-user"></i></span>
                    <input type="text" name="suser" id="suser" class="sg_inpt" >
                </div>
                <div class="sgemail">
                    <label for="semail" class="signup_lbl">Email</label>
                    <span class="sg_email"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="semail" id="semail" class="sg_inpt" >
                </div>
                <div class="sgpassowrd">
                    <label for="spass" class="signup_lbl">Password</label>
                    <span class="sg_pass"><i class="fas fa-lock"></i></span>
                    <input type="password" name="spass" id="spass" class="sg_inpt">
                </div>
                <?php if(isset($msg)){ ?>
                <div class="msg">
                    <span><?php echo $msg; ?></span>
                </div>
                <?php } ?>
                <?php if(isset($err)){ ?>
                <div class="err">
                    <span><?php echo $err; ?></span>
                </div>
                <?php } ?>
                <div class='sg_btn'>
                    <input type="submit" name="signup" value="Registrar" id="slogin">
                    <a type="button" onclick="goBack()" class="cancel_btn" id="cancel_btnsg">Cancel</a>
                </div>
            </form>
            <div class="sg_sg">Já possui uma conta? Então <a href="login" id="llogin_a" class="a_btns">Log In</a></div>
        </div>
    </div>

    <script src="javascript/all.js"></script>
    <script type="text/javascript" src="javascript/frontend.js"></script>
</body>
</html>