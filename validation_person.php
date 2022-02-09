<?php
  class ValidationAuth
    {





        public function __construct(string $name=NULL,string $login=NULL,string $password=NULL,string $email=NULL)
        {

          $this->name = $name;
          $this->login = $login;
          $this->password = $password;
          $this->email = $email;
        }

        public function tempArray($arr)
          {
            $i = 0;
            $temp = [];

              foreach($arr as $line)
            {
              // Добавляем данные во временный массив temp для сравнения

              $data = json_decode($line, true);

              // В массив $temp помещаем имена и пароли
              // зарегистрированных посетителей
              $temp['name'][$i]     = $data['name'];
              $temp['login'][$i] = $data['login'];
              $temp['password'][$i]    = $data['password'];
              $temp['email'][$i]      = $data['email'];
              // счетчик
              $i++;
            }
            return $temp;
          }
        //проверяем на наличие логина в БД
        public function personValidation($temp)

        {

            if(!in_array($this->login,$temp['login']))
              {
  ?>
                <a href="register.php">Регистрация</a>
                <a href="auth.php">Назад</a>
  <?php
                exit("Пользователя не существует.");
              }
        }

        //проверяем на соответствие логина паролю в БД
        public function passwordValidation($temp)

        {
          $this->index = array_search($this->login,$temp['login']);

            if($this->password != $temp['password'][$this->index])
              {

  ?>

                <a href="auth.php">Назад</a>
  <?php
                exit("Пароль не тот, попробуй еще раз");
              }
        }

        //Если пользователь авторизовался
        public function personAuth($temp)

      {
        return "Добро пожаловать,".$temp['name'][$this->index]."Вы авторизовались!";
      }
    }

?>
