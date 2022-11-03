<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_regenerate_id (true);
require_once("database/dbconn.php");

$db = new Database();

?>
<header>
    <div class="header_top">
        <div class="left">
        <span><i class="fas fa-bars c_bars" id="c_bars" onclick="var a = document.getElementById('mb-slid').classList; if(a.contains('hide')){ a.remove('hide'); a.add('show');}else{ a.remove('show'); a.add('hide');}"></i></span>
        <a class="logo" href="./">
            <span id="logo">Ango-Cursos</span>
        </a>

        </div>

        <div class="right">

        
        <div class="btns">
            <?php if(isset($_SESSION['uemail']) && isset($_SESSION['isLogin'])){  if($_SESSION['isLogin'] == "true") { 
                $usemail = $_SESSION['uemail'];
                $db->select('user_data','u_pic',null,"uemail='$usemail'");
                $em=$db->getResult();
                $pic=$em[0]['u_pic'];
            ?> 
                <a href="cart" class="cart" style="color:black;">
                    <i class="fas fa-shopping-cart s_cart"></i>
                </a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <ul class="myacc">
                    <li><img src="images/students/<?php echo $pic; ?>" alt="" class="u_profile"></li>
                    <ul class="myacc_dropdown">
                        <li class="dropdown_li"><a href="student/">Minha Conta</a></li>
                        <li class="dropdown_li"><a href="student/payment_history">Pagamentos</a></li>
                        <li class="dropdown_li"><a href="student/settings">Configurações</a></li>
                        <li class="dropdown_li"><a href="student/close_acc">Fechar Conta</a></li>
                        <li class="dropdown_li"><a href="logout" id="login">Sair</a></li>
                    </ul>
                </ul>
            <?php } }else{ ?>
            <a href="singup_instructor" class="btn">Aderir como Formador</a>
            <a href="cart" class="cart" style="color:black;">
                <i class="fas fa-shopping-cart s_cart"></i>
            </a>
            <a href="login" class="btn" id="login">Login</a>
            <a href="signup" class="btn" id="signup">Registro</a>
            <?php } ?>
            <ul class="myacc hide">
                <li><img src="images/reviews/review1.jpg" alt="profile photo" class="u_profile"></li>
                <ul class="myacc_dropdown">
                    <li class="dropdown_li"><a href="student">Minha Conta</a></li>
                    <li class="dropdown_li"><a href="student/payment_history">Pagamentos</a></li>
                    <li class="dropdown_li"><a href="student/settings">Configurações</a></li>
                    <li class="dropdown_li"><a href="student/close_acc">Fechar Conta</a></li>
                </ul>
            </ul>
        </div>

        <ul class="dropdown_list">
            <li>Cursos &#9662;</li>
            <ul class="dropdown_ul">
                <?php
                if($db->select('category','cat_name',null,null,null,['0'=>8])){
                    $ssr = $db->getResult();
                    $ssr2 = count($ssr) > 0 ? count($ssr) : false;                    
                    if($ssr2 >0){
                        $i=0;
                        while($i<$ssr2){
                            $cat_nm = $ssr[$i]['cat_name'] ? $ssr[$i]['cat_name'] : "No Data";
                            echo"<li class='dropdown_li'><a href='category?cat_nm=$cat_nm'>$cat_nm &nbsp;&nbsp; <i class='fas fa-angle-right dr_ar'></i></a></li>";
                        $i++;
                        }
                    }else{
                        $err = "Error Fetching Data!";
                    }
                }else{
                    $err = "Error Fetching Data!";
                }
                ?>
            </ul>
        </ul>
    </div>
        </div>
        
        
    <div class="search_bar">
            <i class="fas fa-search search_icon"></i>
              <form action="search2" method="GET" class="sform">
                <input type="text" name="search" id="search" placeholder="Pesquise por qualquer curso..." class="search">
                <ul class="search_ul" id="search_li_v">
                    
                </ul>
            </form>
        </div>
    
</header>

<!-- Mobile Slider  -->

<div class="mb-slid hide" id="mb-slid">
    <div class="mb-slider">
        <div class="mb_cat">
            <br />
            <div class="search_bar1">
                <i class="fas fa-search search_icon"></i>
                <form action="search2" method="GET" class="sform">
                    <input type="text" name="search" id="search" placeholder="Pesquise por um curso aqui..." class="search">
                </form>
            </div>


            <div class="mb_cat_h">Cursos &#9662;</div>
            <div>
            <?php
                if($db->select('category','cat_name',null,null,null,['0'=>8])){
                    $em2 = $db->getResult();
                    $cnt2 = count($em2) > 0 ? count($em2) : false;
                    if($cnt2 >0){
                        $i=0;
                        while($i<$cnt2){
                            $cat_nm1 = $em2[$i]['cat_name'] ? $em2[$i]['cat_name'] : "No Data";
                            echo"<li class='mb_cat_nm'><a href='category?cat_nm=$cat_nm1'>$cat_nm1 &nbsp;&nbsp; <i class='fas fa-angle-right'></i></a></li>";
                        $i++;
                        }
                    }else{
                        $err = "Error Fetching Data!";
                    }
                }else{
                    $err = "Error Fetching Data!";
                }
                ?>
            </div>
        </div>

       
        <div class="mb_cat2">
            <?php if(isset($_SESSION['uemail']) && isset($_SESSION['isLogin'])){  if($_SESSION['isLogin'] == "true") { 
                $usemail = $_SESSION['uemail'];
            ?> 
                <div>
                    <div class="mb_cat_h">Minha Conta</div>

                    <ul class="mb-myacc">
                        <li class="mb_cat_nm"><a href="student/"><i class="fas fa-shopping-cart mb_cat_nm"></i>&nbsp;Cart</a></li>
                        <li class="mb_cat_nm"><a href="student/">Minha Conta</a></li>
                        <li class="mb_cat_nm"><a href="student/payment_history">Pagamentos</a></li>
                        <li class="mb_cat_nm"><a href="student/settings">Configurações</a></li>
                        <li class="mb_cat_nm"><a href="student/close_acc">Fechar Conta</a></li>
                        <li class="mb_cat_nm"><a href="logout" id="login">Logout</a></li>
                    </ul>
                </div>
            <?php } }else{ ?>
            <a href="cart" class="mb-btn" style="color:black;">
                <i class="fas fa-shopping-cart s_cart1"></i>&nbsp;Carrinho
            </a>
            <a href="singup_instructor" class="mb-btn">Aderir como Formador</a>
            <a href="login" class="mb-btn" id="login">Login</a>
            <a href="signup" class="mb-btn" id="signup">Registo</a>
            <?php } ?>
        </div>

        
    </div>
</div>
