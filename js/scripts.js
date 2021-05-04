$(document).ready(function() {
    $('#feedback').submit(function(){
        // убираем класс ошибок с инпутов
        $('input').each(function(){
            $(this).removeClass('error_input');
        });
        // прячем текст ошибок
        $('.error').hide();

        // получение данных из полей
        var name = $('#name').val();
        var phone = $('#phone').val();
        var check = $('#check').prop('checked');

        $.ajax({
            // метод отправки
            type: "POST",
            // путь до скрипта-обработчика
            url: "/send.php",
            // какие данные будут переданы
            data: {
                'name': name,
                'phone': phone,
                'check': check
            },
            // тип передачи данных
            dataType: "json",
            // действие, при ответе с сервера
            success: function(data){
                // в случае, когда пришло success. Отработало без ошибок
                if(data.result == 'success'){
                    $('#name').val('');
                    $('#phone').val('');
                    // в случае ошибок в форме
                }else{
                    // перебираем массив с ошибками
                    for(var errorField in data.text_error){
                        // выводим текст ошибок
                        $('#'+errorField+'_error').html(data.text_error[errorField]);
                        // показываем текст ошибок
                        $('#'+errorField+'_error').show();
                        // обводим инпуты красным цветом
                        $('#'+errorField).addClass('error_input');
                    }
                }
            }
        });
        // останавливаем сабмит, чтоб не перезагружалась страница
        return false;
    });
});