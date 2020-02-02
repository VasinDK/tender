<?
include 'include/connectDB.php';
$id = $_POST['id'];

$res=$mysqli->query("DELETE FROM `tender` WHERE id=$id");

if($res === false){
    dir ('Ошибка'.$mysqli->error);
}
else echo $id;

?>