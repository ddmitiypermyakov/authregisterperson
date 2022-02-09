<?php
?>
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

  if ($_POST) {
  $_POST['password'] = trim($_POST['password']);
  $_POST['confirm_password'] = trim($_POST['confirm_password']);

  $login = trim($_POST['login']);

};


  // Проверяем не пустой ли суперглобальный массив $_POST
  if(empty($login)) exit();
  if(strlen($_POST['password']) < 6 ) exit('Поле пароль короткое. Должно быть 6 символов');
  // Проверяем правильно ли заполнены обязательные поля
  if(empty($login)) exit('Поле "Логин" не заполнено');
  if(empty($_POST['password'])) exit('Одно из полей "Пароль" не заполнено');
  if(empty($_POST['confirm_password'])) exit('Одно из полей "Пароль" не заполнено');
  if($_POST['password'] != $_POST['confirm_password']) exit('Пароли не совпадают');
  // Если введён e-mail проверяем его на соответсвие
  if(!empty($_POST['email']))
  {
    if(!preg_match("|^[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email']))
    {
      exit('Поле "E-mail" должно соответствовать формату somebody@somewhere.ru');
    }
  }

  /////////////////////////////////////////////////
  // 2. Блок проверки имени на уникальность
  /////////////////////////////////////////////////
  // Имя файла данных
  $filename = "bd.json";
  // Проверяем не было ли переданное имя
  // зарегистрировано ранее
  $arr = file($filename);
  echo $arr;
  foreach($arr as $line)
  {
    // Разбиваем строку по разделителю ::
    $data = explode(",",$line);
    // В массив $temp помещаем имена уже зарегистрированных
    // посетителей
    $temp[] = $data[0];
  }

  // Проверяем не содержится ли текущее имя
  // в массиве имён $temp
  if(in_array($login, $temp))
  {
    exit("Данное имя уже зарегистрировано, пожалуйста, выберите другое");
  }

  /////////////////////////////////////////////////
  // 3. Блок регистрации пользователя
  /////////////////////////////////////////////////
  // Помещаем данные в текстовый файл
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
  // Осуществляем перезагрузку страницы,
  // чтобы сбросить POST-данные
  echo "<HTML><HEAD>
         <META HTTP-EQUIV='Refresh' CONTENT='0; URL=$_SERVER[PHP_SELF]'>
        </HEAD></HTML>";
?>