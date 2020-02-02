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

<?
/*подключаем бд*/
include 'include/connectDB.php';

/*Выводим все записи*/
include 'include/select_all.php';
?>

<script>
    /*Ожидание добавления записи*/
    function funBefor(){
      $('#info').text('подождите...');
    }

    /*Успешное добавления записи*/
    function funSuccess(informat){
        $('#info').text(informat)
        window.location = "index.php";
    }

    /*Ожидание обновления записи*/
    function funBeforUp(){
        $('#info').text('подождите...');
    }

    /*Успешное обновления записи*/
    function funSuccessUp(informat){
        if(informat=='ok'){
            window.location = "index.php";
        } else alert('Что то пошло не так: '+informat);

    }

    /*Ожидание удаления записи*/
    function funBeforDeleteId(tdDel){
        $('#'+tdDel).text('подождите...');
    }

    /*Успешное удаление записи из бд*/
    function funSuccessDeleteId(informat){
        if(informat != false){
           $('#idTr'+informat).remove();
        }
    }

    /*Удаление записи*/
    function delRow(idRow){  /*idRow - id записи она же id строки*/
        var id=idRow;
        var tdDel='tdDel'+idRow;  /*tdDel - id ячейки где появляется "Подождите"*/
        $.ajax({
            url:'delete.php',
            type: 'POST',
            data: ({id:id}),
            dataType:'html',
            beforeSend:funBeforDeleteId(tdDel),
            success:funSuccessDeleteId
        });

    };

    /*Изменение записи. Подготовка*/
     function setRow(eqi, idAfter){  /*idAfter - id изменяемой записи, она же строка записи */
        /*eqi - порядковый номер ячейки td вычесляемый при вызове функции*/
         var eqiId=eqi+0;    /*eqiId - порядковый номер ячейки ID */
         var eqiDate=eqi+1;     /*eqiDate - порядковый номер ячейки Date*/
         var eqiName=eqi+2;     /*eqiName - порядковый номер ячейки Name */
         var eqiDCode=eqi+3;     /*eqiDCode - порядковый номер ячейки Code */
         var eqiDYear=eqi+4;        /*eqiDYear - порядковый номер ячейки Year */
         var eqiIdValue=$('td').eq(eqiId).text();   /*eqiId - значение ID получаемое из eqi*/
         var eqiDateValue=$('td').eq(eqiDate).text();   /*eqiDate - значение Date получаемое из eqi*/
         var eqiNameValue=$('td').eq(eqiName).text();   /*eqiName - значение Name получаемое из eqi*/
         var eqiDCodeValue=$('td').eq(eqiDCode).text(); /*eqiDCode - значение Code получаемое из eqi*/
         var eqiDYearValue=$('td').eq(eqiDYear).text(); /*eqiDYear - значение Year получаемое из eqi*/

         /*Сначало после idAfter создаем новую строку с полями для изменения, а затем удаляем idAfter - саму запись в html */
         $('#idTr'+idAfter).after('<tr><td>'+idAfter+'</td><td><input id="setDate" value="'+eqiDateValue+'"></td><td><input id="setName" value="'+eqiNameValue+'"></td><td><input id="setCode" value="'+eqiDCodeValue+'" ></td><td><input id="setYers" value="'+eqiDYearValue+'"></td><td><button  onclick="setRowOk('+idAfter+')">Ок</button></td><td><button  onclick="setRowOFF()">Отмена</button></td></tr>');
         $('#idTr'+idAfter).remove();
     };

    /*Изменение записи. Подтверждение*/
    function setRowOk(id){      /*id записи*/
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

    /*Изменение записи. Отмена. Срабатывает по кнопке "отмена"*/
    function setRowOFF(){
        window.location = "index.php";
    }


    $(document).ready(function(){

        /*Кнопка "добавить", отображает форму добавления записи*/
        $('#buttonInc').on('click', function () {   /*По нажатию на кнопку Добавть*/
            $('#form').css("display", "block");     /*Появляется форма*/
            $('#buttonInc').css("display", "none");     /*Исчезает кнопка Добавить*/
            $('#buttonOff').css("display", "block");    /*Появляется кнопка Отмена*/
            $('#button').css("display", "block");       /*Появляется кнопка Готово*/
        });

        /*Кнопка отмены формы добавления*/
        $('#buttonOff').on('click', function () {       /*По нажатию на кнопку Отменя*/
            $('#form').css("display", "none");          /*Проподает форма*/
            $('#buttonInc').css("display", "block");    /*Появляется кнопка Добавить*/
            $('#buttonOff').css("display", "none");     /*Проподает кнопка Отмена*/
            $('#button').css("display", "none");        /*Проподает кнопка Готово*/
        });

        /*Кнопка добавления записи*/
        $('#button').on('click', function (){   /*Срабатывание кнопки Готово*/
            var name=$('#name').val();          /*Перименные пренимают значения и передаются в БД*/
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
    <!--Заголовок таблицы-->
    <tr><td>id</td><td>date</td><td>name</td><td>code</td><td>year</td><td>Удалить</td><td>Изменить</td></tr>
    </thead>
    <tbody>

    <!--Выводим таблицу при помощи цикла-->
<? for($i = 0; $i < count($tender['id']); $i++){ ?>         <!--массив $tender соберается в файле select_all-->
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
            <!--Вызов функции удаления записи-->
            <a href='#' onclick="delRow(<? echo $tender['id'][$i]; ?>)"><img src="img/bin.svg" width="10" alt=""</a>
        </td>
        <td id="<? echo 'tdSet'.$tender['id'][$i]; ?>">
            <!--Вызов функции изменеия записи-->
            <a href='#' onclick="setRow(<? $eqi = $eqi+7; echo $eqi; ?>,<? echo $tender['id'][$i]; ?>)"><img src="img/pencil.svg" width="10" alt=""</a>
        </td>

    </tr>

<? } ?>

    </tbody>
</table>
<br>
<!--Див для вывода некоторой информации-->
<div id="info"></div><br>

<!--Кнопка за которой прячется форма добавления-->
<button id="buttonInc">Добавить</button>

<!--Форма добавления-->
<form style="display: none" id='form' method="post" action="#">
    <input type="text" id="name" placeholder="Название"><br>
    <input type="text" id="date" placeholder="Дата"><br>
    <input type="text" id="code" placeholder="Код"><br>
    <input type="text" id="year" placeholder="Год"><br><br>

</form>

<!--Кнопки добавления и отмены-->
<button style="display: none" id="button">Готово</button>
<button style="display: none" id="buttonOff">Отмена</button>


</body>
</html>

