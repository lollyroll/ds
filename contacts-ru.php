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
<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="js/settings.js"></script>
<script type="text/javascript" src="js/smooth_scrolling.js"></script>
<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "name" : "sherbina.h1n.ru",
  "url" : "http://sherbina.h1n.ru",
  "sameAs" : [
    "https://vk.com/club136801750",
    "https://www.facebook.com/sherbina.h1n/",
    "https://twitter.com/slipknotpower1",
    "https://plus.google.com/103856725653508465425"
  ]
}
</script>
<title>контакты форма обработки</title>
</head>
<body>
<div class="main_menu">
  <div class="container">
    <a class="logo roboto" href="index-ru.html">
      SHCHERBINA DENIS<br>
      <span class="icon-logo roboto"></span><span class="text-small">Веб-разработчик</span>
    </a>
    <ul class="menu roboto" id="smooth-menu">
      <li>
        <a href="about-ru.html" class="inner roboto">
          О СЕБЕ
        </a>
      </li>
      <li>
        <a class="inner jobs roboto" href="index-ru.html#jobs">
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
        <div class="button-lang">
          <a class="eng" href="index.html">
            Eng
          </a>
          <span class="ru">Ru</span>
        </div>
      </li>
    </ul>
  </div>
</div>
<div class="clear"></div>
<div class="container padd">
  <div id="contact-text" class="text roboto">
    <?php
/* Осуществляем проверку вводимых данных и их защиту от враждебных 
скриптов */
$yourname = htmlspecialchars($_POST["yourname"]);
$tema = htmlspecialchars($_POST["tema"]);
$email = htmlspecialchars($_POST["email"]);
$message = htmlspecialchars($_POST["message"]);
$your_website = htmlspecialchars($_POST["your_website"]);
$checkbox = htmlspecialchars($_POST["checkbox"]);
$spam = $_POST['spam']; // получим текст из поля спам
/* Устанавливаем e-mail адресата */
$myemail = "zolotuhinmolodez@gmail.com";
/* Проверяем заполнены ли обязательные поля ввода, используя check_input 
функцию */
$yourname = check_input($_POST["yourname"], "Введите ваше имя!");
$tema = check_input($_POST["tema"], "Укажите тему сообщения!");
$email = check_input($_POST["email"], "Введите ваш e-mail!");
$message = check_input($_POST["message"], "Вы забыли написать сообщение!");
/* Проверяем правильно ли записан e-mail */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
show_error("<br /> Е-mail адрес не существует");
}
// условие проверки, если поле spam пустое, то форма обрабатывается, 
//иначе выходим (для роботов)
if (empty($spam)){ 
$to = "zolotuhinmolodez@gmail.com"; // кому отправляем форму
$from = "no-replay@mail.com"; // от кого отправлена форма
$subject = "message for your site"; // тема сообщения
$headers = "From: $from\r\nReplay-To: $from\r\nContent-type: text/plain; charset=utf-8\r\n";
if (mail($myemail, $tema, $message_to_myemail, $from)) 
{echo "";
}else{
    echo "Error! The letter was not sent!";}
} else exit ;
/* Создаем новую переменную, присвоив ей значение */
$message_to_myemail = "Здравствуйте! 
Вашей контактной формой было отправлено сообщение! 
Имя отправителя: $yourname 
E-mail: $email 
Website: $your_website
Тема обращения: $tema
Текст сообщения: $message 
Конец";
/* Отправляем сообщение, используя mail() функцию */
$from  = "From: $yourname <$email> \r\n Reply-To: $email \r\n"; 
if (mail($myemail, $tema, $message_to_myemail, $from)) 
{echo "";
}else{
    echo "Error! The letter was not sent!";}    
?>
    <div class="mail-send">
      <p class="mail-text">Ваше сообщение было успешно отправлено!</p>
      <a class="button-mail" href="index-ru.html">
        Вертуться на главную
      </a>
    </div>
    <?php
/* Если при заполнении формы были допущены ошибки сработает 
следующий код: */
function check_input($data, $problem = "")
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
if ($problem && strlen($data) == 0)
{
show_error($problem);
}
return $data;
}
function show_error($myError)
{
?>
    <p>Пожалуйста исправьте следующую ошибку:</p>
    <?php echo $myError; ?>
    <?php
exit();
}
?>
<?php
if($_FILES['fileFF']['size'] > 0) {
  $output = '<h1>Спасибо! Ваш файл получен.</h1>';
  $to = "zolotuhinmolodez@gmail.com"; // адрес почты получателя
  $from = "no-replay@mail.com"; // адрес почты отправителя
  $subject = "Заголовок письма";
  $message = "Содержимое письма";
  $attachment = chunk_split(base64_encode(file_get_contents($_FILES['fileFF']['tmp_name'])));
  $filename = $_FILES['fileFF']['name'];
  $filetype = $_FILES['fileFF']['type'];
  $boundary = md5(date('r', time())); // рандомное число
  $headers = "From: " . $from . "\r\n"; // см. наиболее часто используемые заголовки
  $headers .= "Reply-To: " . $from . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: multipart/mixed; boundary=\"_1_$boundary\"";
  $message="
--_1_$boundary
Content-Type: multipart/alternative; boundary=\"_2_$boundary\"
--_2_$boundary
Content-Type: text/plain; charset=\"utf-8\"
Content-Transfer-Encoding: 7bit
$message
--_2_$boundary--
--_1_$boundary
Content-Type: \"$filetype\"; name=\"$filename\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment // содержимое является вложенным
$attachment
--_1_$boundary--";
  mail($to, $subject, $message, $headers);
}
?>
  </div>
</div>
<div id="contact-footer" class="footer-static">
  <div class="container">
    <div class="copyright">
      &#169; 
      2016 Щербина Денис. Все права соблюдены и защищены. </div>
    <div class="footer-icons">
      <a href="https://www.facebook.com/profile.php?id=100002466302500" target="_blank" title="перейти на facebook" class="fb-icon">
      </a>
      <a href="https://www.linkedin.com/in/denis-shcherbina-a81668106?trk=nav_responsive_tab_profile_pic" target="_blank" title="перейти на linkedin" class="in-icon">
      </a>
      <a href="https://www.weblancer.net/users/chinitel/" target="_blank" title="перейти на weblancer" class="wb-icon">
      </a>
      <a href="https://freelancehunt.com/freelancer/chinitel.html?r=Y6PeJ" target="_blank" title="перейти на freelancehunt" class="freelance-icon">
      </a>
      <a href="http://www.upwork.com/o/profiles/users/_~01cfa4ff86eb5995a1/" target="_blank" title="перейти на upwork" class="icon-upwork">
      </a>
      <div class="prcy-custom">
      <script type="text/javascript">!function(e,t,r){e.PrcyCounterObject=r,e[r]=e[r]||function(){(e[r].q=e[r].q||[]).push(arguments)};var c=document.createElement("script");c.type="text/javascript",c.async=1,c.src=t;var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(c,n)}(window,"//a.pr-cy.ru/assets/js/counter.min.js","prcyCounter"),prcyCounter("sherbina.h1n.ru","prcyru-counter",0);</script>
      <div id="prcyru-counter"></div>
      <noscript><a href="//a.pr-cy.ru/sherbina.h1n.ru" target="_blank"><img src="//a.pr-cy.ru/assets/img/analysis-counter.png" width="88" height="31" alt="Analysis" ></a>
      </noscript>
      </div>
    </div>
  </div>
</div>
</body>
</html>