<?php

namespace App\Repositories\Postingan;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Postingan;

class PostinganRepositoryImplement extends Eloquent implements PostinganRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected Postingan $model;

    public function __construct(Postingan $model)
    {
        $this->model = $model;
    }

    public function getAllPostingan(){
        return $this->model->with('user')->get();
    }

    public function getPostinganById($id){
        return $this->model->with('user')->find($id);
    }
    public function createPostingan(array $data){
        return $this->model->create($data);
    }
    public function updatePostingan($id, array $data){
        $postingan = $this->model->find($id);
        if($postingan){
            $postingan->update($data);
            return $postingan;
        }
        return null;
    }
   public function deletePostingan($id)
{
    $postingan = $this->model->find($id);

    if ($postingan) {
        $postingan->delete();
        return $postingan; // ✅ kembalikan model, bukan boolean
    }

    return false;
}
public function getPostinganWithKomentars($postinganId){
        return $this->model
        ->with([
            'user:id,name,email',
            'komentars.user:id,name,email'
        ])
        ->find($postinganId);
    }

    public function getUserPostingan($userId){
       
    return $this->model
        ->where('user_id', $userId)
        ->with('user:id,name,email')
        ->get();

    }
}
