<?php 
//ob_start();
//
session_start();
include(dirname(dirname(__file__)).'/configs.php');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
error_log(DB_HOST);
error_log(DB_USER);
error_log(DB_PASS);
error_log('Configuracion de la base de datos');
error_log($con);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
//INSERT INTO `khan_exercises`.`khan_variable` (`variable_question`, `variable_name`, `variable_type`) VALUES ('1', 'asdf', 'float');
$new_order = $_POST['hint_order']+1;
mysql_select_db("khan_exercises", $con);
if (isset($_POST['hint_id'])) {
    $qstring='UPDATE `khan_exercises`.`khan_hint` 
        SET 
        `hint_question`=\''. $_GET['question_id'] .'\', 
        `hint_text`=\''. $_POST['new_hint_text'] .'\', 
        `hint_order`=\''. $_POST['hint_order'] .'\' 
        WHERE 
        `hint_id`=\''.$_POST['hint_id'].'\'';
} else {
    $qstring = 'INSERT INTO `khan_exercises`.`khan_hint` (`hint_question`, `hint_text`, `hint_order`) VALUES ('. $_GET['question_id'] .', \''. $_POST['new_hint_text'] .'\', '. $new_order .');';
}

error_log($qstring);

$result=mysql_query($qstring);
error_log($result);
mysql_close($con);


//$_SERVER['HTTP_REFERER']
//ob_end_flush();
header('Location: '.$_SERVER['HTTP_REFERER']);
//header('Location: '.URL.'?question_id='.$_GET['question_id']);
?>
