<?php

namespace App\Http\Resources\Komentar;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KomentarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'komentar' => $this->komentar,
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ];
            }), 
            'postingan' => $this->whenLoaded('postingan', function () {
                return [
                    'id' => $this->postingan->id,
                    'judul' => $this->postingan->judul,
                    'isi' => $this->postingan->isi,
                    'gambar' => $this->postingan->gambar,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
    ];
    }
}
