@extends('layouts.app')
@section('content')
<div class="alert alert-primary mr-3 ml-3">
    <form method="post" action="/film/add">
        @csrf
        <div class="form-group">
            <label for="Title">Введите название фильма</label>
            <input name="Title" id="Title" class="form-control" type="text" required>
            <label for="" class="pt-2">Введите длительность фильма в минутах</label>
            <input name="Duration" id="Duration" class="form-control" type="number" required>
            <label for="Poster" class="pt-2">Введите ссылку на постер(URL)</label>
            <input name="Poster" id="Poster" class="form-control" type="text" required>
            <label for="Description" class="pt-2">Введите описание фильма</label>
            <textarea class="form-control" name="Description" id="Description" type="text" required></textarea>
            <label for="Actors[]" class="pt-2">Выберите актеров которые снимались в фильме(ctrl+click)</label>
            <select size="10" class="form-control" multiple name="Actors[]" id="Actors[]">
                @foreach($actors as $actor)
                    <option value="{{$actor['id']}}">{{$actor['Name']}}</option>
                @endforeach
            </select>
            <label for="Producers[]" class="pt-2">Выберите продюссеров которые участвовали в фильме(ctrl+click)</label>
            <select size="10" class="form-control" multiple name="Producers[]" id="Producers[]">
                @foreach($producers as $producer)
                    <option value="{{$producer['id']}}">{{$producer['Name']}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success mt-3 container-fluid">Добавить</button>
        </div>
    </form>
</div>
@endsection
