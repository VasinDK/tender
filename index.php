<?
/*подключаем бд*/
include 'include/connectDB.php';
include 'include/select_all.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style type="text/css">
        TABLE {
            border-collapse: collapse; /* Убираем двойные границы между ячейками */
            background: #dc0; /* Цвет фона таблицы */
            border: 4px solid #000; /* Рамка вокруг таблицы */
        }
        TD, TH {
            padding: 5px; /* Поля вокруг текста */
            border: 2px solid green; /* Рамка вокруг ячеек */
        }
    </style>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Таблица тендеров</title>

</head>
<body>

<script>
    function funBefor(){
      $('#info').text('подождите...');
    }

    function funSuccess(informat){
        $('#info').text(informat)
        window.location = "index.php";
    }

    function funBeforDeleteId(){
        $('#'+id).text('подождите...');
    }

    function funSuccessDeleteId(informat){
        $('#'+id).text(informat)
        window.location = "index.php";

    }

    function deleteId(id){
        var id=id;
        $.ajax({
            url:'delete.php',
            type: 'POST',
            data: ({id:id}),
            dataType:'html',
            beforeSend:funBeforDeleteId,
            success:funSuccessDeleteId
        });

    };

    $(document).ready(function(){
        $('#buttonInc').on('click', function () {
            $('#form').css("display", "block");
            $('#buttonInc').css("display", "none");
            $('#buttonOff').css("display", "block");
            $('#button').css("display", "block");
        });

        $('#buttonOff').on('click', function () {
            $('#form').css("display", "none");
            $('#buttonInc').css("display", "block");
            $('#buttonOff').css("display", "none");
            $('#button').css("display", "none");
        });

        $('#button').on('click', function (){
            var name=$('#name').val();
            var date=$('#date').val();
            var code=$('#code').val();
            var year=$('#year').val();

            $.ajax({
                url:'insert.php',
                type: 'POST',
                data: ({name:name, date:date, code:code, year:year}),
                dataType:'html',
                beforeSend:funBefor,
                success:funSuccess

            });


        });
    });
</script>

<h1>Таблица тендеров</h1>

<table>
    <thead>
    <tr><td>id</td><td>date</td><td>name</td><td>code</td><td>year</td><td>Удалить</td></tr>
    </thead>
    <tbody>
<? for($i = 0; $i < count($tender['id']); $i++){ ?>
    <tr>
        <td>
            <? echo $tender['id'][$i]; ?>
        </td>
        <td>
            <? echo $tender['date'][$i]; ?>
        </td>
        <td>
            <? echo $tender['name'][$i]; ?>
        </td>
        <td>
            <? echo $tender['code'][$i]; ?>
        </td>
        <td>
            <? echo $tender['year'][$i]; ?>
        </td>
        <td id="<? echo $tender['id'][$i]; ?>">
            <img src="img/bin.svg">
        </td>

    </tr>

<? } ?>

    </tbody>
</table>

<br>
<div id="info"></div><br>
<button id="buttonInc">Добавить</button>
<form style="display: none" id='form' method="post" action="#">
    <input type="text" id="name" placeholder="Название"><br>
    <input type="text" id="date" placeholder="Дата"><br>
    <input type="text" id="code" placeholder="Код"><br>
    <input type="text" id="year" placeholder="Год"><br><br>


</form>
<button style="display: none" id="button">Готово</button>

<button style="display: none" id="buttonOff">Отмена</button>




</body>
</html>

