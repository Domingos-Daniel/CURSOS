<?php
require_once("database/dbconn.php");

$db = new Database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ango-Cursos | Aprenda Online</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiko&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/w3.css">
    
    <!-- CSS only -->
<link href="bootstrap-5.0.2-dist\css\bootstrap.min.css" rel="stylesheet">
<!-- JavaScript Bundle with Popper -->
<script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- CSS only -->

    <link rel="stylesheet" href="css/custom.css">

   
<body onload="document.getElementById('id01').style.display='block'">

<!-- The Modal -->
<div id="id01" class="w3-modal">
  <div class="w3-modal-content" style="width:640px;height:500px;padding:32px; text-align:center">
    <div class="w3-container">
        <h1 style="color:white;position:absolute; z-index:1000; text-decoration:underline;">ANUNCIO</h1>
      <img src="./images/site/banner_1.jpg" class="baner2" alt="" style="width:100%; height:100%; position:absolute;left:0;top:0">
      <span onclick="document.getElementById('id01').style.display='none'"
      class="w3-button w3-display-topright">x</span>
    </div>
  </div>
</div>

<!-- Header Section Start --> 
    <?php include_once('inc/header.php') ?>
<!-- Header Section End -->

    <!-- Section 1 Start -->

    <section class="s1">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">

<div class="title1">
    <div class="box1"> 
        <p id="inner_p1">Aprenda de acordo à sua agenda</p>
        <p id="inner_p2">Estude qualquer tópico, a qualquer hora. Escolha das centenas de curso disponíveis.</p>
    </div>
</div>
<div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./images/site/hero-bg.jpg" class="" alt="Slide1">
    </div>
    <div class="carousel-item">
      <img src="./images/site/banner_1.jpg" class="" alt="Slide2">
    </div>
    <div class="carousel-item">
      <img src="./images/site/banner_1.jpg" class="" alt="Slide3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </section>


    <!-- Section 1 End -->

    <!-- Section 2 Start -->

    <div class="section2">
        <p id="sec2_p1">A maior seleção de cursos online em Angola</p>
        <p id="sec2_p2">Escolha dentre 100,000 online video courses with new additions published every month</p>
    </div>

    <!-- Section 2 End -->


    <!-- Section 3 Start -->

    <div class="section3">
        <p class="sec3_title">Cursos mais Vistos</p>

        <div class="sec_courses">
            <?php
            if($db->selectg('course_order','crs_token',null,null,"crs_token","COUNT(crs_token) DESC",['0'=>3])){
                $emm = $db->getResult();
                $cntt = count($emm) > 0 ? count($emm) : false;        
                if($cntt > 0){
                    $k=0;  
                    while($k<$cntt){
                        $crs_token_id = $emm[$k]['crs_token'];
                        if($db->select('courses','courses.crs_nm,courses.crs_price,courses.crs_img,courses.crs_token,i.iname',"instructor_data as i ON courses.crs_creator = i.iemail","courses.crs_token = '$crs_token_id'")){
                            $em1 = $db->getResult();
                            $cnt1 = count($em1) > 0 ? count($em1) : false;
                            if($cnt1 >0){
                                $i=0;
                                while($i<$cnt1){
                                    $crs_nm = isset($em1[$i]['crs_nm']) ? $em1[$i]['crs_nm'] : "Error Extracting Data!";
                                    $crs_price = isset($em1[$i]['crs_price']) ? $em1[$i]['crs_price'] : "Error Extracting Data!";
                                    $crs_img = isset($em1[$i]['crs_img']) ? $em1[$i]['crs_img'] : "Error Extracting Data!";
                                    $crs_token = isset($em1[$i]['crs_token']) ? $em1[$i]['crs_token'] : "Error Extracting Data!";
                                    $iname = isset($em1[$i]['iname']) ? $em1[$i]['iname'] : "Error Extracting Data!";
                                    $db->select('review','AVG(ratings) as avg',null,"crs_token='$crs_token'");
                                    $rt1 = $db->getResult();
                                    $rt1_cnt = count($rt1);
                                    if($rt1_cnt > 0){
                                        $rating =  $rt1['0']['avg'];
                                        $rat_round = substr(number_format($rating, 2, '.', ''), 0, -1);
                                    }
        
                                    echo "<div class='sec_course' onclick='location.href=\"course?crs_id=$crs_token\"'>
                                        <div class='sec_img'>
                                            <img src='images/courses/$crs_img' alt='course image' class='sec_crs_img'>
                                        </div>
                                        <div class='sec_bdy'>
                                            <p class='sec_crs_title'> $crs_nm</p>
                                            <p class='sec_crs_author'> $iname</p>
                                            <p class='sec_crs_ratings'>$rat_round "; $j = 0; do{ echo "<span class='fas fa-star' style='color:#fd4; stroke:#444; stroke-width:20px;'></span>"; $j++;}while(($j < round($rat_round))); echo "
                                            </p>
                                            <p class='sec_crs_price'>$crs_price<small> AOA</small></p>
                                        </div>
                                    </div>";
                                    $i++;
                                }
                            }
                        }
                    $k++;
                    }
                }else{
                    $err = "Erro na busca dos dados!";
                }
            }else{
                $err = "Erro na busca dos dados st!";
            }
              
            ?>

        </div>

    </div>

    <!-- Section 3 End -->


    <!-- Section 4 Start -->

    <div class="section4">
        <div class="sec4_1">
            <i class="fa fa-play-circle fa_icon"></i>
            <div class="sec4_p">
                <p class="sec4_p1">Encontre cursos em video dos mais diversos tópicos!</p>
                <p class="sec4_p2">Aprenda o que quiseres, onde quiseres</p>
            </div>
        </div>
        <div class="sec4_1">
            <i class="fas fa-clock fa_icon"></i>
            <div class="sec4_p" >
                <p class="sec4_p1">Aprenda em qualquer lugar à qualquer hora</p>
                <p class="sec4_p2">Obtenha acesso mensal dos cursos já pagos</p>
            </div>
        </div>
        <div class="sec4_1">
            <i class="fas fa-chalkboard-teacher fa_icon"></i>
            <div class="sec4_p" >
                <p class="sec4_p1">Aprende dos mais Xperters da Industria</p>
                <p class="sec4_p2">Select from top instructors around the world</p>
            </div>
        </div>
    </div>

    <!-- Section 4 End -->


    <!-- Section 5 Start -->

    <div class="section5">
        <div class="sec5">
            <p class="sec5_p1">Obtenha 10% de desconto nas 2 primeiras subscrições</p>
            <p class="sec5_p2">Use o Codigo <span>AC10</span></p>
        </div>
    </div>

    <!-- Section 5 End -->


    <!-- Section 6 Start -->

    <div class="section3">
        <p class="sec3_title">Últimos cursos</p>

        <div class="sec_courses">
            
            <?php
            if($db->select('courses','courses.crs_nm,courses.crs_price,courses.crs_img,courses.crs_token,i.iname',"instructor_data as i ON courses.crs_creator = i.iemail","courses.crs_creator = i.iemail","lst_upt DESC",['0'=>3])){
                $em1 = $db->getResult();
                $cnt1 = count($em1) > 0 ? count($em1) : false;
                if($cnt1){
                    $i=0;
                    while($i<$cnt1){
                        $crs_nm = isset($em1[$i]['crs_nm']) ? $em1[$i]['crs_nm'] : "Error Extracting Data!";
                        $crs_price = isset($em1[$i]['crs_price']) ? $em1[$i]['crs_price'] : "Error Extracting Data!";
                        $crs_img = isset($em1[$i]['crs_img']) ? $em1[$i]['crs_img'] : "Error Extracting Data!";
                        $crs_token = isset($em1[$i]['crs_token']) ? $em1[$i]['crs_token'] : "Error Extracting Data!";
                        $iname = isset($em1[$i]['iname']) ? $em1[$i]['iname'] : "Error Extracting Data!";

                        $db->select('review','AVG(ratings) as avg',null,"crs_token='$crs_token'");
                        $rt2 = $db->getResult();
                        $rt2_cnt = count($rt2);
                        if($rt2_cnt > 0){
                            $rating2 =  $rt2['0']['avg'];
                            $rat_round2 = substr(number_format($rating2, 2, '.', ''), 0, -1);
                        }

                        echo 
                            "
                            <div class='sec_course' onclick=\"location.href='course?crs_id=$crs_token'\">
                                <div class='sec_img'>
                                    <img src='images/courses/$crs_img' alt='' class='sec_crs_img'>
                                </div>
                                <div class='sec_bdy'>
                                    <p class='sec_crs_title'>$crs_nm</p>
                                    <p class='sec_crs_author'>$iname</p>
                                    <p class='sec_crs_ratings'>$rat_round2 "; $j = 0; do{ echo "<span class='fas fa-star' style='color:#fd4; stroke:#444; stroke-width:20px;'></span>"; $j++;}while(($j < round($rat_round2))); echo "
                                        </p>
                                    <p class='sec_crs_price'>$crs_price <small>AOA</small></p>
                                </div>
                            </div>
                            ";
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

    <!-- Section 6 End -->


    <!-- Section 7 Start -->

    <div class="section7">
        <p class="sec7_title">Top Categorias</p>
        <div class="categories">

        <?php

        if($db->select('category','cat_name,cat_img',null,null,null,['0'=>8])){
            $em2 = $db->getResult();
            $cnt2 = count($em2) > 0 ? count($em2) : false;
            if($cnt2 >0){
                $i=0;
                while($i<$cnt2){
                    $cat_nm = $em2[$i]['cat_name'] ? $em2[$i]['cat_name'] : "No Data";
                    $cat_img = $em2[$i]['cat_img'] ? $em2[$i]['cat_img'] : "No Data";
                    echo 
                    "<div class='category' onclick=\"location.href='category?cat_nm=$cat_nm'\">
                        <div class='cat_img'>
                            <img src='images/category/$cat_img' alt='' class='cat_crs_img'>
                        </div>
                        <div class='cat_bdy'>
                            <p class='cat_title'>$cat_nm</p>
                        </div>
                    </div>";
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

    <!-- Section 7 End -->


    <!-- Section 8 Start -->
    <div class="sec8">
        <div class="sec8_main">
            <img src="images/site/instructor.jpg" alt="instructor" class="sec8_img">
            <div class="sec8_pa2">
                <p  id="sec8_p">Torne se um Formador</p>
                <p id="sec8_p2">Top instructors from around the world teach millions of students on Udemy. We provide the tools and skills to teach what you love.</p>
                <a href="singup_instructor" id="sec_8btn">Comece a ensinar hoje</a>
            </div>
        </div>
        <div class="sec8_1"></div>
    </div>
    <!-- Section 8 End -->


    <!-- Section 9 Start -->

    <div class="sec9">
        <div class="sec9_main">
            <div class="sec9_pa2">
                <p  id="sec9_p">Aprenda em qualquer lugar, a qualquer hora</p>
                <p id="sec9_p2">Top instructors from around the world teach millions of students on Elearn. We provide the tools and skills to teach what you love.</p>
                <a href="login" id="sec_9btn">Comece a Aprender Hoje</a>
            </div>
            <img src="images/site/student.jpg" alt="student" class="sec9_img">
        </div>
        <div class="sec9_1"></div>
    </div>

    <!-- Section 9 End -->


<!-- Footer Section Start -->
    <?php include_once('inc/footer.php') ?>
<!-- Footer Section End -->
    <script src="javascript/jquery.js"></script>
    <script src="javascript/all.js"></script>
    <script src="javascript/frontend.js"></script>
    <script src="javascript/jquery-3.5.1.min.js"></script>
</body>
</html>