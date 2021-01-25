<?php 
$allTest = queryAll('survey','id', $_GET['test'] );
// debug($allTest);

$questions =  queryAll('questions', 'id_survey', $_GET['test']);
// debug($questions);

$all_answers = queryAll('answer', 'id_survey', $_GET['test']);
// debug($all_answers);

 //проверка наличия гет параметров в url 
    // $urlGet = $_SERVER['QUERY_STRING'];
    // parse_str($urlGet, $get);
    // print_r($get);

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
<div class="container">
<a class="btn btn-primary" href="/" >На главную</a>
<h1 class='nameTest text-center' data-id="<?=  $allTest[0]['id'] ?>"><?= $allTest[0]['name'];  ?></h1>
<form method='POST' style="width:500px" id="test" class="mx-auto">
        <?php foreach ($questions as $key => $question) : ?>
    <span>Вопрос <?= $key+1; ?> </span>
    <?= $question['questions']; ?>
        <ul class="list-unstyled">
            <?php foreach ($all_answers as $answer) : ?>
                <?php if ( $key+1 == $answer['id_question'] ) : ?>
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
 </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>   
<script>
$('#test').submit(function (e) {
    e.preventDefault();
    console.log(123);
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