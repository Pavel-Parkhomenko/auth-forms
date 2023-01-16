<?php
include_once("../model/User.php");
include_once("IRepository.php");

class Repository implements IRepository
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

    public function update(User $user)
    {
        $users = $this->read();
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]->getLogin() === $user->getLogin()) {
                $users[$i]->setEmail($user->getEmail());
                $users[$i]->setName($user->getName());
                $users[$i]->setPassword($user->getPassword());
            }
        }
        file_put_contents($this->path, json_encode($users));
    }

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