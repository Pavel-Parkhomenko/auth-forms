<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== "FetchAjaxRequest")
    exit();

require_once("../repository/Repository.php");
require_once("../model/User.php");
require("../helpers/helpers.php");
require("./constants.php");

$repository = new Repository(PATH);
$users = $repository->read();

$name = $_POST["name"];
$email = $_POST["email"];
$login = $_POST["login"];
$password = $_POST["password"];
$errors = [];
$salt = generateSalt();

function userIs($errors)
{
    echo json_encode($errors);
    exit();
}

foreach ($users as $user) {
    if ($user->getLogin() === $login) {
        $errors["type"] = "login";
        $errors["message"] = "Такой логин уже существует";
        userIs($errors);
    } elseif ($user->getEmail() === $email) {
        $errors["type"] = "email";
        $errors["message"] = "Такой email уже существует";
        userIs($errors);
    }
}

function addNewUser($repository, $login, $password, $email, $name, $salt, $cookie)
{
    $user = new User($login, $salt . md5($password), $email, $name, $salt, $cookie);
    $repository->create($user);
    $errors["type"] = "success";
    $errors["message"] = "";
    saveUserSession($user->getLogin(), $user->getCookie(), $user->getName());
    echo json_encode($errors);
}

addNewUser($repository, $login, $password, $email, $name, $salt, generateSalt());