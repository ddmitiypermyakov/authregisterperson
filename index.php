<?php
  // Имя файла данных
  $filename = "bd.json";
  session_start();
  if(empty($_POST))
  {
    ?>
    <table>
      <form method=post>
      <tr>
        <td>Логин:</td>
        <td><input type=text name=login></td>
      </tr>
      <tr>
        <td>Пароль:</td>
        <td><input type=password name=password></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type=submit value='Войти'></td>

      </tr>

      </form>
   </table>
   <a href="register.php">Регистрация</a>
   <?php

  }
  else
  {
    $arr = file($filename);

    include "validation_person.php";
    //задаем конструктор
    $val_user = new ValidationAuth(NULL,$_POST['login'],$_POST['password'],NULL, NULL);
    //получаем временный массив
    $a = $val_user->tempArray($arr);
    //проверяем логин и пароль
    $val_user->personValidation($a);
    $val_user->passwordValidation($a);
    //при успешной авторизации выдаем сообщение, Добро пожаловать ....
    echo $val_user->personAuth($a);


    ?>

    <a href="">Выход</a>
<?php
  }

?>
