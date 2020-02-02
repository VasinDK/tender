<?
/*Устанавливаем соединение с БД*/
include 'include/connectDB.php';

/*Устанавливаем соответствие переменным и принемаемым пост запросам*/
include 'include/post.php';

/*Изменяем запись в бд*/
$res = $mysqli->query("UPDATE tender SET date='$date', name='$name', code='$code', year='$year' WHERE id='$id'");

/*Проверка на наличие ошибок*/
if($res === false){
    dir ('Ошибка'.$mysqli->error);
}
else echo 'ok';

?>