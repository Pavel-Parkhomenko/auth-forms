<?php
/* Клиент всегда должен устанавливать этот заголовок со значением "FetchAjaxRequest".
Это проверка на то, что клиент использует Ajax.
*/
if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== "FetchAjaxRequest")
    exit();

require_once("../model/Person.php");
require_once("../repository/Repository.php");
require_once("../model/User.php");
require("../helpers/helpers.php");
require("./constants.php");

$repository = new Repository(PATH);

$users = $repository->read();
$login = $_POST["login"];
$password = $_POST["password"];
$errors = [];

$hasUser = false;

// Провереем пользователя на наличие в бд
foreach ($users as $user) {
    if (
        $user->getLogin() === $login &&
        $user->getPassword() === $user->getSalt() . md5($password)
    ) {
        $hasUser = true;
        loginSuccess($user);
    }
}
// если пользователь не найден, то клиент получит соотвествующее сообщение
if ($hasUser === false) {
    $errors["type"] = "not-find";
    $errors["message"] = "Неверный логин или пароль";
    echo json_encode($errors);
}

function loginSuccess($user)
{
    $errors["type"] = "success";
    $errors["message"] = "";
    saveUserSession($user->getLogin(), $user->getCookie(), $user->getName());
    echo json_encode($errors);
}