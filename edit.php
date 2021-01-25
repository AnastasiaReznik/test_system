<?php
if (isset($_POST['nameTestEdit']) AND !empty($_POST['nameTestEdit'])) {
    // debug($_POST);
    $res_update = updateTest($_POST);
    if ($res_update) {
        header("Refresh:0");
        // header("Location:" . $_SERVER['PHP_SELF']);
        // echo $res_update;
    } else {
        alert('При редактировании произошла ошибка!');
    }
}
$allTest = queryAll('survey','id', $_GET['edit'] );
// debug($allTest);

$questions =  queryAll('questions', 'id_survey', $_GET['edit']);
// debug($questions);

$all_answers = queryAll('answer', 'id_survey', $_GET['edit']);
// debug($all_answers);
?>
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
