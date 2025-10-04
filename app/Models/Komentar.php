<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'postingan_komentars';

    protected $fillable = [
        'postingan_id',
        'user_id',
        'komentar',
    ];

    public function postingan(){
        return $this->belongsTo(Postingan::class, 'postingan_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likeKomentars(){
        return $this->hasMany(LikeKomentar::class, 'komentar_id');
    }
}
