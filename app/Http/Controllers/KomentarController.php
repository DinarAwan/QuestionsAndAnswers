<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\LikeKomentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Komentar\KomentarService;
use App\Services\Postingan\PostinganService;
use App\Http\Resources\Komentar\KomentarResource;
use App\Http\Resources\Postingan\PostinganWithKomentarResource;

class KomentarController extends Controller
{
    protected $KomentarService, $PostinganService;
    public function __construct(KomentarService $KomentarService, PostinganService $PostinganService){
        [
            $this->KomentarService = $KomentarService,
            $this->PostinganService = $PostinganService,
        ];
    }
    public function index(){
        return "ini adalah komentar";
    }

    public function store(Request $request){
        $user = Auth::user();
        $validasi = $request->validate([
            'komentar' => 'required|string',
            'postingan_id' => 'required|exists:postingans,id',
        ]);
        $validasi['user_id'] = $user->id;
        $komentar = $this->KomentarService->store($validasi);
        return new KomentarResource($komentar->loadMissing('user:id,name,email','postingan:id,judul,isi,gambar'));
    }

    public function getKomentarByPostinganId($postinganId){
        $komentars = $this->KomentarService->getKomentarByPostinganId($postinganId);
        return KomentarResource::collection($komentars);
    }

    public function getPostinganWithKomentars($postinganId){
        $postingan = $this->PostinganService->getPostinganWithKomentars($postinganId);
        return new PostinganWithKomentarResource($postingan);
    }
    public function update(Request $request, $id){  
        $validate = $request->validate([
            'komentar' => 'required|string',
        ]);

        $komentar = $this->KomentarService->updateKomentar($id, $validate);
        return new KomentarResource($komentar->loadMissing('user:id,name,email','postingan:id,judul,isi,gambar'));

    }

    public function destroy($id){
        $komentar = $this->KomentarService->deleteKomentar($id);
        return new KomentarResource($komentar);
    }

    public function likeKomentar(LikeKomentar $LikeKomentar, $id){
        $user = Auth::user();
        $sudahLike = LikeKomentar::where('user_id', $user->id)
                        ->where('komentar_id', $id)
                        ->first();
        if(!$sudahLike){
            $like = LikeKomentar::create([
                'user_id' => $user->id,
                'komentar_id' => $id,
            ]);
            return response()->json(['message' => 'Komentar liked', 'data' => $like], 200);
        } else {
            $sudahLike->delete();
            return response()->json(['message' => 'Like removed'], 200);
        }
    }

    public function countLikesByKomentarId($komentarId){
        $likeCount = LikeKomentar::where('komentar_id', $komentarId)->count();
        return response()->json(['komentar_id' => $komentarId, 'like_count' => $likeCount], 200);
    }
    public function shorLikeKomentarASC(){
        $likeCount = Komentar::withCount('likeKomentars')->orderBy('like_komentars_count', 'desc')->get();
        return KomentarResource::collection($likeCount->loadMissing('user:id,name,email','postingan:id,judul,isi,gambar'));
    }

}
