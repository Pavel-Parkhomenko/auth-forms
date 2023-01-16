<?php
function generateSalt()
{
    $salt = '';
    $saltLength = 8;

    for ($i = 0; $i < $saltLength; $i++) {
        $salt .= chr(mt_rand(33, 126));
    }

    return $salt;
}

function saveUserSession($login, $key, $name)
{
    setcookie("login", $login, time() + 60 * 60 * 24 * 30, "/");
    setcookie("key", $key, time() + 60 * 60 * 24 * 30, "/");
    session_start();
    $_SESSION["isAuth"] = true;
    $_SESSION["name"] = $name;
}
?>