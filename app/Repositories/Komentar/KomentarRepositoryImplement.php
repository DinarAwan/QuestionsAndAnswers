<?php

namespace App\Repositories\Komentar;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Komentar;

class KomentarRepositoryImplement extends Eloquent implements KomentarRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected Komentar $model;

    public function __construct(Komentar $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }
    public function getKomentarByPostinganId($postinganId)
    {
        return $this->model->where('postingan_id', $postinganId)->with('user')->get();
    }
    public function updateKomentar($id, array $data){
        $komentar = $this->model->find($id);
        if($komentar){
            $komentar->update($data);
            return $komentar;
        }
        return null;
    }
    
    public function deleteKomentar($id){
        $komentar = $this->model->find($id);
        if($komentar){
            $komentar->delete();
            return $komentar;
        }
        return false;
    }

 
    // Write something awesome :)
}
