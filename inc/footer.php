<?php
require_once("database/dbconn.php");

$db = new Database();
?>
<hr class="fhr">

<footer style="margin-top:40px">
    <div class="footer_sec">
        <div class="first box">
            <h2>Mais Links</h2>
            <hr class="hr" />
            <ul class="content">
                <li><a href="singup_instructor">Ensine no Ango-Cursos</a></li>
                <li><a href="">Obtenha o App</a></li>
                <li><a href="about">Acerca de Nós</a></li>
                <li><a href="contact">Contacte Nos</a></li>
                <li><a href="instructor/login">Login Formador</a></li>
            </ul>
            <div class="social_media_icons">
                <span class="s_icon"><i class="fab fa-facebook s_icons"></i></span>
                <span class="s_icon"><i class="fab fa-twitter s_icons"></i></span>
                <span class="s_icon"><i class="fab fa-instagram s_icons"></i></span>
                <span class="s_icon"><i class="fab fa-youtube s_icons"></i></span>
            </div>
        </div>
        <div class="second box">
            <h2>Categorias</h2>
            <hr class="hr" />
            <ul class="content">
            <?php
                if($db->select('category','cat_name',null,null,null,['0'=>8])){
                    $em2 = $db->getResult();
                    $cnt2 = count($em2) > 0 ? count($em2) : false;
                    if($cnt2 >0){
                        $i=0;
                        while($i<$cnt2){
                            $cat_nm = $em2[$i]['cat_name'] ? $em2[$i]['cat_name'] : "No Data";
                            echo"<li><a href='category?cat_nm=$cat_nm'>$cat_nm</a></li>";
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
        </div>
        <div class="third box">
            <h2>Contacte Nos</h2>
            <hr class="hr" />
            <div class="content">
                <form action="" method="POST">
                    <div class="email_box">
                        <label for="email" class='labels'>EMail *</label>
                        <input type="email" name="email" id="email" required autocomplete="off">
                    </div>
                    <div class="message_box">
                        <label for="message" class='labels'>Message *</label>
                        <textarea type="textarea" name="message" id="message" row='4' cols='25' required></textarea>
                    </div>
                    <div class="s_button">
                        <input type="submit" id="s_btn" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="copy_r">
        <span>Developed by | <span class="copy_rn"><a href="#">DD</a></span> @ <?php print date("Y"); ?></span>
    </div>
</footer>
