<?php 
/*
Сначала мы проверям сессию. Если она не активна, то мы проверемя наличие cookkie.
Идея заключается в том, что, если пользователь входит с нового окна браузера (новая сессия),
то, зная cookie, мы создадим новую сессию, котороя позволит избежать новой авторизации.
Cookie проверяются в бд на наличие пользователя с такими данными.
*/
require_once("../repository/Repository.php");
require_once("../model/User.php");
require("./constants.php");

session_start();

if (!isset($_SESSION['isAuth'])) {
    if (!empty($_COOKIE['login']) and !empty($_COOKIE['key'])) {
        $login = $_COOKIE['login']; 
        $key = $_COOKIE['key'];

        $repository = new Repository(PATH);
        $users = $repository->read();
        $user = null;

        foreach ($users as $item) {
            if ($item->getLogin() === $login && $item->getCookie() === $key) {
                $user = $item;
                break;
            }
        }

        if (!empty($user)) {
            $_SESSION["isAuth"] = true; 
            $_SESSION["name"] = $user->getName(); 
        }
    }
}