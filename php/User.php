<?php
include_once 'Person.php';

class User extends Person implements JsonSerializable {
    private $login;
    private $password;
    private $email;
    private $salt;

    function __construct($login, $password, $email, $name, $salt) {
        parent::__construct($name);
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->salt = $salt;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($value) {
        $this->salt = $value;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($value) {
        $this->login = $value;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => parent::getName(), 
            'email' => $this->email,
            'login' => $this->login,
            'password' => $this->password,
            'salt' => $this->salt,
        ];
    }
}