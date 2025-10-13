<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function index(){
        return 124;
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('user login')->plainTextToken;
        if (!$user || !Auth::attempt($request->only('email', 'password'))) {
            return "Email Salah atau Password Salah";   
        }

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
        
        return $user->createToken('user login')->plainTextToken;


        // $request->validate([
        // 'email' => 'required|email',
        // 'password' => 'required|string', // Validasi min:6 bisa ditambahkan jika perlu
        // ]);

        // // Auth::attempt sudah mencakup pengecekan email dan password
        // if (!Auth::attempt($request->only('email', 'password'))) {
        //     // Ini akan otomatis mengembalikan respons JSON error 422 dengan pesan
        //     throw ValidationException::withMessages([
        //         'email' => 'Email atau password yang Anda masukkan salah.',
        //     ]);
        // }

        // // Jika berhasil, buat sesi baru
        // $request->session()->regenerate();

        // // Kembalikan data user yang login, BUKAN token
        // return response()->json(Auth::user());
    }

    public function me(Request $request){
        if ($request->user()) {
            return response()->json($request->user());
        }
        // return response()->json(['error' => 'Unauthenticated'], 401);
        return new UserResource($request->user());
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $reg = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user',
        ];

        $this->userService->registerUser($reg);
        return new UserResource($this->userService->getUserByEmail($request->email));


    }


}
