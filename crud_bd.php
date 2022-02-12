<?php
  class WorkWithdatabaseJSON
    {

        public function __construct(string $name=NULL,string $login=NULL,string $password=NULL,string $email=NULL)
        {

          $this->name = $name;
          $this->login = $login;
          $this->password = $password;
          $this->email = $email;
        }

        public function AddDatabaseJSON()
          {
            $filename = "bd.json";
            $arr = file($filename);

            $fd = fopen($filename, "a");
            if(!$fd) exit("Ошибка при открытии файла данных");
            $arr_new= [
                        "name" => $this->name,
                        "login" =>$this->login,
                        "password" =>"md5.".md5($this->password),
                        "email" =>$this->email,
                      ];
            $json = json_encode($arr_new);
            fwrite($fd,$json."\r\n");
            fclose($fd);
            ?>
              <a href="index.php">Авторизация</a>
            <?php

          }


    }
?>
