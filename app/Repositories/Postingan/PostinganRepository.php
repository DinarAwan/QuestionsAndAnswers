<?php

namespace App\Repositories\Postingan;

use LaravelEasyRepository\Repository;

interface PostinganRepository extends Repository{

    public function getAllPostingan();
    public function getPostinganById($id);
    public function createPostingan(array $data);
    public function updatePostingan($id, array $data);
    public function deletePostingan($id);
    public function getPostinganWithKomentars($postinganId);
}
