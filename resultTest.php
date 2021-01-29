<?php 
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET)) {
    $res_check_get = checkIssetGet($arr_get, $db);
    if ($res_check_get == 'true') {
        header("Location: resultTest.php?result=1");
        die();
    }
  } 
  else {
    header("Location: resultTest.php?result=1");
  }
?>
<?php require_once 'header.php'; ?>

<h1>Результаты</h1>
<?php 
$urlGet = $_SERVER['QUERY_STRING'];
parse_str($urlGet, $get);
// debug($get['result']);
$resQuery = queryAll($db,'survey', 'id', $get['result']);
// debug($resQuery);
?>
<p>Пройдено успешно:<?= $resQuery[0]['success'] ?></p>
<p>Пройдено не успешно:<?= $resQuery[0]['fail'] ?></p>
<a class="btn btn-primary" href="/" >На главную</a>
<?php require_once 'footer.php'; ?>
