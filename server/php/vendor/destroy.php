<?php

session_start();

setcookie("login", "UNDEFINED", time() - 60 * 60 * 24 * 30, "/");
setcookie("key", "UNDEFINED", time() - 60 * 60 * 24 * 30, "/");
// $_COOKIE = array();
session_destroy();
echo json_encode(["status" => "ok", "message" => "Сессия успешно удалена"]);

?>