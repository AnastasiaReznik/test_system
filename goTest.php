<!-- <h1>TEST</h1> -->
<?php 
$stmt = $db->prepare("SELECT * FROM survey WHERE id = ?");
$stmt->execute([$_GET['test']]);
$allTest = $stmt->fetchAll(\PDO::FETCH_ASSOC);
// debug($allTest);

$stmt = $db->prepare("SELECT * FROM questions WHERE id_survey = ?");
$stmt->execute([$_GET['test']]);
$questions = $stmt->fetchAll(\PDO::FETCH_ASSOC);
// debug($questions);

// $stmt = $db->prepare("SELECT id FROM questions WHERE id_survey = ?");
// $stmt->execute([$_GET['test']]);
// $id_questions = $stmt->fetchAll(\PDO::FETCH_ASSOC);
// var_dump($id_questions);

$stmt = $db->prepare("SELECT * FROM answer WHERE id_survey = ?");
$stmt->execute([$_GET['test']]);
$all_answers = $stmt->fetchAll(\PDO::FETCH_ASSOC);
// debug($all_answers);





 //проверка наличия гет параметров в url 
    // $urlGet = $_SERVER['QUERY_STRING'];
    // parse_str($urlGet, $get);
    // print_r($get);


// foreach ($all_answers as $key => $val) {
    // if ($val['id_question'] == )
    // $k = $val['id_question'];
    // $answerQ = $val['answer'];
    // $arrAnswer[$k] = ['answer' => [$answerQ]];
// }

// var_dump($arrAnswer);
// [номер вопроса1] = [[0] => ответ1,
//                    [1] => ответ2,
//                    [2] => ответ3
//                   ],
// [номер вопроса2] = [[0] => ответ1,
//                    [1] => ответ2,
//                    [2] => ответ3
//                   ],


?>

<h1 class='nameTest' data-id="<?=  $allTest[0]['id'] ?>"><?= $allTest[0]['name'];  ?></h1>
<form method='POST' id="test">
        <?php foreach ($questions as $key => $question) : ?>
    <span>Вопрос <?= $key+1; ?> </span>
    <?= $question['questions']; ?>
        <ul class="list-unstyled">
            <?php foreach ($all_answers as $answer) : ?>
                <?php if ( $question['id'] == $answer['id_question'] ) : ?>
                        <li>
                        <input class="form-check-input" type="radio" name="answer<?= $answer['id_question']; ?> " data-correct=<?=$answer['correct_answer']?> required>
                        <label for=""><?= $answer['answer']; ?> </label>
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
    
<script>
$('#test').submit(function (e) {
    e.preventDefault();
    const tmp = `<button type="button" class="btn btn-warning reset">Пройти заново</button>`;
    $(".wrapper").html(tmp);
    var cor = 0;
    var uncor = 0;
    $('input[type="radio"]:checked').each(function (index, val) {

        if ($(this).data('correct') == 0) {
            $(this).next().css('color', 'red');
        } else {
            $(this).next().css('color', 'green');
        }
        var correct = $(this).data('correct');
        if (!correct) {
            uncor++;
            // console.log('неправильный ответ');
            // console.log($(this).parent('ul')); 
        } else {
            cor++;
            // console.log('правильный ответ');
        }
    });


    console.log('true' + cor);
    $('.result').removeAttr('hidden').text('Правильных ответов: ' + cor);
    $('.result-uncor').removeAttr('hidden').text('Неправильных ответов: ' + uncor);

    $('.reset').on('click', function() {
        location.reload();
    });

    const idTest = $('h1.nameTest').data('id');
$.ajax({
            method: "POST",

            url: "ajax.php",

            data: {
                successAnswer: cor,
                errorAnswer: uncor,
                idTest: idTest,
            }

        }).done(function(resp) {
            if (resp == false) {
                alert('Ошибка.Повторите позже!');
            } else {
                // var res = JSON.parse(resp);
                console.log(resp);
            }
        })
})

</script>