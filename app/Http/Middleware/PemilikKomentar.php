<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikKomentar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $komentar = Komentar::findOrFail($request->id);
        if($user->id !== $komentar->user_id){
            return response()->json(['message' => 'Anda tidak memiliki izin untuk mengedit komentar ini.'], 403);
        }
        return $next($request);
    }
}
