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
    @if($cc == false && $id==0 && $error_login!="bilet")
        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" class="btn btn-outline-light me-2">Войти</button>
        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample2" aria-controls="offcanvasExample2" class="btn btn-warning me-2">Зарегистрироваться</button>

        @section('main')

            @if($error_login == "login")
                <div class="alert alert-danger">
                    Неверный логин или пароль
                </div>
             @elseif($error_login == "register")
                <div class="alert alert-danger">
                    Такое имя пользователя или почта уже занята
                </div>
            @endif

            <div class="container col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="{{asset('/img/boy.jpg')}}">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-3 text-light">Добро пожаловать в мир водных приключений!</h1>
                        <p class="lead text-light">Мы рады пригласить Вас в уникальный для нашего города развлекательный центр, на территории которого круглый год царит его величество Лето!</p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" class="btn btn-primary btn-lg px-4 me-md-2" >Купить билет</button>
                            </div>
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
                    <li><a class="dropdown-item" href="{{route('profile')}}">Профиль</a></li>
                    <li><a class="dropdown-item" href="{{route('leave')}}">Выйти</a></li>
                </ul>
            </div>
        @endforeach

        @section('main')

            @if($error_login=="bilet")
                 <div class="alert alert-danger">
                    Нельзя заказать НИЧЕГО, выберите один из товаров
                </div>
            @endif

            <div class="container col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="{{asset('/img/boy.jpg')}}">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-3 text-light">Добро пожаловать в мир водных приключений!</h1>
                        <p class="lead text-light">Мы рады пригласить Вас в уникальный для нашего города развлекательный центр, на территории которого круглый год царит его величество Лето!</p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Купить билет</button>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Покупка билета</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">

                        <form action="{{route('bilet')}}" method="post">

                            @csrf
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Детский</td>
                                    <td>350р</td>
                                    <td><input type="number" value="0" name="kid" placeholder="0" min="0" max="5" class="tb-inp"></td>
                                </tr>
                                <tr>
                                    <td>Взрослый</td>
                                    <td>800р</td>
                                    <td><input type="number" value="0" name="old" placeholder="0" min="0" max="5" class="tb-inp"></td>
                                </tr>
                                <tr>
                                    <td>На какой день?</td>
                                    <td><input class="tb-inp-date" type="date" name="date"></td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Купить</button>
                        </div>
                    </div>
                    </form>
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
    @endif
@endsection
