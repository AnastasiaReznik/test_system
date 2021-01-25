<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Тест</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
<?php 
require_once 'db_connect.php';
require_once 'funcs.php';
$allTest = queryAll($db,'survey','id', $_GET['test']);
// debug($allTest);

$questions =  queryAll($db,'questions', 'id_survey', $_GET['test']);
// debug($questions);

$all_answers = queryAll($db,'answer', 'id_survey', $_GET['test']);
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
                <?php if ($key+1 == $answer['id_question'] ) : ?>
                        <li>
                        <input id="ans<?=$answer['id'];?>" class="form-check-input" type="radio" name="answer<?php echo  $answer['id_question']?>" data-correct=<?=$answer['correct_answer']?> required>
                        <label for="ans<?=$answer['id'];?>"><?= $answer['answer']; ?> </label>
                        

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

<?php 
if (isset($_POST) AND !empty($_POST)) {
    // debug($_POST);
    $count_success = 0;
    $count_errors = 0;
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
    // запись результата теста в бд
    if ( $count_success >= 3) {
        $field= 'success';
    } else {
        $field= 'fail';
    }
    $res = addResultTest($db,$field, $_GET['test']);
    if ($res) { 
        // редирект нужен на страницу с результатами или подключить
        // header("Location: showResult.php");
        // echo $
    } else {
        alert('Произошла ошибка!');
    }
};
?>
        <!-- <span class="count-true" role="alert" >
        </span>
        <span class="count-false" role="alert">      
        </span> -->
 </div>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>   

<script>
// $('#test').submit(function (e) {
//     e.preventDefault();
//     // console.log(123);
//     const tmp = `<button type="button" class="btn btn-warning reset">Пройти заново</button>`;
//     $(".wrapper").html(tmp);
//     var count_success = $(".count-true");
//     var count_errors = $(".count-false").text();
//     var cor = 0;
//     var uncor = 0;
//     $('input[type="radio"]:checked').each(function (index, val) {

//         if ($(this).data('correct') == 0) {
//             $(this).next().css('color', 'red');
//         } else {
//             $(this).next().css('color', 'green');
//         }
//         var correct = $(this).data('correct');
//         if (!correct) {
//             uncor++;
//             // console.log('неправильный ответ');
//             // console.log($(this).parent('ul')); 
//         } else {
//             cor++;
//             // console.log('правильный ответ');
//         }
//     });

//     // console.log('true' + true);
//     console.log(count_errors);
//     $('.result').removeAttr('hidden').text('Правильных ответов: ' + count_success);
//     $('.result-uncor').removeAttr('hidden').text('Неправильных ответов: ' + count_errors);

//     $('.reset').on('click', function() {
//         location.reload();
//     });
// });
</script>