<?php

namespace App\Http\Controllers;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Producer;
use App\Models\User;
use App\Models\Actor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    //Все фильмы
    public function index(){
        $data = Film::all();
        return view('home',['data'=>$data,'Type'=>'Films']);
    }

    //Информация об одном фильме
    public function getOne($param){
        $film = Film::find($param);
        $genres = $film->genres;
        $actors = $film->actors;
        $reviews = $film->reviews;
        $producers = $film->producers;
        $id = Auth::id();
        $userName = Controller::getUserName();
        $i = 0;
        $rating = 0;
        foreach ($reviews as $review){
            $i++;
            $rating+=$review['Rating'];
        }
        if($rating != 0){
            $rating/=$i;
        }
        $ratingKP = $this->getRating($film['Title']);

        return view('FilmInfo',['data'=>$film,
                                    'genres'=>$genres,
                                    'actors'=>$actors,
                                    'reviews'=>$reviews,
                                    'producers'=>$producers,
                                    'userId'=>$id,
                                    'userName'=>$userName,
                                    'Rating'=>$rating,
                                    'RatingKp'=>$ratingKP]);
    }

    //Получение рейтинга фильма по его названию
    private function getRating($nameFilm){
        $url = 'https://kinopoiskapiunofficial.tech/api/v2.1/films/search-by-keyword';
        $option = array(
            'keyword'=>$nameFilm,
            'page'=>1,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('X-API-KEY: 457506a9-507c-45e7-8e51-0a52aa1c836f'));
        curl_setopt($ch,CURLOPT_URL,$url.'?'.http_build_query($option));

        $response = curl_exec($ch);
        curl_close($ch);
        if(json_decode($response,true)['pagesCount']==0)
            return "Такой фильм не найден";
        return json_decode($response,true)['films'][0]['rating'];
    }

    //Сбор данных для отправки на форму добавить фильм
    public function getAddView(){
        $actors = Actor::all();
        $producers = Producer::all();
        $genres = Genre::all();
        return view('AddFilm',['actors'=>$actors,'producers'=>$producers,'genres'=>$genres]);
    }

    //Обработка формы для добавления фильма
    public function addFilm(Request $request){
        $film = Film::create(['Title'=>$request['Title'],
                                'Duration'=>$request['Duration'],
                                'Poster'=>$request['Poster'],
                                'Description'=>$request['Description']]);
        if(!is_null($request['Actors'])){
            $actors = Actor::find($request['Actors']);
            foreach ($actors as $actor){
                $film->actors()->attach($actor);
            }
        }

        if(!is_null($request['Producers'])){
            $producers = Producer::find($request['Producers']);
            foreach ($producers as $producer){
                $film->producers()->attach($producer);
            }
        }

        if(!is_null($request['Genres'])) {
            $genres = Genre::find($request['Genres']);
            foreach ($genres as $genre) {
                $film->genres()->attach($genre);
            }
        }
        return redirect('/');
    }

    //Сбор данных о фильме и отправка на форму редактирования
    public function editFilmView($param){
        $film = Film::find($param);
        $actors = Actor::all();
        $producers = Producer::all();
        $genres = Genre::all();
        $FilmActors = $this->generateName($film->actors);
        $FilmProducers = $this->generateName($film->producers);
        $FilmGenres = $this->generateName($film->genres);
        return view('EditFilm',['Film'=>$film,
            'Actors'=>$actors,
            'Producers'=>$producers,
            'Genres'=>$genres,
            'FilmActors'=>$FilmActors,
            'FilmProducers'=>$FilmProducers,
            'FilmGenres'=>$FilmGenres]);
    }


    //Создания массива с ID для удобной проверки совпадений в форме
    private function generateName($array){
        $arr = [];
        foreach ($array as $item){
            array_push($arr,$item['id']);
        }
        return $arr;
    }


    //Обработка post запроса с формы
    public function editFilm(Request $request,$param){
        $film = Film::find($param);
        $film->Title = $request['Title'];
        $film->Duration = $request['Duration'];
        $film->Poster = $request['Poster'];
        $film->Description = $request['Description'];
        $film->save();

        $film->actors()->detach();
        $film->producers()->detach();
        $film->genres()->detach();

        if(!is_null($request['Actors'])) {
            foreach ($request['Actors'] as $Actor)
                $film->actors()->attach($Actor);
        }

        if(!is_null($request['Producers'])) {
            foreach ($request['Producers'] as $Producer)
                $film->producers()->attach($Producer);
        }

        if(!is_null($request['Genres'])) {
            foreach ($request['Genres'] as $Genre)
                $film->genres()->attach($Genre);
        }

        return redirect('/getOne/'.$param);
    }

    public function deleteFilm($param){
        Film::find($param)->delete();
        return redirect('/');
    }

}
