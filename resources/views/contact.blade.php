@extends('shapka')

@section('title')
    Контакты
@endsection

@section('ul-nav-start')
    <li><a href="{{route('index')}}" class="nav-link px-2 text-white">Главная страница</a></li>
    <li><a href="{{route('contact')}}" class="nav-link px-2 text-secondary">Контактные данные</a></li>
@endsection

@section('ul-nav-end')
    <li><a href="{{route('index')}}" class="nav-link px-2 text-white">Главная страница</a></li>
    <li><a href="{{route('contact')}}" class="nav-link px-2 text-secondary">Контактные данные</a></li>
@endsection

@section('text-end')
    @if($cc == false && $id ==0)
        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" class="btn btn-outline-light me-2">Войти</button>
        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample2" aria-controls="offcanvasExample2" class="btn btn-warning me-2">Зарегистрироваться</button>
    @else
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
    @endif
@endsection

@section('main')
    <div class="contact">
        <p>Мэнеджер - Титов Михаил Александрович</p>
        <h1>+7 (964) 154 34 76</h1>
        <h3>mischatitovmail.ru@gmail.com</h3>
    </div>
@endsection
