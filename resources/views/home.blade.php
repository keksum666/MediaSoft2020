@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if($Type == 'Films')
        @foreach($data as $film)
        <div class="col-md-4">
            <div class="card text-white text-center bg-primary mb-3" style="width: 18rem">
                <img src="{{$film['Poster']}}" class="card-img-top" alt="Картинка">
                <div class="card-body">
                    <h5 class="card-title">{{$film['Title']}}</h5>
                    <a href="/getOne/{{$film['id']}}}" class="btn btn-light btn-block">Подробная информация</a>
                    @if(App\Http\Controllers\Controller::getIsAdmin())
                        <a href="/film/edit/{{$film['id']}}" class="btn btn-success btn-block">Изменить</a>
                        <a href="/film/delete/{{$film['id']}}" class="btn btn-danger btn-block">Удалить</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @elseif($Type=='Producers' or $Type == 'Actors')
            @foreach($data as $field)
                <div class="col-md-4">
                    <div class="card text-white text-center bg-primary mb-3" style="width: 18rem">
                        <img height="350px" src="{{$field['Photo']}}" class="card-img-top" alt="Картинка">
                        <div class="card-body">
                            <h5 class="card-title">{{$field['Name']}}</h5>
                            @if($Type == 'Producers')
                                <a href="/producer/{{$field['id']}}" class="btn btn-light btn-block">Подробная информация</a>
                                @if(App\Http\Controllers\Controller::getIsAdmin())
                                    <a href="/producer/edit/{{$field['id']}}" class="btn btn-success btn-block">Изменить</a>
                                    <a href="/producer/delete/{{$field['id']}}" class="btn btn-danger btn-block">Удалить</a>
                                @endif
                            @else
                                <a href="/actor/{{$field['id']}}" class="btn btn-light btn-block">Подробная информация</a>
                                @if(App\Http\Controllers\Controller::getIsAdmin())
                                    <a href="/actor/edit/{{$field['id']}}" class="btn btn-success btn-block">Изменить</a>
                                    <a href="/actor/delete/{{$field['id']}}" class="btn btn-danger btn-block">Удалить</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
