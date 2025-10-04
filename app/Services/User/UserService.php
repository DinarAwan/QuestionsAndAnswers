<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    // Write something awesome :)
    public function getUserByEmail($email);
    public function getUserById($id);
    public function getAllUsers();
    public function registerUser($data);
}
