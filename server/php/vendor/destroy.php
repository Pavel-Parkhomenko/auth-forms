<?php

session_start();

if (isset($_SESSION['isAuth'])) {
    session_destroy();
    setcookie('login', '', 1);
    setcookie('key', '', 1);
    echo json_encode(["status" => "ok", "message" => "Сессия успешно удалена"]);
}