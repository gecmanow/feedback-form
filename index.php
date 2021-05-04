<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Форма</title>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </head>
    <body>
        <div class="container">
            <form id="feedback" class="offer_form contact-form" method="post" action="">
                <div class="form-row">
                    <div class="col offer_form-input">
                        <input id="name" class="form-control" type="text" name="name" placeholder="Имя">
                        <label id="name_error" class="error"></label>
                    </div>
                    <div class="col offer_form-input">
                        <input id="phone" class="form-control" type="tel" name="phone" placeholder="Телефон">
                        <label id="phone_error" class="error"></label>
                    </div>
                    <div class="col offer_form-btn">
                        <button class="btn btn-primary send-form" type="submit">Заказать машину</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input id="check" type="checkbox" value="Yes" name="check" class="custom-control-input">
                            <label class="custom-control-label" for="check">Я согласен с политикой обработки персональных данных</label>
                        </div>
                        <label id="check_error" class="error"></label>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
