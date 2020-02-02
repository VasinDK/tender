<?
/*Устанавливаем соединение с БД*/
include 'include/connectDB.php';

/*Устанавливаем соответствие переменным и принемаемым пост запросам*/
include 'include/post.php';

/*Удаляем запись из бд*/
$res=$mysqli->query("DELETE FROM `tender` WHERE id=$id");

/*Проверка на наличие ошибок*/
if($res === false){
    dir ('Ошибка'.$mysqli->error);
}
else echo $id;

?>