<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== "FetchAjaxRequest")
    exit();

require_once("../repository/Repository.php");
require_once("../constants/constants.php");
require_once("./model/User.php");
require("../helpers/helpers.php");

$repository = new Repository(PATH);

$users = $repository->read();
$login = $_POST["login"];
$password = $_POST["password"];
$errors = [];

$hasUser = false;

foreach ($users as $user) {
    if (
        $user->getLogin() === $login &&
        $user->getPassword() === $user->getSalt() . md5($password)
    ) {
        $hasUser = true;
        loginSuccess($user);
    }
}

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