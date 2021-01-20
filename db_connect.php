<?php

$host = 'localhost';
$db_name = 'survey_system';
$root = 'root';
$password = '';
try {
    // $db = new \PDO("mysql:host={$data_connect['host']};dbname={$data_connect['db_name']}", $data_connect['root'], $data_connect['password']);
    $db = new PDO("mysql:host=$host;dbname=$db_name", $root, $password);
    
} catch(\PDOException $e) {
   die('DB connect ERROR!!!!');
//    debug($e);
}

// var_dump($db);   
