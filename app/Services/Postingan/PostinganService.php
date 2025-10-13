<?php

namespace App\Services\Postingan;

use LaravelEasyRepository\BaseService;

interface PostinganService extends BaseService{

    public function getAllPostingan();
    public function getPostinganById($id);
    public function createPostingan(array $data);
    public function updatePostingan($id, array $data);
    public function deletePostingan($id);
    public function getPostinganWithKomentars($postinganId);
    public function getUserPostingan($userId);

}
