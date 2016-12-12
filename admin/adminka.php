<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/skeleton.css" rel="stylesheet" type="text/css">
<link href="../css/normalize.css" rel="stylesheet" type="text/css">
<link href="../css/animate.css" rel="stylesheet" type="text/css">
<link href="../css/style-responsive.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" src="../js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="../js/settings.js"></script>
<script type="text/javascript" src="../js/smooth_scrolling.js"></script>
<script type="text/javascript" src="../js/jquery.leanModal.min.js"></script>
</head>
<body>
<div class="main_menu">
  <div class="container">
    <a class="logo roboto" href="../index.html">
      SHCHERBINA DENIS<br>
      <span class="icon-logo roboto"></span><span class="text-small">Front-end Developer</span>
    </a>
    <ul class="menu roboto" id="smooth-menu">
      <li>
        <a href="../about.html" class="inner">
          ABOUT
        </a>
      </li>
      <li>
        <a class="inner jobs" href="#jobs">
          PORTFOLIO
        </a>
      </li>
      <li>
        <a href="../testimonials-form.php" class="inner roboto">
          TESTIMONIALS
        </a>
      </li>
      <li>
        <a class="inner" href="../contact.html">
          CONTACT
        </a>
      </li>
      <li>
        <div class="button-lang">
          <span class="eng">Eng</span>
          <a class="ru" href="../index-ru.html">
            Ru
          </a>
        </div>
      </li>
    </ul>
  </div>
</div>
<?php
$db=mysqli_connect("localhost","vdldwzry_main","U8i9O3k2","vdldwzry_testimonials") or die();
$res=mysqli_query($db,"set names utf8");
if (isset($_GET["del"])) {
 $res=mysqli_query($db,"DELETE FROM comment WHERE id='".$_GET["del"]."'");
 header("Location: adminka.php");
}
if (isset($_GET["ok"])) {
 $res=mysqli_query($db,"UPDATE comment SET moderation=1 WHERE id='".$_GET["ok"]."'");
 header("Location: adminka.php");
}
if ($_POST["com"]!='') {
 $res=mysqli_query($db,"UPDATE comment
 SET message='".htmlspecialchars($_POST["com"])."' WHERE id='".$_POST["com_id"]."'");
 header("Location: adminka.php");
}
?>
<?php
echo '<div align="center">';

$res=mysqli_query($db,"SELECT * FROM comment WHERE moderation=0 ORDER BY id LIMIT 5");
$num=mysqli_num_rows($res);

if ($num>0) {
 while ($com=mysqli_fetch_array($res)) {
  echo '<table style="border:1px solid #000; margin:5px; background-color:#eee;">';
  echo '<tr align="center"><td width="190"><b>'.$com["login"].'</b></td>';
  echo '<td width="200">id темы - '.$com["theme_id"].'</td>';
  echo '<td width="170">'.date('H:i:s d.m.Y', $com["date"]).'</td><td></td>';
  echo '<tr align="center"><td colspan="3"><form method="POST" action="adminka.php">';
  echo '<textarea cols="70" rows="5" name="com">'.$com["message"].'</textarea></td>';
  echo '<td colspan="4"><input type="hidden" name="com_id" value='.$com["id"].'>';
  echo '<input type="submit" value="Изменить"></form><br><br>';
  echo '<a href="adminka.php?del='.$com["id"].'">Удалить</a><br><br>';
  echo '<a href="adminka.php?ok='.$com["id"].'">Показать</a></td></tr></table>';
 }
}
else echo '<b>Новых комментариев нет!</b><br>';
echo '</div>';
?>
<div class="footer-absolute">
<div class="container">
   <div class="copyright"> Copyright &#169; 2016 Shcherbina Denis. All rights reserved. </div>
    <a href="https://www.facebook.com/profile.php?id=100002466302500" class="fb-icon"></a>
    <a href="https://www.linkedin.com/in/denis-shcherbina-a81668106?trk=nav_responsive_tab_profile_pic" class="in-icon"></a>
</div>
</div>
</body>
</html>