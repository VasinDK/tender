<?
include 'include/connectDB.php';
$id = $_POST['id'];
$name = $_POST['name'];
$date = $_POST['date'];
$code = $_POST['code'];
$year = $_POST['year'];


$res = $mysqli->query("UPDATE tender SET date='$date', name='$name', code='$code', year='$year' WHERE id='$id'");

if($res === false){
    dir ('Ошибка'.$mysqli->error);
}
else echo 'ok';

?>