<?php

    $filename = "bd.json";
    $arr = file($filename);

      if (empty($_SESSION["login"]))
       {
      $_SESSION["login"] = $_POST["login"];
      $_SESSION["password"] = $_POST["password"];
      }




      include "validation_person.php";
    //задаем конструктор
    $val_user = new ValidationAuth(NULL,htmlspecialchars(trim($_SESSION["login"])),htmlspecialchars(trim($_SESSION["password"])),NULL, NULL);

    $a = $val_user->tempArray($arr);
    //$b= $val_user->personValidation1($a);



if (empty($_SESSION["login"]) or empty($_SESSION["password"]) ) {

	// Формируем массив для JSON ответа
    $result = array(
    	'error1' => 'emptyfield',


    );
}

else {



	// Формируем массив для JSON ответа
    $result = array(
    	'login' => $_SESSION["login"],
    	'password' => $_SESSION["password"],
        'name' => $a['name'],



    );

    // Переводим массив в JSON

    //echo json_encode($result);
    //echo "Привет";
}

echo json_encode($result);
?>
