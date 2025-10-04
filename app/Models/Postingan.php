<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    protected $table = 'postingans';
    protected $fillable = ['judul', 'isi', 'gambar', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function komentars(){
        return $this->hasMany(Komentar::class, 'postingan_id');
    }
}
