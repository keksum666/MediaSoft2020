@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><b>{{$data['Title']}}</b></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img width="400px" src="{{$data['Poster']}}">
        </div>
        <div class="col-md offset-1">
            <h4><b>Описание</b>:
                {{$data['Description']}}
                <br><br>
            Жанры:
            @foreach($genres as $genre)
                @if($loop->last)
                        <a href="#">{{$genre['Genre']}}</a>.
                @else
                        <a href="#">{{$genre['Genre']}}</a>,
                @endif
            @endforeach
                <br><br>
            Актеры:
                @foreach($actors as $actor)
                    @if($loop->last)
                        <a href="/actor/{{$actor['id']}}">{{$actor['Name']}}</a>.
                    @else
                        <a href="/actor/{{$actor['id']}}">{{$actor['Name']}}</a>,
                    @endif
                @endforeach
                <br><br>
            Режиссеры:
                @foreach($producers as $producer)
                    @if($loop->last)
                        <a href="/producer/{{$producer['id']}}">{{$producer['Name']}}</a>.
                    @else
                        <a href="/producer/{{$producer['id']}}">{{$producer['Name']}}</a>,
                    @endif
                @endforeach
                <br><br>
            Продолжительность фильма: {{$data['Duration']}} минут.
                <br><br>
            Рейтинг по мнению пользователей: {{round($Rating,2)}}
                <br>
            Рейтинг кинопоиска:{{$RatingKp}}

            </h4>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-md-12">
            <h1 class="text-center">Комментарии</h1>
        </div>
    </div>
    <div class="row">
        <form method="post" action="/review/new">
            @csrf
            @method('post')
            <input id="film_id" name="film_id" type="hidden" value="{{$data['id']}}">
            <input id="userName" name="userName" type="hidden" value="{{Auth::id()}}">
            <h3 for="textArea1">Напишите свой комментарий к фильму</h3>
            <textarea required name="textArea1" id="textArea1" class="form-control" rows="3" cols="200"></textarea>
            <div class="form-check form-check-inline" >
                <input type="radio" class="form-check-input" name="Radios" id="Radios1" value="1" checked>
                <label class="form-check-label" for="Radios1">1★</label>
            </div>
            <div class="form-check form-check-inline" >
                <input type="radio" class="form-check-input" name="Radios" id="Radios2" value="2">
                <label class="form-check-label" for="Radios2">2★</label>
            </div>
            <div class="form-check form-check-inline" >
                <input type="radio" class="form-check-input" name="Radios" id="Radios3" value="3">
                <label class="form-check-label" for="Radios3">3★</label>
            </div>
            <div class="form-check form-check-inline" >
                <input type="radio" class="form-check-input" name="Radios" id="Radios4" value="4">
                <label class="form-check-label" for="Radios4">4★</label>
            </div>
            <div class="form-check form-check-inline" >
                <input type="radio" class="form-check-input" name="Radios" id="Radios5" value="5">
                <label class="form-check-label" for="Radios5">5★</label>
            </div>
            @auth()
                <button type="submit" class="btn btn-primary">Оставить отзыв</button>
            @else
                <button disabled type="submit" class="btn btn-primary">Оставить отзыв</button>
            @endif
        </form>
        @foreach($reviews as $review)
            <div class="container-fluid alert alert-warning">
                    <h4>Пользователь:{{$review['UserName']}}</h4>
                    <h4>Комментарий:{{$review['Review']}}</h4>
                    <h4>Оценка:{{$review['Rating']}}</h4>
                    <h4>Дата коментария:{{$review['created_at']}}</h4>
                    @if($userName == $review['UserName'] or App\Http\Controllers\Controller::getIsAdmin())
                        <a href="/review/delete/{{$review['id']}}/{{$data['id']}}" class="btn btn-danger">Удалить комментарий</a>
                    @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
