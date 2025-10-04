<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikPostingan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userSaatIni = Auth::user();
        $postingan = Postingan::findOrFail($request->id);
        if($userSaatIni->id !== $postingan->user_id){
            return response()->json(['message' => 'Anda tidak memiliki izin untuk mengedit postingan ini.'], 403);
        }
        return $next($request);
    }
}
