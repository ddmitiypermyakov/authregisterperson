<?php
  // Имя файла данных
  $filename = "bd.json";
  session_start();
  if(empty($_POST))
  {

    ?>
    <table>
      <form method=post action = <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
      <tr>
        <td>Логин:</td>
        <td><input type=text name=login required placeholder="Введите логин"></td>
      </tr>
      <tr>
        <td>Пароль:</td>
        <td><input type=password name=password required placeholder="Введите пароль"></td>
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
    $val_user = new ValidationAuth(NULL,htmlspecialchars(trim($_POST['login'])),htmlspecialchars(trim($_POST['password'])),NULL, NULL);
    //получаем временный массив
    $a = $val_user->tempArray($arr);
    //проверяем логин и пароль
    $val_user->personValidation($a);
    $val_user->passwordValidation($a);
    //при успешной авторизации выдаем сообщение, Добро пожаловать ....
    echo $val_user->personAuth($a);
       ?>

    <a href="logout.php">Выход</a>
<?php
  }

?>
