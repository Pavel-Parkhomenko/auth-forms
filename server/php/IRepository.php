<?php
require_once("./User.php");
interface IRepository
{
    public function read();
    public function update(User $user);
    public function create(User $user);
    public function delete(User $user);
}