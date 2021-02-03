<?php 
require_once 'db_connect.php';
require_once 'funcs.php';
require_once 'config.php';
if (!empty($_GET)) {
  $res_check_get = checkIssetGet($arr_get, $db, 'result', 'survey');
  if ($res_check_get === false) {
      header("HTTP/1.0 404 Not Found");
      die();
  }
} else {
  header("Location: index.php");
}
$page = 'Результаты теста';
?>
<?php require_once 'header.php'; ?>
<h1>Результаты</h1>
<?php 
$urlGet = $_SERVER['QUERY_STRING'];
parse_str($urlGet, $get);
$resQuery = queryAll($db,'survey', 'id', $get['result']);
?>
<p>Пройдено успешно:<?= htmlspecialchars($resQuery[0]['success'], ENT_QUOTES,'utf-8') ?></p>
<p>Пройдено не успешно:<?= htmlspecialchars($resQuery[0]['fail'], ENT_QUOTES,'utf-8') ?></p>
<a class="btn btn-primary" href="/" >На главную</a>
<?php require_once 'footer.php'; ?>
