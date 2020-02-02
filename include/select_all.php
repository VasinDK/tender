<?

/*Выводим все на экран*/
$res = $mysqli->query("SELECT * FROM `tender`");

while($row = $res->fetch_assoc()){
    $tender['id'][] = $row['id'];       /*id записи*/
    $tender['date'][] = $row['date'];   /*Дата*/
    $tender['name'][] = $row['name'];   /*Имя или название*/
    $tender['code'][] = $row['code'];   /*Код*/
    $tender['year'][] = $row['year'];   /*Год*/
}
?>