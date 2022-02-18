<?php
  // Имя файла данных
  $filename = "bd.json";
  session_start();
  //var_dump($_SESSION['login']);
  //setcookie("login", NULL, time() + 3600*24*7);

  //_SESSION['login']=='NULL';

  if(empty($_POST) && (empty($_SESSION['login'])) )
  {

    ?>
    <script src="ajax.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <table>
      <form method=post id="ajax_form" action = <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
      <tr>
        <td>Логин:</td>
        <td><input type=text name=login required placeholder="Введите логин" required="required"></td>
      </tr>
      <tr>
        <td>Пароль:</td>
        <td><input type=password name=password required placeholder="Введите пароль" required="required"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type=submit value='Войти'></td>

      </tr>

      </form>
   </table>
   <div id="result_form"></div>
   <a href="register.php">Регистрация</a>

   <?php

  }
  else
  {
    ?>
     <div id="result_form"></div>
    <?php

      if (empty($_SESSION["login"]))
       {
      $_SESSION["login"] = $_POST["login"];
      $_SESSION["password"] = $_POST["password"];
      }



    $arr = file($filename);

    include "validation_person.php";
    //задаем конструктор
    $val_user = new ValidationAuth(NULL,htmlspecialchars(trim($_SESSION["login"])),htmlspecialchars(trim($_SESSION["login"])),NULL, NULL);
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
