<?php

namespace App\Http\Resources\Postingan;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostinganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'isi' => $this->isi,
            'gambar' => $this->gambar,
            'user' => $this->whenLoaded('user', function () {
            return [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'id' => $this->user->id,
            ];
        }), 
            
        ];
    }
}
