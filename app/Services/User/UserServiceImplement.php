<?php

namespace App\Services\User;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends ServiceApi implements UserService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
     protected string $title = "";
     /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected UserRepository $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
    public function getUserByEmail($email){
        return $this->mainRepository->getUserByEmail($email);
    }

    public function getUserById($id){
        return $this->mainRepository->getUserById($id);
    }
    public function getAllUsers(){
        return $this->mainRepository->getAllUsers();
    }
    public function registerUser($data){
        return $this->mainRepository->registerUser($data);
    }
}
