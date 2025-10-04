<?php

namespace App\Http\Resources\postingan;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPostinganResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
    ];
    }

    public function with($request)
    {
    return [
        'message' => 'Postingan deleted successfully'
    ];
}
}
