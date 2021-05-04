<?php

$errors = array();
$fields = array(
    'name' => $_POST['name'],
    'phone' => $_POST['phone']
);

$reg_name = '/^[а-я]{2,18}$/iu';
$reg_phone = '/^(\+7|7|8)?[\s\-]?\(?[39][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/';


foreach($fields as $field => $field_val){
    // checking all fields for emptiness
    if($field_val == '' || !isset($field_val)){
        $errors[$field] = 'Поле обязательно для заполнения.';
    } else {
        // checking the "name" field for matching a regular expression
        if(!preg_match($reg_name, $fields['name'])) {
            $errors['name'] = 'Имя должно быть от 2 до 18 символов русского алфавита.';
        }
        // checking the "phone" field for matching a regular expression
        if(!preg_match($reg_phone, $fields['phone'])) {
            $errors['phone'] = 'Введите телефон в федеральном формате.';
        }
    }
}

if($_POST['check'] == 'false') {
    $errors['check'] = 'Согласие обязательно.';
}

// делаем ответ для клиента
if(empty($errors)) {
    // если нет ошибок сообщаем об успехе
    echo json_encode(array('result' => 'success'));

    $msg = "Заявка на заказ звонка: "
        ."\nИмя: ". $fields['name']
        ."\nТелефон: ". $fields['tel']
        ."\nСогласие на обработку персональных данных: " . $_POST['check'];
    $userAgent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36";

    $chat_id = '';
    $token='';
    $url = "https://api.telegram.org/bot".$token."/sendMessage";
    $params = array(
        'chat_id' => $chat_id,
        'text' => $msg,
        'disable_web_page_preview' => null,
        'reply_to_message_id' => null,
        'reply_markup' => null
    );

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $params,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING       => "",
        CURLOPT_USERAGENT      => $userAgent,
        CURLOPT_AUTOREFERER    => true,
        CURLOPT_CONNECTTIMEOUT => 120,
        CURLOPT_TIMEOUT        => 120,
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_SSL_VERIFYPEER => false
    );
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    curl_exec($ch);
    curl_close($ch);
} else {
    // если есть ошибки то отправляем
    echo json_encode(array('result' => 'error', 'text_error' => $errors));
}

