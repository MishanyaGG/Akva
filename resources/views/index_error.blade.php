@extends('shapka')

@section('title')
    Главная страница
@endsection

@section('ul-nav-start')
    <li><a href="{{route('index')}}" class="nav-link px-2 text-secondary">Главная страница</a></li>
    <li><a href="{{route('contact')}}" class="nav-link px-2 text-white">Контактные данные</a></li>
@endsection

@section('ul-nav-end')
    <li><a href="{{route('index')}}" class="nav-link px-2 text-secondary">Главная страница</a></li>
    <li><a href="{{route('contact')}}" class="nav-link px-2 text-white">Контактные данные</a></li>
@endsection

@section('text-end')
    @if($cc == false && $id==0)
        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" class="btn btn-outline-light me-2">Войти</button>
        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample2" aria-controls="offcanvasExample2" class="btn btn-warning me-2">Зарегистрироваться</button>
    @else
        @foreach($db as $d)

            @section('ul-nav-start')
                <li><a href="{{route('index')}}" class="nav-link px-2 text-secondary">Главная страница</a></li>
                <li><a href="{{route('contact')}}" class="nav-link px-2 text-white">Контактные данные</a></li>
            @endsection

            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{$d->last_name}} {{$d->first_name}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('leave')}}">Выйти</a></li>
                </ul>
            </div>
        @endforeach
    @endif
@endsection

@section('main')
    @if($error_login == "login")
        <div class="alert alert-danger">
            Неверный логин или пароль
        </div>
    @elseif($error_login == "register")
        <div class="alert alert-danger">
            Такое имя пользователя занято
        </div>
    @endif

    <div class="container boy-main">
        <div class="row">
            <div class="col order-first text-light">
                <p class="fs-1">Добро пожаловать в мир водных приключений!</p>
                <p class="fs-5">
                    Мы рады пригласить Вас в уникальный для нашего города развлекательный центр, на территории которого круглый год царит его величество Лето!
                </p>
            </div>
            <div class="col order-last text-light">
                <img width="400" src="{{asset('/img/boy.jpg')}}">
            </div>
        </div>
    </div>

    <div class="menu-ind">
        <div class="col-md-5">
            <div class="h-100 p-5 bg-men rounded-5">
                <div class="bg-men-1">
                    <h2>Каждая из наших горок подарит Вам совршенно разные ощущения и эмоции!</h2>
                    <p>Гарантированный выброс адреналина обеспечит экстремально-скоростной, захватывающий дух спуск с самой короткой, но при этом самой крутой горки «Барракуда». Катание на ее прямой трассе можно сравнить с прыжком в пропасть со скоростью свободного падения! Но если даже Вам покажется, что Вы уже летите — не пугайтесь, это только кажется!</p>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="h-100 p-5 bg-men rounded-5">
                <h2>Вода из бассейна проходит 3 степени очистки</h2>
                <p>1. Механическая очистка <br>2. Обеззараживание <br>3. Химическая очистка</p>
                <h2>Помимо столь популярных водных горок гостей ждет и немало приятных сюрпризов в большом бассейне.</h2>
                <p>К примеру, линия мощного гидромассажа, несколько бурлящих гейзеров и необычных водопадов, система противотоков и длинный закрытый грот с искусственной рекой.</p>
            </div>
        </div>
    </div>
@endsection
