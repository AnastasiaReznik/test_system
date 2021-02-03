<?php
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET)) {
    $res_check_get = checkIssetGet($arr_get, $db, 'test', 'survey');
    if ($res_check_get === false) {
        header("HTTP/1.0 404 Not Found");
        die();
    }
  } else {
    header("Location: index.php");
}

if (isset($_POST) AND !empty($_POST)) {
        $count_success = 0;
        $count_errors = 0;
        $result_test='';
        foreach ($_POST as $key => $value) {
            $now = current($_POST);
            $next = next($_POST);
            if ($value == 'on') {
                if ($next == '1') {
                    $count_success++;
                } else {
                    $count_errors++;
                }
            }
        }
        $stmt = $db->prepare("UPDATE survey SET `count_correct_answer` = ?, `count_errors_answer` = ? WHERE `id` = ?"); 
        $res_update = $stmt->execute([$count_success, $count_errors, $_GET['test']]);
    
        // запись результата теста в бд
        if ( $count_success >= 3) {
            $field= 'success';
        } else {
            $field= 'fail';
        }
        $res = addResultTest($db,$field, $_GET['test']);
        if ($res) {
            header("Location: showResult.php?result_id=" . $_GET['test']); //здесь должен передаться id теста
            die();
        } else {
            echo "<script>alert('Ошибка!')</script>";
        }
};

$allTest = queryAll($db,'survey','id', $_GET['test']);
// debug($allTest);

$questions =  queryAll($db,'questions', 'id_survey', $_GET['test']);
// debug($questions);

$all_answers = queryAll($db,'answer', 'id_survey', $_GET['test']);
// debug($all_answers);

    $page = 'Тест';
?>
<?php require_once 'header.php'; ?>
<div class="container">
<a class="btn btn-primary" href="/" >На главную</a>
<h1 class='nameTest text-center' data-id="<?=  htmlspecialchars($allTest[0]['id'], ENT_QUOTES,'utf-8') ?>"><?= htmlspecialchars($allTest[0]['name'], ENT_QUOTES,'utf-8');  ?></h1>
<form method='POST' style="width:500px" id="test" class="mx-auto">
    <?php foreach ($questions as $key => $question) : ?>
    <span>Вопрос <?= $key+1; ?> </span>
    <?= htmlspecialchars($question['questions'], ENT_QUOTES,'utf-8'); ?>
        <ul class="list-unstyled">
            <?php foreach ($all_answers as $answer) : ?>
                <?php if ($key+1 == $answer['id_question'] ) : ?>
                        <li>
                        <input id="ans<?= htmlspecialchars($answer['id'],ENT_QUOTES,'utf-8');?>" class="form-check-input" type="radio" name="answer<?php echo  htmlspecialchars($answer['id_question'],ENT_QUOTES,'utf-8') . '_' . $_GET['test']?>" data-correct=<?= htmlspecialchars($answer['correct_answer'], ENT_QUOTES,'utf-8')?> required>
                        <label for="ans<?= $answer['id'];?>"><?= $answer['answer']; ?> </label>
                        <input  class="" type="text" name="answer_id<?= htmlspecialchars($answer['id'], ENT_QUOTES,'utf-8')?>" value="<?= htmlspecialchars($answer['correct_answer'], ENT_QUOTES,'utf-8')?>" hidden>
                        </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
        <div class="wrapper">
        <button type="submit" class="btn btn-warning finishTest">Отправить</button>
        </div>      
        <div class="alert alert-success result" role="alert" hidden>
        </div>
        <div class="alert alert-danger result-uncor" role="alert" hidden>       
        </div>
</form>
<?php require_once 'footer.php'; ?>

