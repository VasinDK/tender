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

    function funBeforUp(){
        $('#info').text('подождите...');
    }

    function funSuccessUp(informat){
        if(informat=='ok'){
            window.location = "index.php";
        } else alert('Что то пошло не так: '+informat);

    }

    function funBeforDeleteId(tdDel){
        $('#'+tdDel).text('подождите...');
    }

    function funSuccessDeleteId(informat){
        //$('#info').text(informat)

        if(informat != false){
           $('#idTr'+informat).remove();

        }

    }

    function delRow(idRow){
        var id=idRow;
        var tdDel='tdDel'+idRow;
        $.ajax({
            url:'delete.php',
            type: 'POST',
            data: ({id:id}),
            dataType:'html',
            beforeSend:funBeforDeleteId(tdDel),
            success:funSuccessDeleteId
        });

    };

     function setRow(eqi, idAfter){

         var eqiId=eqi+0;
         var eqiDate=eqi+1;
         var eqiName=eqi+2;
         var eqiDCode=eqi+3;
         var eqiDYear=eqi+4;
         var eqiIdValue=$('td').eq(eqiId).text();
         var eqiDateValue=$('td').eq(eqiDate).text();
         var eqiNameValue=$('td').eq(eqiName).text();
         var eqiDCodeValue=$('td').eq(eqiDCode).text();
         var eqiDYearValue=$('td').eq(eqiDYear).text();

         //var eq12 = $('td').eq(14).text();
         //alert(eqiDYearValue);

         $('#idTr'+idAfter).after('<tr><td>'+idAfter+'</td><td><input id="setDate" value="'+eqiDateValue+'"></td><td><input id="setName" value="'+eqiNameValue+'"></td><td><input id="setCode" value="'+eqiDCodeValue+'" ></td><td><input id="setYers" value="'+eqiDYearValue+'"></td><td><button  onclick="setRowOk('+idAfter+')">Ок</button></td><td><button  onclick="setRowOFF()">Отмена</button></td></tr>');
         $('#idTr'+idAfter).remove();
     };

    function setRowOk(id){
                var setEqiId = id;
               var setDate = $('#setDate').val();
               var setName = $('#setName').val();
               var setCode = $('#setCode').val();
               var setYers = $('#setYers').val();

            $.ajax({
            url:'update.php',
            type: 'POST',
            data: ({id:setEqiId, name:setName, date:setDate, code:setCode, year:setYers}),
            dataType:'html',
            beforeSend:funBeforUp(),
            success:funSuccessUp
        });


    }

    function setRowOFF(){
        window.location = "index.php";
    }

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

<h1 contenteditable="true">Таблица тендеров</h1>

<table>
    <thead>
    <tr><td>id</td><td>date</td><td>name</td><td>code</td><td>year</td><td>Удалить</td><td>Изменить</td></tr>
    </thead>
    <tbody>
<? for($i = 0; $i < count($tender['id']); $i++){ ?>
    <tr id="<? echo 'idTr'.$tender['id'][$i]; ?>">
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
        <td id="<? echo 'tdDel'.$tender['id'][$i]; ?>">
            <a href='#' onclick="delRow(<? echo $tender['id'][$i]; ?>)"><img src="img/bin.svg" width="10" alt=""</a>
        </td>
        <td id="<? echo 'tdSet'.$tender['id'][$i]; ?>">
            <a href='#' onclick="setRow(<? $eqi = $eqi+7; echo $eqi; ?>,<? echo $tender['id'][$i]; ?>)"><img src="img/pencil.svg" width="10" alt=""</a>
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

