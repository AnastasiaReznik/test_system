<h1>Результаты</h1>
<?php 
$urlGet = $_SERVER['QUERY_STRING'];
parse_str($urlGet, $get);
// debug($get['result']);
$resQuery = queryAll('survey', 'id', $get['result']);
// debug($resQuery);
?>
<p>Пройдено успешно:<?= $resQuery[0]['success'] ?></p>
<p>Пройдено не успешно:<?= $resQuery[0]['fail'] ?></p>
<a class="btn btn-primary" href="/" >На главную</a>
