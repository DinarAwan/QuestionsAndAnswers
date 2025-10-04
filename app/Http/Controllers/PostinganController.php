<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Postingan\PostinganService;
use App\Http\Resources\Postingan\PostinganResource;
use App\Http\Resources\Postingan\ShowPostinganResource;

class PostinganController extends Controller
{
    protected $postinganService;

    public function __construct(PostinganService $postinganService){
        $this->postinganService = $postinganService;
    }
    public function index(){
        $postingan = $this->postinganService->getAllPostingan();
        return PostinganResource::collection($postingan->loadMissing('user:id,name,email'));
    }

    public function show($id){
        $postingan = $this->postinganService->getPostinganById($id);
        if(!$postingan){
            return response()->json(['message' => 'Postingan not found'], 404);
        }
        return new ShowPostinganResource($postingan->loadMissing('user:id,name,email'));
    }

    public function store(Request $request){
        $user = Auth::user();
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('images', 'public');
            $validatedData['gambar'] = $path;
        }
        $validatedData['user_id'] = $user->id;

        $postingan = $this->postinganService->createPostingan($validatedData);

        return new ShowPostinganResource($postingan->loadMissing('user:id,name,email'));
    }

    public function update(Request $request, $id){
       $validatePostingan = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
       ]);
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('images', 'public');
            $validatePostingan['gambar'] = $path;
        }
        $postingan = $this->postinganService->updatePostingan($id, $validatePostingan);
        if(!$postingan){
            return response()->json(['message' => 'Postingan not found'], 404);
        }
        return new ShowPostinganResource($postingan->loadMissing('user:id,name,email'));
    
    }

    public function destroy($id){
        // $hapusPostingan = $this->postinganService->deletePostingan($id);
        // if(!$hapusPostingan){
        //     return response()->json(['message' => 'Postingan not found'], 404);
        // }
        // return new ShowPostinganResource($hapusPostingan->loadMissing('user:id,name,email'));

        $hapusPostingan = $this->postinganService->deletePostingan($id);

        if (!$hapusPostingan) {
            return response()->json(['message' => 'Postingan not found'], 404);
        }

        return response()->json([
            'message' => 'Postingan deleted successfully',
            'data' => new ShowPostinganResource($hapusPostingan->loadMissing('user:id,name,email'))
        ]);
    }


}
