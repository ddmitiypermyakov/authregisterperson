<?php
  // Имя файла данных
  $filename = "bd.json";
  //session_start();
  //var_dump($_SESSION['login']);
  //setcookie("login", NULL, time() + 3600*24*7);

  //_SESSION['login']=='NULL';

  ?>


    <table>
      <form id="ajax_form_auth" action = 'post'>
      <tr>
        <td>Логин:</td>
        <td><input type=text name=login required placeholder="Введите логин" required="required"></td>
      </tr>
      <tr>
        <td>Пароль:</td>
        <td><input type=password name=password required placeholder="Введите пароль" required="required"></td>

      <tr>
        <td>&nbsp;</td>
        <td><input type=submit id="btn" value='Войти'></td>

      </tr>

      </form>
   </table>
   <div id="result_form"></div>
   <a href="register.php">Регистрация</a>
 <script type="text/javascript" src="jquery.min.js"></script>
    <script src="ajax_auth.js"></script>
    </script>
   <?php



?>
