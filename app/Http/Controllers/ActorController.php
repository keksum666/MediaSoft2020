<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Film;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ActorController extends Controller
{
    //Получить 1 актера по ID
    public function getActor($param){
        $actor = Actor::find($param);
        $films = $actor->films;
        return view('ActorOrProducerInfo',['data'=>$actor,'films'=>$films,'type'=>'Актер']);
    }

    //Получить весь список актеров
    public function getActors(){
        $actors = Actor::all();
        return view('home',['data'=>$actors,'Type'=>'Actors']);
    }

    //Сбор информации и отправка на view
    public function getAddView(){
        $films = Film::all();
        return view('addActor',['films'=>$films]);
    }


    //Обработка post запроса с формы
    public function addActor(Request $request){
        $actor = Actor::create(['Name'=>$request['Name'],
                       'Photo'=>$request['Photo'],
                       'Age'=>$request['Age'],
                       'Description'=>$request['Description']]);
        if(!is_null($request['Films'])) {
            $film = Film::find($request['Films']);
            foreach ($film as $item) {
                $item->actors()->attach($actor);
            }
        }
        return redirect('/actors');

    }

    //Сбор информации и отправка на view
    public function getEditView($param){
        $Actor = Actor::find($param);
        $Films = Film::all();
        $ActorFilms = $this->generateName($Actor->films);
        return view('EditActor',['Actor'=>$Actor,
            'Films'=>$Films,
            'ActorFilms'=>$ActorFilms]);
    }

    //Для удобного сравнения уже выбранных жанров в view
    private function generateName($array){
        $arr = [];
        foreach ($array as $item) {
            array_push($arr,$item['id']);
        }
        return $arr;
    }

    //Обработка post запроса с формы
    public function editActor(Request $request,$param){
        $Actor = Actor::find($param);
        $Actor->Name = $request['Name'];
        $Actor->Photo = $request['Photo'];
        $Actor->Age = $request['Age'];
        $Actor->Description = $request['Description'];
        $Actor->save();

        $Actor->films()->detach();

        if(!is_null($request['Films'])) {
            foreach ($request['Films'] as $Film)
                $Actor->films()->attach($Film);
        }

        return redirect('/actor/'.$param);
    }

    public function deleteActor($param){
        Actor::find($param)->delete();
        return redirect('/actors');
    }
}
