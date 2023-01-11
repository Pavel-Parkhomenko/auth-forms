<?php
include_once 'User.php';

class Repository
{
    private $path;

    function __construct($path)
    {
        $this->path = $path;
    }

    public function read()
    {
        $file = file_get_contents($this->path);
        $users = json_decode($file, true) ?? [];
        return $users;
    }

    public function update(User $user)
    {
        $users = $this->read();
        $users[] = $user->getInfo();
        file_put_contents($this->path, json_encode($users));
    }

    public function create(User $user)
    {
        $users = $this->read();

        foreach ($users as $item) {
            if ($user->getEmail() == $item["mail"] || $user->getLogin() == $item["login"]) {
                exit('Такой логин или почта уже существует');
            }
        }
        $this->update($user);
    }

    public function delete(User $user) {
        $users = $this->read();

        foreach ($users as $key => $item) {
            if ($users[$key]["login"] == $user->getLogin()) {
                unset($users[$key]);
            }
        }

        file_put_contents($this->path, json_encode($users));
    }
}