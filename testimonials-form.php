<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="js/settings.js"></script>
<script type="text/javascript" src="js/smooth_scrolling.js"></script>
<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
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
        <a href="about.html" class="inner roboto">
          ABOUT
        </a>
      </li>
      <li>
        <a href="index.html#jobs" class="inner roboto">
          PORTFOLIO
        </a>
      </li>
      <li>
        <a href="testimonials.html" class="inner roboto">
          TESTIMONIALS
        </a>
      </li>
      <li>
        <a href="contact.html" class="inner roboto">
          CONTACT
        </a>
      </li>
      <li>
        <div class="button-lang">
          <span class="eng">Eng</span>
          <a class="ru" href="index-ru.html">
            Ru
          </a>
        </div>
      </li>
    </ul>
  </div>
</div>
<div class="clear"></div>
<div class="container padd">
<form method="post" enctype="multipart/form-data" accept-charset="utf-8"  id="comment">
<div class="comment">К<small>омментировать:</small></div>
<? if($mes_text){ ?>
<div class="<?=$mes_style?>"><?=$mes_text?></div>
<? } ?>
<div>
<input class="pinputn" name="name" id="name" value="" maxlength="27" type="text" />
<input class="pinputx" name="inputx" id="inputx" value="" maxlength="27" type="text" />
<input class="pinputm" name="email" id="email" value="" maxlength="27" type="text" /><!-- скрытое поле, бот его обязательно заполнит -->
</div><div>
<textarea class="ptextarea" name="message" id="message" rows="10" cols="75" ></textarea>
</div><div>
<input class="bsubmit2" name="submit" value="Добавить комментарий" type="submit" /> 
</div>
</form>

<?php
$time=time();
if (session_id()=='') session_start();
$db=mysqli_connect("localhost","vdldwzry_main","U8i9O3k2","vdldwzry_testimonials") or die();
$res=mysqli_query($db,"set names utf8");

$mess_url=mysqli_real_escape_string($db,basename($_SERVER['SCRIPT_FILENAME']));

//получаем id текущей темы
$res=mysqli_query($db,"SELECT id FROM comment WHERE file_name='".$mess_url."'");
$res=mysqli_fetch_array($res);
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

</div>
<div class="footer-absolute">
  <div class="container">
    <div class="copyright">Copyright
      &#169; 
      2016 Shcherbina Denis. All rights reserved.</div>
    <a href="https://www.facebook.com/profile.php?id=100002466302500" class="fb-icon">
    </a>
    <a href="https://www.linkedin.com/in/denis-shcherbina-a81668106?trk=nav_responsive_tab_profile_pic" class="in-icon">
    </a>
  </div>
</div>
</body>
</html>