<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeKomentar extends Model
{
    protected $table = 'like_komentars';
    protected $fillable = ['user_id', 'komentar_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function komentar(){
        return $this->belongsTo(Komentar::class);
    }
    
}
