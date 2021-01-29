<?php
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET)) {
  header("Location: add_test.php");
} 
if ($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['nameTest']) AND !empty($_POST['nameTest'])) {
  foreach ($_POST as $key => $value) {
    if (is_string($value) OR is_int($value)) {  
      $res_check_type = 'true';
    } else {
      $res_check_type = 'false';
      break;
      }
      }
      if ($res_check_type == 'true') {
        $res_add_test = addTest($db,$_POST);
        if ($res_add_test) {
          header("Location: index.php");
          die();
        }
      }  else {
        echo 'ошибка';
      }     
    }
  // }
$page = 'Добавление теста';

?>
<?php require_once 'header.php'; ?>
<div class="container">
<a class="btn btn-primary" href="/" >На главную</a>
<h1 class="text-center">Добавление опроса</h1>
<form method="POST" action="" id="formAddTest">
    <h5 class="text-center">Название опроса</h5>
    <input class="form-control" type="text" name="nameTest" required>
<div class="container">
<?php for ($i=0; $i < $count_question_in_test; $i++) : ?>
  <div class="row">
        <h4 class='text-center'>Вопрос№<?= $i+1 ?></h4>
        <input type="text" required name='question<?= $i+1 ?>' class="newQuestion">
    </div>
    <div  class="radios">  
  <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answer1-<?= $i+1?>' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio<?=  $i+1 ?>" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answer2-<?= $i+1?>' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio<?=  $i+1 ?>" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answer3-<?= $i+1?>' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio<?=  $i+1 ?>" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answer4-<?= $i+1?>' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio<?=  $i+1 ?>" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
  </div>
  </div>
  <div class="row" style='margin-bottom:20px'>
      
  </div>
<?php endfor; ?> 
  <div class="row-sm" style='margin-top:20px; text-align:center'>
    <button type="submit" class="btn btn-primary">Добавить</button>
  </div>
</form>
<?php require_once 'footer.php'; ?>

