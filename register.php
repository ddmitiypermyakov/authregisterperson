<table>
<form action = <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method=post>
<tr><td>Имя:</td><td><input type=text name=name required minlength="2" maxlength="2" placeholder="Имя"></td></tr>
<tr><td>Логин:</td><td><input type=text name=login required minlength="6" placeholder="Логин"></td></tr>
<tr><td>Пароль:</td><td><input type=password name=password required minlength="6" placeholder="Пароль"></td></tr>
<tr><td>Пароль(еще раз):</td><td><input type=password name=confirm_password required placeholder="Пароль"></td></tr>
<tr><td>e-mail:</td><td><input type=email name=email required placeholder="Почта"></td></tr>

<tr><td></td><td><input type=submit value='Зарегистрироваться'></td></tr>

</form>

</table>
<?php

  session_start();

  if ($_POST) {

    include "validation_person.php";
    //задаем конструктор
    $value_user = new ValidationAuth(htmlspecialchars(trim($_POST['name'])),htmlspecialchars(trim($_POST['login'])),htmlspecialchars(trim($_POST['password'])),htmlspecialchars(trim($_POST['confirm_password'])), htmlspecialchars(trim($_POST['email'])));
    //Подключаем валидацию
    $filename = "bd.json";
    $arr = file($filename);
    $value_user->alnumPassword();
    $value_user->boolPasswordandConfirmPassword();
    $value_user->validationEmail();
    $value_user->validationAlName();

    $a = $value_user->tempArray($arr);
    $value_user->personValidationExists($a);
    $value_user->emailValidationExists($a);

    include "crud_bd.php";

    $save_database=new WorkWithdatabaseJSON(trim($_POST['name']),trim($_POST['login']),trim($_POST['password']), trim($_POST['email']));

    $save_database->AddDatabaseJSON();

  };
  //очищаем сессию
  //session_unset();
  ?>
