
$( document ).ready(function() {
    $("#numb3").click(
        alert(1),
        function(){
            sendAjaxForm('ajax_form');
            return false;
        }
    );
});

function sendAjaxForm(ajax_form) {
    $.ajax({
        url: "main/test1",
        type:     "POST", //метод отправки
        contentType:  "text/plain",
        dataType: "text", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        // data: "name=John&location=Boston",
        success: function(response) { //Данные отправлены успешно
            alert( "Data Saved: " + response );
            // result = $.parseJSON(response);
            // $('#result_form').html('Имя: '+result.where1);
        },
        error: function(response) { // Данные не отправлены

        }
    });
}