<?php
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST) AND !empty($_POST)) {
  $resCheck = checkDataForm($_POST);
  if ($resCheck === true) {
        $res_add_test = addTest($db,$_POST);
          if ($res_add_test === true) {
            header("Location: index.php");
            die();
        }  else {
          echo 'ошибка';
        }     
  } else {
    echo "<script>alert('Ошибка при заполнении формы. Все поля должны быть заполнены!')</script>";
  }
    }
$page = 'Добавление теста';

?>
<?php require_once 'header.php'; ?>
<div class="container">
<a class="btn btn-primary" href="/" >На главную</a>
<h1 class="text-center">Добавление опроса</h1>
<form method="POST" action="" id="formAddTest">
    <h5 class="text-center">Название опроса</h5>
    <input class="form-control" type="text" name="nameTest" 
    value = "<?php if (isset($_POST['nameTest'])) {echo $_POST['nameTest']; }; ?>" required>
<div class="container">
<?php for ($i=0; $i < $count_question_in_test; $i++) : ?>
  <div class="row">
        <h4 class='text-center'>Вопрос№<?= $i+1 ?></h4>
        <input type="text" required name="questions[question<?=$i+1?>]" class="newQuestion" 
        value = "<?php  if (isset($_POST['nameTest'])) {$num_quest = $i + 1; echo $_POST['questions']['question' . $num_quest]; }; ?>" >
    </div>
    <div  class="radios">  
  <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answers[answer1-<?= $i+1?>]' class='newAnswer answ1' required
      value = "<?php  if (isset($_POST['nameTest'])) {$num_ans = $i + 1; echo $_POST['answers']['answer1-' . $num_ans]; }; ?>"
      >
      <input type="radio" class="form-check-input" id="" name="answers[radio<?= $i+1 ?>]" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answers[answer2-<?= $i+1?>]' class='newAnswer answ1' required
      value = "<?php  if (isset($_POST['nameTest'])) {echo $_POST['answers']['answer2-' . $num_ans]; }; ?>"
      >
      <input type="radio" class="form-check-input" id="" name="answers[radio<?=  $i+1 ?>]" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answers[answer3-<?= $i+1?>]' class='newAnswer answ1' required
      value = "<?php  if (isset($_POST['nameTest'])) {echo $_POST['answers']['answer3-' . $num_ans]; }; ?>"
      >
      <input type="radio" class="form-check-input" id="" name="answers[radio<?=  $i+1 ?>]" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answers[answer4-<?= $i+1?>]' class='newAnswer answ1' required
      value = "<?php  if (isset($_POST['nameTest'])) {echo $_POST['answers']['answer4-' . $num_ans]; }; ?>"
      >
      <input type="radio" class="form-check-input" id="" name="answers[radio<?=  $i+1 ?>]" required>
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

