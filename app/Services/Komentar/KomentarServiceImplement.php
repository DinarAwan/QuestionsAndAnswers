<?php

namespace App\Services\Komentar;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Komentar\KomentarRepository;

class KomentarServiceImplement extends ServiceApi implements KomentarService{

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
     protected KomentarRepository $mainRepository;

    public function __construct(KomentarRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function store(array $data)
    {
        return $this->mainRepository->store($data);
    }
    public function getKomentarByPostinganId($postinganId){
        return $this->mainRepository->getKomentarByPostinganId($postinganId);
    }
    public function updateKomentar($id, array $data){
        return $this->mainRepository->updateKomentar($id, $data);
    }
  
    public function deleteKomentar($id){
        return $this->mainRepository->deleteKomentar($id);
    }
    // Define your custom methods :)
}
