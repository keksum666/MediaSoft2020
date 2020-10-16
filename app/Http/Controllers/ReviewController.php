<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    //Создать новый комментарий для фильма
    public function newReview(Request $request){
        Review::create([
            'Film_id'=>$request['film_id'],
            'Review'=>$request['textArea1'],
            'Rating'=>$request['Radios'],
            'UserName'=>User::find($request['userName'])['name'],
        ]);
        return redirect('/getOne/'.$request['film_id']);
    }

    //Удалить комментарий
    public function delete($param1,$param2){
        Review::find($param1)->delete();
        return redirect('/getOne/'.$param2);
    }
}
