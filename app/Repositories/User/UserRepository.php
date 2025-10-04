<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository{

    // Write something awesome :)
    public function getUserByEmail($email);
    public function getUserById($id);
    public function getAllUsers();
    public function registerUser($data);
}
