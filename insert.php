<?
include 'include/connectDB.php';
$name = $_POST['name'];
$date = $_POST['date'];
$code = $_POST['code'];
$year = $_POST['year'];
$mysqli->query("INSERT INTO tender (`date`, `name`, `code`, `year`) VALUES ('$date', '$name', '$code','$year')");

echo 'ok';


?>