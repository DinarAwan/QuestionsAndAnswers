<?php

namespace App\Services\Postingan;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Postingan\PostinganRepository;

class PostinganServiceImplement extends ServiceApi implements PostinganService{

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
     protected PostinganRepository $mainRepository;

    public function __construct(PostinganRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllPostingan(){
        return $this->mainRepository->getAllPostingan();
    }
    public function getPostinganById($id){
        return $this->mainRepository->getPostinganById($id);
    }
    public function createPostingan(array $data){
        return $this->mainRepository->createPostingan($data);
    }
    public function updatePostingan($id, array $data){
        return $this->mainRepository->updatePostingan($id, $data);
    }
    
    public function deletePostingan($id){
        return $this->mainRepository->deletePostingan($id);
    }
      public function getPostinganWithKomentars($postinganId){
        return $this->mainRepository->getPostinganWithKomentars($postinganId);
    }
    public function getUserPostingan($userId){
        return $this->mainRepository->getUserPostingan($userId);
    }
}
