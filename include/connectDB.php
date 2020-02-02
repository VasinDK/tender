<?
$server = 'localhost'; //адрес сервера
$bd = 'boss11_tender'; //база данных
$userDB = 'boss11_tender'; //пользователь бд
$passDB = 'boss11_tender'; //парол Бд
$tableDB = 'tender'; // таблицца в которой работаем

/*Подключение к бд, установка кодировки*/
$mysqli = new mysqli($server, $userDB, $bd, $passDB);
$mysqli -> set_charset('utf8');

if ($mysqli->connect_error){
    die('Ошибка соединения: ' . $mysqli -> connect_error);
}

?>