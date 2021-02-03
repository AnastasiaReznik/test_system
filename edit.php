<?php
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET)) {
    $res_check_get = checkIssetGet($arr_get, $db, 'edit', 'survey');
    if ($res_check_get === false) {
        header("HTTP/1.0 404 Not Found");
        die();
    }
  } else {
    header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST) AND !empty($_POST)) {
    $resCheck = checkDataForm($_POST);
    if ($resCheck === true) {
        foreach ($_POST as $key => $value) {
            if (is_string($value) OR is_int($value)) {
                $res_update = updateTest($db,$_POST);
                if ($res_update) {
                    header("Refresh:0");
                } else {
                    echo "<script>alert('Ошибка при отправке формы')</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Ошибка при отправке формы')</script>";
    }
}
$allTest = queryAll($db,'survey','id', $_GET['edit'] );
// debug($allTest);
$questions =  queryAll($db,'questions', 'id_survey', $_GET['edit']);
// debug($questions);
$all_answers = queryAll($db,'answer', 'id_survey', $_GET['edit']);
// debug($all_answers);
$page = 'Редактирование теста';
?>
<?php require_once 'header.php'; ?>

<a class="btn btn-primary" href="/" >На главную</a>
<h1  class="text-center">Редактирование опроса</h1>
<form method='POST' id="testEdit" class="text-center">
<h3>Название опроса</h3>
<input style="width: 400px;" class="form-control mx-auto" type="text" name="nameTestEdit" value="<?= htmlspecialchars($allTest[0]['name'], ENT_QUOTES,'utf-8'); ?>" required>
<h4>Вопросы</h4>
    <?php foreach ($questions as $key => $question) : ?>
    <span hidden> <?= $num = 0; ?> </span> 
    <h6>Вопрос <?= $key+1; ?> </h6>
    <input  style="margin-bottom: 20px;width: 600px; " class="form-control mx-auto" type="text" name="nameQuestionEdit<?= htmlspecialchars($question['id'], ENT_QUOTES,'utf-8'); ?>" value="<?= htmlspecialchars($question['questions'],ENT_QUOTES,'utf-8'); ?>" required>
        <ul class="list-unstyled">
            <?php foreach ($all_answers as $num_answer => $answer) : ?>
                <?php if ( $key+1 == $answer['id_question'] ) : ?>
                <span hidden> <?= $num++; ?> </span> 
                        <li>
                        <span>Ответ<?= $num;?></span>
                        <input for="" name="answer<?= htmlspecialchars($answer['id'], ENT_QUOTES,'utf-8'); ?>" value=<?= htmlspecialchars($answer['answer'], ENT_QUOTES,'utf-8');  ?> required>
                        <?php if ($answer['correct_answer'] == '1') : ?>
                        <input class="form-check-input" type="radio" name="radio<?= htmlspecialchars($answer['id_question'], ENT_QUOTES,'utf-8'); ?> " data-correct=<?= htmlspecialchars($answer['correct_answer'], ENT_QUOTES,'utf-8')?> required checked>
                        <?php else : ?>
                        <input class="form-check-input" type="radio" name="radio<?= htmlspecialchars($answer['id_question'], ENT_QUOTES,'utf-8'); ?> " data-correct=<?= htmlspecialchars($answer['correct_answer'], ENT_QUOTES,'utf-8')?> required >
                        <?php endif; ?>
                        </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
        <div class="wrapper">
        <button type="submit" class="btn btn-warning finishTest">Сохранить</button>
        </div>
        <?php  if (isset($_SESSION['error']) AND !empty($_SESSION['error'])) : ?>
            <div class="alert alert-danger result-uncor" role="alert">
            <?= $_SESSION['error']; ?>    
        </div>
        <?php endif; ?>
</form>
<?php require_once 'footer.php'; ?>


