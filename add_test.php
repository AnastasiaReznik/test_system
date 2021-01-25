<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Главная</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
<?php
if (isset($_POST['nameTest']) AND !empty($_POST['nameTest'])) {

$res_add_test = addTest($db,$_POST);
if ($res_add_test) {
header("Location:" . $_SERVER['PHP_SELF']);
}  else {
alert('При добавлени теста произошла ошибка!');
}
} 
?>
<div class="container">
<a class="btn btn-primary" href="/" >На главную</a>
<h1 class="text-center">Добавление опроса</h1>
<form method="POST" action="" id="formAddTest">
    <h5 class="text-center">Название опроса</h5>
    <input class="form-control" type="text" name="nameTest" required>
<div class="container">
    <div class="row">
        <h4 class='text-center'>Вопрос№1</h4>
        <input type="text" required name='question1' class="newQuestion">
    </div>
    <div  class="radios">  
  <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answer1-1' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio1" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answer2-1' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio1" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answer3-1' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio1" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answer4-1' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio1" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
  </div>
  </div>
  <div class="row" style='margin-bottom:20px'>
      
  </div>
  <div class="row">
        <h4 class='text-center'>Вопрос№2</h4>
        <input type="text" name='question2' class="newQuestion" required>
    </div>
    <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answer1-2' class='newAnswer answ2' required>
      <input type="radio" class="form-check-input" id="" name="radio2" required>

    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answer2-2' class='newAnswer answ2' required>
      <input type="radio" class="form-check-input" id="" name="radio2" required>
      <!-- <input class="form-check-input" type="radio" name="answer2" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answer3-2' class='newAnswer answ2' required>
      <input type="radio" class="form-check-input" id="" name="radio2" required>
      <!-- <input class="form-check-input" type="radio" name="answer2" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answer4-2' class='newAnswer answ2' required>
      <input type="radio" class="form-check-input" id="" name="radio2" required>
      <!-- <input class="form-check-input" type="radio" name="answer2" id=""> -->
    </div>
</div>

<div class="row">
        <h4 class='text-center'>Вопрос№3</h4>
        <input type="text" required name='question3' class="newQuestion">
    </div>
    <div  class="radios">  
  <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answer1-3' class='newAnswer answ3' required>
      <input type="radio" class="form-check-input" id="" name="radio3" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answer2-3' class='newAnswer answ3' required>
      <input type="radio" class="form-check-input" id="" name="radio3" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answer3-3' class='newAnswer answ3' required>
      <input type="radio" class="form-check-input" id="" name="radio3" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answer4-3' class='newAnswer answ3' required>
      <input type="radio" class="form-check-input" id="" name="radio3" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
  </div>
  </div>
  <div class="row" style='margin-bottom:20px'>
      
  </div>

  <div class="row">
        <h4 class='text-center'>Вопрос№4</h4>
        <input type="text" required name='question4' class="newQuestion">
    </div>
    <div  class="radios">  
  <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answer1-4' class='newAnswer answ4' required>
      <input type="radio" class="form-check-input" id="" name="radio4" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answer2-4' class='newAnswer answ4' required>
      <input type="radio" class="form-check-input" id="" name="radio4" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answer3-4' class='newAnswer answ4' required>
      <input type="radio" class="form-check-input" id="" name="radio4" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answer4-4' class='newAnswer answ4' required>
      <input type="radio" class="form-check-input" id="" name="radio4" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
  </div>
  </div>
  <div class="row" style='margin-bottom:20px'>
      
  </div>

  <div class="row">
        <h4 class='text-center'>Вопрос№5</h4>
        <input type="text" required name='question5' class="newQuestion">
    </div>
    <div  class="radios">  
  <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answer1-5' class='newAnswer answ5' required>
      <input type="radio" class="form-check-input" id="" name="radio5" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answer2-5' class='newAnswer answ5' required>
      <input type="radio" class="form-check-input" id="" name="radio5" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answer3-5' class='newAnswer answ5' required>
      <input type="radio" class="form-check-input" id="" name="radio5" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answer4-5' class='newAnswer answ5' required>
      <input type="radio" class="form-check-input" id="" name="radio5" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
  </div>
  </div>
  <div class="row" style='margin-bottom:20px'>
      
  </div>
  <div class="row-sm" style='margin-top:20px; text-align:center'>
    <button type="submit" class="btn btn-primary">Добавить</button>
  </div>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>

<script> 
//проверка выбрано ли радио-поле
// $('#formAddTest').submit(function (e) {
//     e.preventDefault();
    // console.log($(this).parent(".container").find('input[name="nameTest"]').val());  //название опроса

// })
// $('.btn').on('click', function (e) {
//     e.preventDefault();
//     var check = '';
//     var check1 = false;
//     var check2 = false;

//     $("input[name ='answer1']").each(function (index, val) {
//         check = $(this).prop("checked");
//        if (check == true) {
//             // console.log('ответ выбран');
//             check1 = check;
//             return false; //радио-кнопка выбрана
//        }
//     });

//     $("input[name ='answer2']").each(function (index, val) {
//         check = $(this).prop("checked");        
//        if (check == true) {
//             check2 = check;
//             return false; //радио-кнопка выбрана
//        }
//     });

//     if (check1 == true && check2 == true)) {
//         console.log('все ответы выбраны');
//     } else {
//         console.log('Выберите правильный вариант ответа!');
//     }
// });
</script>

