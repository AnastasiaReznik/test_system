<?php
require 'db_connect.php';
// require_once 'config.php';
function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}
function checkIssetGet(&$arr_get, &$db, $nameGetParam, $name_table)
{
    $urlGet = $_SERVER['QUERY_STRING'];
    parse_str($urlGet, $get_url);
    $get_param = htmlspecialchars(array_keys($get_url)[0], ENT_QUOTES); //get кот ввел пользователь 
    $get_param = str_replace(['.','/'], '', $get_param);
    if (array_search($get_param, $arr_get)) {
        if ($get_param == $nameGetParam) {
           if (is_numeric(array_values($get_url)[0])) {
                // если гет такой есть и его значение целое число, то проверка такого значения в бд
                $check_test = queryAll($db, $name_table, 'id', array_values($get_url)[0]);
                     if (empty($check_test)) {
                      header("HTTP/1.0 404 Not Found");
                      die();
                     }
           } else {
               return false;
           }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function checkDataForm($array)
{
    foreach ($array as $k => $val) {
        $array[$k] = trim($val);
        if (empty($array[$k])) {
            return false;
            break;
        } else {
            return true;
        }
    }
}


function queryAll(&$db,$table_name, $param = null, $param_value = null)
//"SELECT * FROM {$table_name} WHERE {$param_name} = ?"
{
    // global $db;
    if ($param != null and $param_value != null) {
    $stmt = $db->prepare("SELECT * FROM {$table_name} WHERE {$param} = ?");
    } else {
        $stmt = $db->prepare("SELECT * FROM {$table_name}");
    }
    $stmt->execute([$param_value]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // debug($stmt);
}

function addResultTest(&$db,$field, $id_test)
{
    $stmt = $db->prepare("UPDATE survey SET {$field} = {$field}+1 WHERE `id` = ?"); 
    return $stmt->execute([$id_test]);
    // return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
function addTest(&$db,$newTest)
{
    // debug($newTest);
    $nameTest = $newTest['nameTest'];
    $stmt = $db->prepare("INSERT INTO survey (`name`) VALUES (?)"); 
    $res = $stmt->execute([$nameTest]);
    $id_test = $db->lastInsertId(); //id новго теста
   if ($res === true) {
        //  вставка вопросов и ответов в бд
            foreach ($newTest as $key => $value) {
                // вставка впоросов в бд
                if ($key == 'questions') {
                    foreach ($value as $question_num => $question) {
                        $stmt = $db->prepare("INSERT INTO questions (`questions`, `id_survey`) VALUES (?, ?)"); 
                        $res_insert_question = $stmt->execute([$question, $id_test]);
                        if ($res_insert_question === false) { //если не добавлен вопрос
                            echo 'При добавлении вопроса произошла ошибка!';
                            break;
                        }                
                    }
                }
                // поиск правильного ответа  и вставка ответов в бд
                if ($key == 'answers')
                {
                    foreach ($value as $answer_num => $answer) {
                        $current = current($value);
                        $next = next($value);
                        if (stristr($answer_num, 'answer') !== false) {
                                // $substr_id = substr($key, -1); //id вопроса
                                $substr_id = substr($answer_num, -1); //id tecnf
                                $stmt = $db->prepare("INSERT INTO answer (`answer`, `correct_answer`, `id_question`, `id_survey`) VALUES (?, ?, ?,?)");
                                if ($next == 'on') {
                                        $res_insert_answer = $stmt->execute([$answer, '1', $substr_id, $id_test]);
                                }  else {
                                    $res_insert_answer = $stmt->execute([$answer, '0', $substr_id, $id_test]);
                                    if ($res_insert_answer === true ) {
                                        $res_insert = true;
                                    } else {
                                        return false;
                                    }
                        }
                    }
                }
                    if ($res_insert) {
                        return true;
                        // return false;
                     } else {
                         return false;
                    } 
            }
        } 
}
}
function updateTest(&$db,$dataTest)
{
    $nameTest = $dataTest['nameTestEdit']; //имя теста
    $stmt = $db->prepare("UPDATE survey SET `name` = ? WHERE `id` = ?"); 
    $res = $stmt->execute([$nameTest, $_GET['edit']]);
    // $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if ($res) {
        //обновить вопросы
        foreach ($dataTest as $key => $value) {
            if(stristr($key, 'nameQuestionEdit') !== false) {
            //    debug(stristr($key, 'nameQuestionEdit'));
                $id_question = substr($key,16);
                $stmt = $db->prepare("UPDATE questions SET `questions` = ? WHERE `id` = ?"); 
                // $stmt = $db->prepare("UPDATE questions SET `questions` = ? WHERE `id` = ?"); 
                $res_update_question = $stmt->execute([$value, $id_question]);
                if (!$res_update_question) {
                    return false;
                };
            }              
            $current = current($dataTest);
            $next = next($dataTest);
            if (stristr($key, 'answer') !== false) {
                $id_answer = substr($key,6);
                $stmt = $db->prepare("UPDATE answer SET `answer` = ?, `correct_answer` = ? WHERE `id` = ?"); 
                if ($next == 'on') { 
                    $res_update_answer = $stmt->execute([$value, '1',$id_answer]);
                    
                }  else {
                    $res_update_answer = $stmt->execute([$value, '0',$id_answer]);
            }
            if (!$res_update_answer) {
                return false;
            } else {
                $res_update = 'true';
            }
            }
        }
    } else {
        return false;
        }
        return $res_update;
} 
?>