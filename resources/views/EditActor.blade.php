@extends('layouts.app')
@section('content')
    <div class="alert alert-primary mr-3 ml-3">
        <form method="post" action="/actor/edit/{{$Actor['id']}}">
            @csrf
            <div class="form-group">
                <label for="name">Введите имя</label>
                <input value="{{$Actor['Name']}}" name="Name" id="Name" class="form-control" type="text" required>
                <label for="Photo" class="pt-2">Введите ссылку на изображение(URL)</label>
                <input value="{{$Actor['Photo']}}" name="Photo" id="Photo" class="form-control" type="text" required>
                <label for="Age" class="pt-2">Введите возраст актера</label>
                <input value="{{$Actor['Age']}}" name="Age" id="Age" class="form-control" type="number" required>
                <label for="Description" class="pt-2">Напишите подробную информацию об актере</label>
                <textarea name="Description" rows="10" id="Description" class="form-control" type="text" required>{{$Actor['Description']}}</textarea>
                <label for="Films" class="pt-2">Выберите фильмы в которых участвует актер(ctrl+click)</label>
                <select multiple class="form-control" name="Films[]" id="Films[]">
                    @foreach($Films as $Film)
                        @if(in_array($Film['id'],$ActorFilms))
                            <option selected value="{{$Film['id']}}">{{$Film['Title']}}</option>
                        @else
                            <option selected value="{{$Film['id']}}">{{$Film['Title']}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="pt-3">
                    <button class="btn btn-success container-fluid" type="submit">Подтвердить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
