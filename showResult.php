<?php 
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET)) {
    $res_check_get = checkIssetGet($arr_get, $db, 'result_id', 'survey');
    if ($res_check_get === false) {
        header("HTTP/1.0 404 Not Found");
        die();
    }
  } else {
      header("Location: index.php");
  }
// запрос к бд - отразить по id из гет кол-во правильных и не правильных ответов
$id_test = $_GET['result_id']; //id теста которого надо тобразить  рез-ты
$test = queryAll($db, 'survey', 'id', $_GET['result_id']);
$page = 'Результат';

?>
<?php require_once 'header.php'; ?>

<h1>Результат теста: <?= $test[0]['name']?> </h1>
<div class="alert alert-success result" role="alert">Правильных ответов: <?= $test[0]['count_correct_answer']; ?> </div>
<div class="alert alert-danger result-uncor" role="alert">Неправильных ответов: <?= $test[0]['count_errors_answer']; ?> </div>
<div class="alert alert-light" role="alert">Ваш результат:
<?php if ( $test[0]['count_correct_answer'] >= $test[0]['count_errors_answer']) : ?>
Тест успешно пройден!
<?php else : ?>
Тест не пройден!
<?php endif; ?>
</div>
<a class="btn btn-primary" href="/" >На главную</a>
<?php require_once 'footer.php'; ?>
