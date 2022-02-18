/* Article FructCode.com */
$( document ).ready(function() {
    $("#btn").click(
    function(){

      //$('form').hide();
      sendAjaxForm('result_form', 'ajax_form_auth', 'action_ajax_form.php');
      return false;
    }
  );
});

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
          result = $.parseJSON(response);



          if (result.error1='emptyfield')
          {
          $("#result_form").html('Поле логин и пароль обязательные!');
          }
          else
          {
          $("table").remove();
          $("#result_form").html('Добро пожаловать,  ' + result.name +'<br><a href="logout.php">Выход</a>' );
        }
      },
      error: function(response) { // Данные не отправлены
            result = $.parseJSON(response,status,error);
            $('#result_form').html('Ошибка. Данные не отправлены.');
      }
  });
}
