@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><b>{{$type}}:{{$data['Name']}}</b></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img width="450px" src="{{$data['Photo']}}">
            </div>
            <div class="col-md offset-1">
                <h2><b>Описание</b>:
                    {{$data['Description']}}
                    <br><br>
                    Возраст: {{$data['Age']}}.
                    <br><br>
                    Фильмы с его участием:
                    @foreach($films as $film)
                        @if($loop->last)
                            <a href="/getOne/{{$film['id']}}">{{$film['Title']}}.</a>
                        @else
                            <a href="/getOne/{{$film['id']}}">{{$film['Title']}},</a>
                        @endif
                    @endforeach
                </h2>
            </div>
        </div>
    </div>
@endsection
