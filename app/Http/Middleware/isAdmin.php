<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //Проверка на администратора
    public function handle(Request $request, Closure $next)
    {
        $id = Auth::id();
        if(is_null($id))
            abort('403');
        elseif(!User::find($id)['isAdmin'])
            abort('403');
        return $next($request);
    }
}
