<?php

session_start();
setcookie(session_name(), "", time() - 3600); //отправляет брауеру удалить текущую session_name (session_id) из кук
session_destroy(); //удалить сохраненный session_login
session_write_close();
header('Location: /testask/testask/');

?>