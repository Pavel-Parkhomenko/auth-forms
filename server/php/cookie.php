<?php 

require_once("./Repository.php");
require_once("./User.php");
require("../constants/constants.php");

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