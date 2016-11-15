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
$myemail = "topbike-spb@yandex.ru";
/* Проверяем заполнены ли обязательные поля ввода, используя check_input 
функцию */
$yourname = check_input($_POST["yourname"], "Введите ваше имя!");
$tema = check_input($_POST["tema"], "Укажите тему сообщения!");
$email = check_input($_POST["email"], "Введите ваш e-mail!");
$message = check_input($_POST["message"], "Вы забыли написать сообщение!");
$your_website = check_input($_POST["your_website"], "Введите свой website!");

/* Проверяем правильно ли записан e-mail */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
show_error("<br /> Е-mail адрес не существует");
}
// условие проверки, если поле spam пустое, то форма обрабатывается, 
//иначе выходим (для роботов)
if (empty($spam)){ 
$to= "topbike-spb@yandex.ru";
$from = "no-replay@mail.com";
$subject = "message for your site";
$headers = "From: $from\r\nReplay-To: $from\r\nContent-type: text/plain; charset=utf-8\r\n";
mail($to, $subject, $send, $headers);
} else exit ;
/* Создаем новую переменную, присвоив ей значение */
$message_to_myemail = "Здравствуйте! 
Вашей контактной формой было отправлено сообщение! 
Имя отправителя: $yourname 
E-mail: $email 
Текст сообщения: $message 
Конец";
/* Отправляем сообщение, используя mail() функцию */
$from  = "From: $yourname <$email> \r\n Reply-To: $email \r\n"; 
mail($myemail, $tema, $message_to_myemail, $from);
?>
<p>Ваше сообщение было успешно отправлено!</p>
<p>На
  <a href="index.html">
    Главную
    >
    >
    >
  </a>
</p>
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
<html>
<body>
<p>Пожалуйста исправьте следующую ошибку:</p>
<?php echo $myError; ?>
</body>
</html>
<?php
exit();
}
?>