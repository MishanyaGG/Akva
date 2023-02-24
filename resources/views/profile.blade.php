@extends('shapka')

@section('title')
    Контакты
@endsection

@section('ul-nav-start')
    <li><a href="{{route('index')}}" class="nav-link px-2 text-white">Главная страница</a></li>
    <li><a href="{{route('contact')}}" class="nav-link px-2 text-white">Контактные данные</a></li>
@endsection

@section('ul-nav-end')
    <li><a href="{{route('index')}}" class="nav-link px-2 text-white">Главная страница</a></li>
    <li><a href="{{route('contact')}}" class="nav-link px-2 text-white">Контактные данные</a></li>
@endsection

@section('text-end')
    @foreach($db as $d)
        <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{$d->last_name}} {{$d->first_name}}
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('profile')}}">Профиль</a></li>
                <li><a class="dropdown-item" href="{{route('leave')}}">Выйти</a></li>
            </ul>
        </div>
    @endforeach
@endsection

@section('main')
    <div class="profile">
        @foreach($db as $d)
            <h1>Профиль: <strong>{{$d->last_name}} {{$d->first_name}}</strong></h1>
            <h3>Имя пользователя: {{$d->name_user}} <br>
                Номер телефона: {{$d->phone}} <br>
                Почта: {{$d->pochta}}</h3>
            <h5>Купленных билетов нет</h5>
        @endforeach
    </div>
@endsection
