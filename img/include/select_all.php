<?
$res = $mysqli->query("SELECT * FROM `tender`");

while($row = $res->fetch_assoc()){
    $tender['id'][] = $row['id'];
    $tender['date'][] = $row['date'];
    $tender['name'][] = $row['name'];
    $tender['code'][] = $row['code'];
    $tender['year'][] = $row['year'];
}
?>