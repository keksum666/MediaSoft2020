<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    //Узнать является ли данный пользователь администратором
    public static function getIsAdmin(){
        $id = Auth::id();
        if(is_null($id))
            return 0;
        else
            return User::find($id)['isAdmin'];
    }


    //Узнать имя пользователя
    public function getUserName(){
        $id = Auth::id();
        if(is_null($id))
            return "";
        else
            return User::find($id)['name'];
    }
}
