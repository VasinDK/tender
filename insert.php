<?
include 'include/connectDB.php';
$name = $_POST['name'];
$date = $_POST['date'];
$code = $_POST['code'];
$year = $_POST['year'];

$res = $mysqli->query("INSERT INTO tender (`date`, `name`, `code`, `year`) VALUES ('$date', '$name', '$code','$year')");

if($res === false){
    dir ('Ошибка'.$mysqli->error);
}
else echo 'ok';

?>