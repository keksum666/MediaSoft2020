@extends('layouts.app')
@section('content')
    <div class="alert alert-primary mr-3 ml-3">
        <form method="post" action="/genres/add">
            @csrf
            <div class="form-group">
                <label for="genre">Введите жанр</label>
                <input id="genre" name="genre" class="form-control" type="text" required>
                <label for="Films[]" class="pt-2">Выберите фильм к которому относится данный жанр(ctrl+click)</label>
                <select multiple name="Films[]" id="Films[]" class="form-control">
                    @foreach($Films as $Film)
                        <option value="{{$Film['id']}}">{{$Film['Title']}}</option>
                    @endforeach
                </select>
                <div class="pt-3">
                    <button class="btn btn-success container-fluid" type="submit">Добавить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
