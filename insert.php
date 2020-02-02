<?
/*Устанавливаем соединение с БД*/
include 'include/connectDB.php';

/*Устанавливаем соответствие переменным и принемаемым пост запросам*/
include 'include/post.php';

/*Добавляем запись в бд*/
$res = $mysqli->query("INSERT INTO tender (`date`, `name`, `code`, `year`) VALUES ('$date', '$name', '$code','$year')");

/*Проверка на наличие ошибок*/
if($res === false){
    dir ('Ошибка'.$mysqli->error);
}
else echo 'ok';

?>