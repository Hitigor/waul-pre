<?PHP header("Content-Type: text/html; charset=utf-8");
?>

<?
// ----------------------------конфигурация-------------------------- //

$adminemail="hitigor@yandex.ru";  // e-mail админа


$date=date("d.m.y"); // число.месяц.год

$time=date("H:i"); // часы:минуты:секунды

$backurl="index.html";  // На какую страничку переходит после отправки письма

//---------------------------------------------------------------------- //



// Принимаем данные с формы

$email=$_POST['email'];


// Проверяем валидность e-mail

if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is",
    strtolower($email)))

{

    echo
    "<center>Please come back <a 
href='javascript:history.back(1)'><B>back</B></a>. Invalid data";

}

else

{


    $msg=" 
 
 <p>E-mail: $email</p> 
 
 ";



    // Отправляем письмо админу

    mail("$adminemail", "$date $time Сообщение 
от $name", "$msg");



// Сохраняем в базу данных

    $f = fopen("message.txt", "a+");

    fwrite($f," \n $date $time Сообщение от $name");

    fwrite($f,"\n $msg ");

    fwrite($f,"\n ---------------");

    fclose($f);



// Выводим сообщение пользователю

    print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 6000); 
//--></script> 
 
$msg 
 
<p>Message sent! Wait for redirection to main page...</p>";
    exit;

}

?>