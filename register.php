<table>
<form method=post>
<tr><td>Имя:</td><td><input type=text name=name></td></tr>
<tr><td>Логин:</td><td><input type=text name=login></td></tr>
<tr><td>Пароль:</td><td><input type=password name=password></td></tr>
<tr><td>Пароль(еще раз):</td><td><input type=password name=confirm_password></td></tr>
<tr><td>e-mail:</td><td><input type=text name=email></td></tr>

<tr><td></td><td><input type=submit value='Зарегистрироваться'></td></tr>
</form>
</table>
<?php

  session_start();

  if ($_POST) {
  $_POST['password'] = trim($_POST['password']);
  $_POST['confirm_password'] = trim($_POST['confirm_password']);

  $login = trim($_POST['login']);

};

  $filename = "bd.json";

  $arr = file($filename);

  $fd = fopen($filename, "a");
  if(!$fd) exit("Ошибка при открытии файла данных");

  $arr_new= [
    "name" => $_POST['name'],
    "login" =>$login,
    "password" =>$_POST['password'],
    "email" =>$_POST['email'],
];
    $json = json_encode($arr_new);


  fwrite($fd,$json."\r\n");

  fclose($fd);
    //очищаем сессию
  session_unset();
  ?>