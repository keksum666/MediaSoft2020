<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Models\Film;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ProducerController extends Controller
{
    //Все продюссеры
    public function getProducer($param){
        $producer = Producer::find($param);
        $films = $producer->films;
        return view('ActorOrProducerInfo',['data'=>$producer,'films'=>$films,'type'=>'Режиссер']);
    }

    //Один продюссер
    public function getProducers(){
        $producers = Producer::all();
        return view('home',['data'=>$producers,'Type'=>'Producers']);
    }

    //View на добавление продюсера
    public function getAddView(){
        $films = Film::all();
        return view('addProducer',['films'=>$films]);
    }

    //Обработка добавления продюсера
    public function addProducer(Request $request){
        $producer = Producer::create(['Name'=>$request['Name'],
                                    'Photo'=>$request['Photo'],
                                    'Age'=>$request['Age'],
                                    'Description'=>$request['Description']]);
        $film = Film::find($request['Films']);
        foreach ($film as $item){
            $item->producers()->attach($producer);
        }
        return redirect('/');
    }

    //View на изменение продюсера
    public function getEditView($param){
        $Producer = Producer::find($param);
        $Films = Film::all();
        $ProducerFilms = $this->generateName($Producer->films);
        return view('EditProducer',['Producer'=>$Producer,
                                         'Films'=>$Films,
                                         'ProducerFilms'=>$ProducerFilms]);
    }

    private function generateName($array){
        $arr = [];
        foreach ($array as $item) {
            array_push($arr,$item['id']);
        }
        return $arr;
    }

    //Обработка изменения продюссера
    public function editProducer(Request $request,$param){
        $Producer = Producer::find($param);
        $Producer->Name = $request['Name'];
        $Producer->Photo = $request['Photo'];
        $Producer->Age = $request['Age'];
        $Producer->Description = $request['Description'];
        $Producer->save();

        $Producer->films()->detach();

        if(!is_null($request['Films'])) {
            foreach ($request['Films'] as $Film)
                $Producer->films()->attach($Film);
        }

        return redirect('/producer/'.$param);
    }

    public function deleteFilm($param){
        Producer::find($param)->delete();
        return redirect('/producers');
    }
}
