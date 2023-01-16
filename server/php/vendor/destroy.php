<?php
/*
Данный скрипт выполнится при нажатие на кнопку Выйти (index.php).
Будет выполнен fetch запрос
*/
session_start();
// Удаляем cokkie
setcookie("login", "UNDEFINED", time() - 60 * 60 * 24 * 30, "/");
setcookie("key", "UNDEFINED", time() - 60 * 60 * 24 * 30, "/");
// $_COOKIE = array();
session_destroy();
echo json_encode(["status" => "ok", "message" => "Сессия успешно удалена"]);

?>