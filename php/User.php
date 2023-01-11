<?php
include_once 'Person.php';

class User extends Person {
    private $login;
    private $pass;
    private $email;

    function __construct($login, $pass, $email, $name) {
        parent::__construct($name);
        $this->login = $login;
        $this->pass = $pass;
        $this->email = $email;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($value) {
        $this->login = $value;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($value) {
        $this->pass = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getInfo()
    {
        return [
            'name' => $this->name, 
            'email' => $this->email,
            'login' => $this->login,
            'pass' => $this->pass,
        ];
    }
}