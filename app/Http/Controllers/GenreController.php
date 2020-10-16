<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\returnValue;

class GenreController extends Controller
{
    //Получить все жанры
    public function getGenres(){
        $genres = Genre::all();
        return view('Genres',['genres'=>$genres]);
    }

    //Получить все фильмы по жанру
    public function filmsByGenres($param){
        $films = Genre::find($param)->films;
        return view('home',['data'=>$films,'Type'=>'Films']);
    }

    //View добавления жанра
    public function getAddView(){
        return view('addGenres',['Films'=>Film::all()]);
    }

    //Обработка добавления жанра
    public function genreAdd(Request $request){
        $Genre = Genre::create(['Genre'=>$request['genre']]);
        if(!is_null($request['Films'])){
            foreach ($request['Films'] as $Film)
                $Genre->films()->attach($Film);
        }
        return redirect('/genres');
    }

    //Обработка удаления жанра
    public function genreDelete($param){
        Genre::find($param)->delete();
        return redirect('/genres');
    }

    //View изменения жанра
    public function getEditView($param){
        $Genre = Genre::find($param);
        $Films = Film::all();
        $GenreFilms = $this->generateName($Genre->films);
        return view('EditGenres',['Genre'=>$Genre,'Films'=>$Films,'GenreFilms'=>$GenreFilms]);
    }


    private function generateName($array){
        $arr = [];
        foreach ($array as $item){
            array_pad($arr,$item['id']);
        }
    }
}
