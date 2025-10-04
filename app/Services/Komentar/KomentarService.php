<?php

namespace App\Services\Komentar;

use LaravelEasyRepository\BaseService;

interface KomentarService extends BaseService{

    // Write something awesome :)
    public function store(array $data);
    public function getKomentarByPostinganId($postinganId);
    public function updateKomentar($id, array $data);
    public function deleteKomentar($id);
}
