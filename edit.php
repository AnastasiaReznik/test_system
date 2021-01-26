<?php
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET)) {
    $res_check_get = checkIssetGet($arr_get, $db);
    if ($res_check_get == 'true') {
        header("Location: edit.php?edit=1");
        die();
    }
  } 
  else {
    header("Location: edit.php?edit=1");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['nameTestEdit']) AND !empty($_POST['nameTestEdit'])) {
    foreach ($_POST as $key => $value) {
        if (is_string($value) OR is_int($value)) {
            $res_update = updateTest($db,$_POST);
            if ($res_update) {
                header("Refresh:0");
                // header("Location:" . $_SERVER['PHP_SELF']);
                // echo $res_update;
            } else {
                alert('При редактировании произошла ошибка!');
            }
        }
    }
}
$allTest = queryAll($db,'survey','id', $_GET['edit'] );
// debug($allTest);
$questions =  queryAll($db,'questions', 'id_survey', $_GET['edit']);
// debug($questions);
$all_answers = queryAll($db,'answer', 'id_survey', $_GET['edit']);
// debug($all_answers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Редактирование</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
<a class="btn btn-primary" href="/" >На главную</a>
<h1  class="text-center">Редактирование опроса</h1>
<form method='POST' id="testEdit" class="text-center">
<h3>Название опроса</h3>
<input style="width: 400px;" class="form-control mx-auto" type="text" name="nameTestEdit" value="<?= $allTest[0]['name']; ?>" required>
<h4>Вопросы</h4>
    <?php foreach ($questions as $key => $question) : ?>
    <span hidden> <?= $num = 0; ?> </span> 
    <h6>Вопрос <?= $key+1; ?> </h6>
    <input  style="margin-bottom: 20px;width: 600px; " class="form-control mx-auto" type="text" name="nameQuestionEdit<?= $question['id']; ?>" value="<?= $question['questions']; ?>" required>
        <ul class="list-unstyled">
            <?php foreach ($all_answers as $num_answer => $answer) : ?>
                <?php if ( $key+1 == $answer['id_question'] ) : ?>
                <span hidden> <?= $num++; ?> </span> 
                        <li>
                        <span>Ответ<?= $num;?></span>
                        <input for="" name="answer<?= $answer['id']; ?>" value=<?=$answer['answer'];  ?> required>
                        <?php if ($answer['correct_answer'] == '1') : ?>
                        <input class="form-check-input" type="radio" name="radio<?= $answer['id_question']; ?> " data-correct=<?=$answer['correct_answer']?> required checked>
                        <?php else : ?>
                        <input class="form-check-input" type="radio" name="radio<?= $answer['id_question']; ?> " data-correct=<?=$answer['correct_answer']?> required >
                        <?php endif; ?>
                        </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
        <div class="wrapper">
        <button type="submit" class="btn btn-warning finishTest">Сохранить</button>
        </div>

        <div class="alert alert-success result" role="alert" hidden>
        </div>
        <div class="alert alert-danger result-uncor" role="alert" hidden>       
        </div>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>

