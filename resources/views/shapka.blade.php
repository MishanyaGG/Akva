<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                @yield('ul-nav-start')
            </ul>

            <div class="text-end">
                @yield('text-end')
            </div>
        </div>
    </div>
</header>

@if($errors->any())
    <div class="alert alert-danger">
        Вы не ввели некоторые поля
    </div>
@endif

@if (isset($key))
    @if ($key==true)
        <div class="alert alert-success">
            Успешная регистрация
        </div>
   @endif
@endif

@yield('main')

<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            @yield('ul-nav-end')
        </ul>
        <p class="text-center text-light">Разработчик Титов Михаил 3-1 ИС</p>
    </footer>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Вход</h5>
    </div>

    <div class="offcanvas-body">
        <form action="{{route('login')}}" method="post">
            @csrf

            <input type="text" class="form-label" aria-describedby="emailHelp" name="user" placeholder="Имя пользоватлея или почта">
            <br>
            <input type="password" name="pass" placeholder="Пароль">
            <div class="dropdown mt-3">
                <button class="btn btn-primary" type="submit">
                    Войти
                </button>
            </div>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample2" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Регистрация</h5>
    </div>

    <div class="offcanvas-body">
        <form action="{{route('register')}}" method="post">
            @csrf

            <input type="text" class="form-label" aria-describedby="emailHelp" name="last_name" placeholder="Фамилия">

            <br>

            <input type="text" class="form-label" aria-describedby="emailHelp" name="first_name" placeholder="Имя">

            <input type="text" class="form-label" aria-describedby="emailHelp" name="name_user" placeholder="Имя пользоватлея">

            <br>
                <input type="email" class="form-label" aria-describedby="emailHelp" name="pochta" placeholder="Почта">
            <br>

            <input type="password" name="pass" placeholder="Пароль">

            <div class="dropdown-reg mt-3">
                <button class="btn btn-primary" type="submit">
                    Зарегистрироваться
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
