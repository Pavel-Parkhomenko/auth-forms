<?php
session_start();
if (isset($_SESSION['isAuth'])) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/auth.css">
    <noscript>
        <link rel="stylesheet" href="../styles/nojs.css">
    </noscript>
    <title>Регистрация</title>
</head>

<body>
    <form action="#" method="post">
        <h1>Регистрация</h1>
        <div>
            <p>Имя</p>
            <input type="text" name="name" required placeholder="Введите ваше имя" />
        </div>
        <div>
            <p>Email</p>
            <input type="email" name="email" required placeholder="Введите ваш email" />
        </div>
        <div>
            <p>Логин</p>
            <input type="text" name="login" required placeholder="Введите ваш логин" />
        </div>
        <div>
            <p>Пароль</p>
            <input type="password" name="password" required placeholder="Введите ваш пароль" />
        </div>
        <div>
            <p>Повторите ваш пароль</p>
            <input type="password" name="conPassword" required placeholder="Это очень важно" />
        </div>
        <div class="container__bottom">
            <noscript>
                <button class="button__submit_nojs" disabled>Регистрация</button>
                <p class="message__nojs">Для работы сайта необходим JS</p>
                <a href="https://www.google.com/search?client=opera&q=как+включить+js&sourceid=opera&ie=UTF-8&oe=UTF-8">
                    Узнать как это сделать
                </a></br>
            </noscript>
            <button class="button__submit" type="submit" value="Регистрация">Регистрация</button>
            <span>
                У вас уже есть аккаунт?
                <buttom type="button" class="button__redirect">Войти</buttom>
            </span>
        </div>
    </form>
    <script type="module" src="../js/registr.js"></script>
</body>

</html>