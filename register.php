<table>
<form action = "" method=post>
<tr><td>Имя:</td><td><input type=text name=name required minlength="2" maxlength="2"></td></tr>
<tr><td>Логин:</td><td><input type=text name=login required minlength="6"></td></tr>
<tr><td>Пароль:</td><td><input type=password name=password required minlength="6"></td></tr>
<tr><td>Пароль(еще раз):</td><td><input type=password name=confirm_password required></td></tr>
<tr><td>e-mail:</td><td><input type=email name=email required></td></tr>

<tr><td></td><td><input type=submit value='Зарегистрироваться'></td></tr>
</form>
</table>
<?php

  session_start();

  if ($_POST) {
  $_POST['password'] = trim($_POST['password']);
  $_POST['confirm_password'] = trim($_POST['confirm_password']);

  $login = trim($_POST['login']);



    include "validation_person.php";
    //задаем конструктор
    $value_user = new ValidationAuth(trim($_POST['name']),trim($_POST['login']),trim($_POST['password']),trim($_POST['confirm_password']), trim($_POST['email']));
    //Подключаем валидацию
    $filename = "bd.json";
    $arr = file($filename);
    $value_user->alnumPassword();
    $value_user->boolPasswordandConfirmPassword();
    $value_user->validationEmail();
    $value_user->validationAlName();

    $a = $value_user->tempArray($arr);
    $value_user->personValidationExists($a);
    include "crud_bd.php";


    $save_database=new WorkWithdatabaseJSON($_POST['name'],$_POST['login'],$_POST['password'], $_POST['email']);

    $save_database->AddDatabaseJSON();
  };
  //очищаем сессию
  //session_unset();
  ?>