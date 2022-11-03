<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!(isset($_SESSION['isLogin']) && isset($_SESSION['iemail']))){
    header('location:login');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechar Conta</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="../css/instructorPanel.css">
</head>
<body>
    <?php include_once('../inc/instHeader.php') ?>

    <div class="inst_ss">  
        <?php include_once('sidebar.php') ?>


        <div class="dash">
            <div class="stu_acc_set_r">
                <div class="stu_acc_set_ttl">Detalhes do Perfil</div>
                <div class="stu_acc_set_bdy">
                    <div class="cls_acc_bdy">
                        <div>Uma vez que deletas a sua conta não será possível retroceder, Se quiseres continuar marque o checkbox e poderás deletar sua conta!.</div>
                        <br />
                        <br />
                        <form action="close_acc_r" method="POST" name="" id="" class="">
                            <label for="">Concordo em Deletar a minha conta:</label>
                            <input type="checkbox" name="agree" id="agree">
                            <br />
                            <br />
                            <input type="submit" value="Apagar Conta" id="delete" class="stu_acc_set_sbtn" name="delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>


</div>


<script src="../javascript/jquery.js"></script>
<script src="../javascript/all.js"></script>
<script src="../javascript/instructorPanel.js"></script>
</body>
</html>
