@extends('layouts.app')
@section('content')
<div class="alert alert-primary mr-3 ml-3">
    <form method="post" action="/film/edit/{{$Film['id']}}">
        @csrf
        <div class="form-group">
            <label for="Title">Введите название фильма</label>
            <input name="Title" id="Title" class="form-control" type="text" value="{{$Film['Title']}}" required>
            <label for="" class="pt-2">Введите длительность фильма в минутах</label>
            <input name="Duration" id="Duration" class="form-control" type="number" value="{{$Film['Duration']}}" required>
            <label for="Poster" class="pt-2">Введите ссылку на постер(URL)</label>
            <input name="Poster" id="Poster" class="form-control" type="text" required value="{{$Film['Poster']}}">
            <label for="Description" class="pt-2">Введите описание фильма</label>
            <textarea rows="15" class="form-control" name="Description" id="Description" type="text" required>{{$Film['Description']}}</textarea>
            <label for="Actors[]" class="pt-2">Выберите актеров которые снимались в фильме(ctrl+click)</label>
            <select size="10" class="form-control" multiple name="Actors[]" id="Actors[]">
                @foreach($Actors as $Actor)
                    @if(in_array($Actor['id'],$FilmActors))
                        <option selected value="{{$Actor['id']}}">{{$Actor['Name']}}</option>
                    @else
                        <option value="{{$Actor['id']}}">{{$Actor['Name']}}</option>
                    @endif
                @endforeach
            </select>
            <label for="Producers[]" class="pt-2">Выберите продюссеров которые участвовали в фильме(ctrl+click)</label>
            <select size="10" class="form-control" multiple name="Producers[]" id="Producers[]">
                @foreach($Producers as $Producer)
                    @if(in_array($Producer['id'],$FilmProducers))
                        <option selected value="{{$Producer['id']}}">{{$Producer['Name']}}</option>
                    @else
                        <option value="{{$Producer['id']}}">{{$Producer['Name']}}</option>
                    @endif
                @endforeach
            </select>
            <label for="Genres[]" class="pt-2">Выберите жанр(ы) фильма(ctrl+click)</label>
            <select name="Genres[]" id="Genres[]" class="form-control" size="10">
                @foreach($Genres as $Genre)
                    @if(in_array($Genre['id'],$FilmGenres))
                        <option selected value="{{$Genre['id']}}">{{$Genre['Genre']}}
                    @else
                        <option value="{{$Genre['id']}}">{{$Genre['Genre']}}
                    @endif
                @endforeach
            </select>
            <button type="submit" class="btn btn-success mt-3 container-fluid">Подтвердить</button>
        </div>
    </form>
</div>
@endsection
