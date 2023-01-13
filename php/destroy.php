<?php
session_start();
unset($_SESSION["isAuth"]);
session_destroy();
echo json_encode(["status" => "ok", "message" => "Сессия успешно удалена"]);
exit();