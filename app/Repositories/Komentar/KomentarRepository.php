<?php

namespace App\Repositories\Komentar;

use LaravelEasyRepository\Repository;

interface KomentarRepository extends Repository{

    // Write something awesome :)
    public function store(array $data);
    public function getKomentarByPostinganId($postinganId);
    public function updateKomentar($id, array $data);
    public function deleteKomentar($id);
    
}
