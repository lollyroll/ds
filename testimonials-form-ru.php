<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Фриланс Front-end разработка высоко качественных responsive веб сайтов">
<meta name="keywords" content="front-end разработчик, front-end разработкаt, web дизайнер">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/skeleton.css" rel="stylesheet" type="text/css">
<link href="css/normalize.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link href="css/style-responsive.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php
$time=time();
if (session_id()=='') session_start();

$db=mysqli_connect("localhost","vdldwzry_main","U8i9O3k2","vdldwzry_testimonials") or die();
$res=mysqli_query($db,"set names utf8");

$mess_url=mysqli_real_escape_string($db,basename($_SERVER['SCRIPT_FILENAME']));

$theme_id=1;

if (isset($_POST["contr_cod"])){    //отправлен комментарий
 $mess_login=htmlspecialchars($_POST["mess_login"]);
 $user_text=htmlspecialchars($_POST["user_text"]);
 if (md5($_POST["contr_cod"])==$_POST["prov_summa"]){    //код правильный
  if ($mess_login!='' and $user_text!=''){
   if (is_numeric($_POST["parent_id"]) and is_numeric($_POST["f_parent"]))
    $res=mysqli_query($db,"insert into comment
    (parent_id, first_parent, date, theme_id, login, message)
    values ('".$_POST["parent_id"]."','".$_POST["f_parent"]."',
    '".$time."','".$theme_id."','".$mess_login."','".$user_text."')");
   else $res=mysqli_query($db,"insert into comment (date, theme_id, login, message)
   values ('".$time."','".$theme_id."','".$mess_login."','".$user_text."')");
    $_SESSION["send"]="Комментарий принят!";
    header("Location: $mess_url#last"); exit;
  }
  else {
   $_SESSION["send"]="Не все поля заполнены!";
   header("Location: $mess_url#last"); exit;
  }
 }
 else {
  $_SESSION["send"]="Неверный проверочный код!";
  header("Location: $mess_url#last"); exit;
 }
}

if (isset($_SESSION["send"]) and $_SESSION["send"]!="") {    //вывод сообщения
    echo '<script type="text/javascript">alert("'.$_SESSION["send"].'");</script>';
    $_SESSION["send"]="";
}
?>
</head>
<body>
<div class="main_menu">
  <div class="container">
    <a class="logo roboto" href="index.html">
      SHCHERBINA DENIS<br>
      <span class="icon-logo roboto"></span><span class="text-small">Front-end Developer</span>
    </a>
    <ul class="menu" id="smooth-menu">
      <li>
        <a href="about-ru.html" class="inner roboto">
          О СЕБЕ
        </a>
      </li>
      <li>
        <a class="inner roboto" href="index-ru.html#jobs">
          ПОРТФОЛИО
        </a>
      </li>
      <li>
        <a href="testimonials-ru.php" class="inner roboto">
          ОТЗЫВЫ
        </a>
      </li>
      <li>
        <a class="inner roboto" href="contact-ru.html">
          КОНТАКТЫ
        </a>
      </li>
      <li>
        <a class="inner roboto" href="price.html">
          СТОИМОСТЬ
        </a>
      </li>
      <li>
        <a class="button-lang eng roboto" href="index.html">
          RU
        </a>
      </li>
      <li>
        <div class="button-sign">
          <span class="lock">войти</span>
          <a class="open" href="admin/adminka.php">
            войти
          </a>
        </div>
      </li>
    </ul>
  </div>
</div>
<div class="clear"></div>
<div class="container padd">
  <!-- форма добавления комментариев -->
  <?php
$cod=rand(100,900); $cod2=rand(1,99);
echo '<div id="last" align="center">';
echo '<form method="POST" action="'.$mess_url.'#last" class="add_comment"';
echo 'name="add_comment" id="hint"><div class="close_hint">Закрыть</div>';
echo '<textarea class="u-full-width testimonials-area" name="user_text"></textarea>';
echo '<div style="margin:5px; float:left;">';
echo 'Имя: <input type="text" name="mess_login" maxlength="20" value=""></div>';

echo '<div style="margin:5px; float:right;">'.$cod.' + '.$cod2.' = ';
echo '<input type="hidden" name="prov_summa" value="'.md5($cod+$cod2).'">';
echo '<input type="hidden" name="parent_id" value="0">';
echo '<input type="hidden" name="f_parent" value="0">';
echo '<input type="text" name="contr_cod" maxlength="4" size="4">&nbsp;';
echo '<input type="submit" value="Отправить"></div>';
echo '</form>';

echo '<form method="POST" action="'.$mess_url.'#last" class="add_comment">';
echo 'Добавить комментарий:';
echo '<textarea class="u-full-width testimonials-area" name="user_text"></textarea>';
echo '<div style="margin:5px; float:left;">';
echo 'Имя: <input type="text" name="mess_login" maxlength="20" value=""></div>';
echo '<div style="margin:5px; float:right;">'.$cod.' + '.$cod2.' = ';
echo '<input type="hidden" name="prov_summa" value="'.md5($cod+$cod2).'">';
echo '<input type="text" name="contr_cod" maxlength="4" size="4">&nbsp;';
echo '<input class="button-primary button-custom" type="submit" value="Отправить"></div>';
echo '</form></div>';
?>
  <!-- блок с отзывами -->
  <?php
function parents($up=0, $left=0) {    //Строим иерархическое дерево комментариев
global $tag,$mess_url;

for ($i=0; $i<=count($tag[$up])-1; $i++) {
 //Можно выделять цветом указанные логины
 if ($tag[$up][$i][2]=='sherbina denis') $tag[$up][$i][2]='<font color="#C00">sherbina denis</font>';
 if ($tag[$up][$i][6]==0) $tag[$up][$i][6]=$tag[$up][$i][0];
 //Высчитываем рейтинг комментария
 $sum=$tag[$up][$i][4]-$tag[$up][$i][5];

 if ($up==0) echo '<div style="padding:5px 0 0 0;">';
 else {
    if (count($tag[$up])-1!=$i)
        echo '<div class="strelka" style="padding:5px 0 0 '.($left-2).'px;">';
    else echo '<div class="strelka_2" style="padding:5px 0 0 '.$left.'px;">';
 }
 echo '<div class="comm_head" id="m'.$tag[$up][$i][0].'">';
 echo '<div style="float:left;"><b>'.$tag[$up][$i][2].'</b></div>';
 echo '<div class="comm_minus"></div>';
 echo '<div style="float:right; width:30px;" id="rating_comm'.$tag[$up][$i][0].'">';
 echo '<b>'.$sum.'</b></div><div class="comm_plus"></div>';
 echo '<a style="float:right; width:70px; text-decoration:none; color:#999999;" href="'.$mess_url.'#m';
 echo $tag[$up][$i][0].'"># '.$tag[$up][$i][0].'</a>';
 echo '<div style="float:right; width:170px; font-size:11px; color: #666666;">';
 echo ''.date("H:i:s d.m.Y", $tag[$up][$i][3]).' г.</div>';
 echo '<div style="clear:both;"></div></div>';
 echo '<div class="comm_body">';
 if ($sum<0) echo '<u class="sp_link">Показать/скрыть</u><div class="comm_text">';
 else echo '<div style="word-wrap:break-word;">';
 echo str_replace("<br />","<br>",nl2br($tag[$up][$i][1])).'</div>';
 echo '<div class="open_hint" onClick="comm_on('.$tag[$up][$i][0].',
     '.$tag[$up][$i][6].')">Ответить</div><div style="clear:both;"></div></div>';
 if (isset($tag[ $tag[$up][$i][0] ])) parents($tag[$up][$i][0],20);
 echo '</div>';
}
}

$res=mysqli_query($db,"SELECT * FROM comment
    WHERE theme_id='".$theme_id."' and moderation=1 ORDER BY id");
$number=mysqli_num_rows($res);

if ($number>0) {
 echo '<div style="border:1px solid #cccccc;padding:5px;text-align:center;border-radius:5px;">';
 echo '<b>Последние комментарии:</b><br>';
 while ($com=mysqli_fetch_assoc($res))
    $tag[(int)$com["parent_id"]][] = array((int)$com["id"], $com["message"],
    $com["login"], $com["date"], $com["plus"], $com["minus"], $com["first_parent"]);
 echo parents().'</div><br>';
}
?>
</div>
<div class="footer-absolute">
  <div class="container">
    <div class="copyright">
      &#169; 
      2016 Щербина Денис. Все права соблюдены и защищены.</div>
    <a href="https://www.facebook.com/profile.php?id=100002466302500" class="fb-icon">
    </a>
    <a href="https://www.linkedin.com/in/denis-shcherbina-a81668106?trk=nav_responsive_tab_profile_pic" class="in-icon">
    </a>
  </div>
</div>
<script type="text/javascript">
//Добавление в форму отправки комментария значений id родительских комментариев
function comm_on(p_id,first_p){
    document.add_comment.parent_id.value=p_id;
    document.add_comment.f_parent.value=first_p;
}
$(document).ready(function(){
//Показать скрытое под спойлером сообщение
$(".sp_link").click(function(){
    $(this).parent().children(".comm_text").toggle("normal");
});
//Показать форму ответа на имеющийся комментарий
$(".open_hint").click(function(){
    $("#hint").animate({
        top: $(this).offset().top + 25, left: $(document).width()/2 -
        $("#hint").width()/2
    }, 400).fadeIn(800);
});
//Скрыть форму ответа на имеющийся комментарий
$(".close_hint").click(function(){ $("#hint").fadeOut(1200); });
//Получение id оцененного комментария
$(".comm_plus,.comm_minus").click(function(){
    id_comm=$(this).parents(".comm_head").attr("id").substr(1);
});
//Отправление оценки комментария в файл rating_comm.php
$(".comm_plus").click(function(){
    jQuery.post("rating_comm.php",{comm_id:id_comm,ocenka:1},rating_comm);
});
$(".comm_minus").click(function(){
    jQuery.post("rating_comm.php",{comm_id:id_comm,ocenka:0},rating_comm);
});
//Возврат рейтинга комментария и его обновление
function rating_comm(data){
    $("#rating_comm"+id_comm).fadeOut(800,function(){
        $(this).html(data).fadeIn(800);
    });
}
});
</script>
</body>
</html>