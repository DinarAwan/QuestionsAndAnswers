<?php

namespace App\Http\Resources\Postingan;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Komentar\KomentarResource;

class PostinganWithKomentarResource extends JsonResource
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
            'judul' => $this->judul,
            'isi' => $this->isi,
            'gambar' => $this->gambar,
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ];
            }),
            'komentars' => KomentarResource::collection($this->whenLoaded('komentars')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
