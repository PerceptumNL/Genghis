<?php
ob_start();
session_start();

include('../../configs.php');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);

if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("elearning", $con);
$check = 0;
if ($_POST['check']=="true") $check = 1;
else $check = 0;


$qstring="UPDATE khan_question SET question_title = '".$_POST["title"]."' ,";
$qstring .= " question_statement = '" . $_POST["statement"] . "' ,";
$qstring .= " question_solution = '" . $_POST["solution"] . "' ";
$qstring .= " WHERE question_id =".$_SESSION['question_id']."";
echo $qstring;
mysql_query($qstring);


$return_loc = "?page=FillInTheBlank.php";
header('Location: '.URL);

mysql_close($con);
ob_end_flush(); ?>