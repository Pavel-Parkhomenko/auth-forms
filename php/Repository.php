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
        $usersAsUser = [];
        foreach ($users as $user) {
            $usersAsUser[] = new User(...$user);
        }
        return $usersAsUser;
    }

    // public function update(User $user)
    // {
    //     $users = $this->read();
    //     for ($i = 0; $i < count($users); $i++) {
    //         if ($users[$i]->getLogin() === $user->getLogin()) {
    //             $users[$i]->getEmail() = $user->getEmail();
    //             $users[$i]->getName() = $user->getName();
    //             $users[$i]->getPassword() = $user->getPassword();
    //         }
    //     }
    //     file_put_contents($this->path, json_encode($users));
    // }

    public function create(User $user)
    {
        $users = $this->read();
        $users[] = $user;
        file_put_contents($this->path, json_encode($users));
    }

    public function delete(User $user)
    {
        $users = $this->read();

        foreach ($users as $key => $item) {
            if ($users[$key]->getLogin() == $user->getLogin()) {
                unset($users[$key]);
            }
        }

        file_put_contents($this->path, json_encode($users));
    }
}