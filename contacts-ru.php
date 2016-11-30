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
    <a class="logo roboto" href="index-ru.html">
      SHCHERBINA DENIS<br>
      <span class="icon-logo roboto"></span><span class="text-small">Веб-разработчик</span>
    </a>
    <ul class="menu roboto" id="smooth-menu">
      <li>
        <a href="about-ru.html" class="inner">
          О СЕБЕ
        </a>
      </li>
      <li>
        <a class="inner jobs" href="#jobs">
          ПОРТФОЛИО
        </a>
      </li>
      <li>
        <a href="testimonials-ru.html" class="inner">
          ОТЗЫВЫ
        </a>
      </li>
      <li>
        <a class="inner" href="contact-ru.html">
          КОНТАКТЫ
        </a>
      </li>
      <li>
        <a class="inner" href="price.html">
          СТОИМОСТЬ
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
      <a class="button-mail" href="index.html">
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
  </div>
</div>
<div id="contact-footer" class="footer-static">
  <div class="container">
    <div class="copyright">
      &#169; 
      2016 Щербина Денис. Все права соблюдены и защищены. </div>
    <a href="https://www.facebook.com/profile.php?id=100002466302500" class="fb-icon">
    </a>
    <a href="https://www.linkedin.com/in/denis-shcherbina-a81668106?trk=nav_responsive_tab_profile_pic" class="in-icon">
    </a>
  </div>
</div>
</body>
</html>