<?php
  class ValidationAuth
    {





        public function __construct(string $name=NULL,string $login=NULL,string $password=NULL,string $password2=NULL, string $email=NULL)
        {

          $this->name = $name;
          $this->login = $login;
          $this->password = $password;
          $this->password2 = $password2;
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
                <a href="">Назад</a>
  <?php
                exit("Пользователя не существует.");
              }
        }

         public function personValidationExists($temp)

        {

            if(in_array($this->login,$temp['login']))
              {


                exit("Пользователь с таким именем существует.");
              }
        }

             public function emailValidationExists($temp)

        {

            if(in_array($this->email,$temp['email']))
              {


                exit("Пользователь с такой почтой существует.");
              }
        }



        //проверяем на соответствие логина паролю в БД
        public function passwordValidation($temp)

        {
          if (!empty($temp['login']))
          {
              $this->index = array_search($this->login,$temp['login']);

                if("md5.".md5($this->password) != $temp['password'][$this->index])
              {

  ?>

                  <a href="">Назад</a>
  <?php
                    exit("Пароль не тот, попробуй еще раз");
              }
            }
        }

        //Если пользователь авторизовался
        public function personAuth($temp)

      {
        return "Добро пожаловать, ".$temp['name'][$this->index].". Вы авторизовались!";
      }

     //проверка на наличии только букв и цифр
      public function alnumPassword()
      {
        if(!ctype_alnum($this->password)) exit('Пароль не состоит только из букв и цифр');
      }
       //сравнение паролей
      public function boolPasswordandConfirmPassword()
      {
        if($this->password != $this->password2) exit('Пароли не совпадают');
      }

      public function validationEmail()
      {
        if (!filter_var($this->email,FILTER_VALIDATE_EMAIL)) exit('Адрес указан неверно');
      }

      public function validationAlName()
      {

        if (!ctype_alpha($this->name))  exit('Имя должно содержать только буквы');
      }


}

?>
