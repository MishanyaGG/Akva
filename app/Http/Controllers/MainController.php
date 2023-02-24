<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    // Главаня страница
    public function index(){

        // Проверка на существование входящего пользователя в аккаунт

        if(isset($_SESSION['user']))
        {
            $id = $_SESSION['user'];
            $db = DB::table('Pols')->where('id','=',$id)->get();
        }
        else{
            $db = DB::table('Pols')->get();
            $id = 0;
        }

        return view('index',['cc'=>false,'id'=>$id,'db'=>$db,'key'=>false]);
    }

    public function error(){

        return view('index_error',['id'=>0,'cc'=>false,'error_login'=>$_SESSION['error']]);
    }

    // Страница КОНТАКТЫ
    public function contact(){

        // Проверка на существование входящего пользователя в аккаунт

        if(isset($_SESSION['user']))
        {
            $id = $_SESSION['user'];
            $db = DB::table('Pols')->where('id','=',$id)->get();
        }
        else{
            $db = DB::table('Pols')->get();
            $id = 0;
        }

        return view('contact',['cc'=>false,'id'=>$id,'db'=>$db]);
    }

    // ОБРАБОТКА ВХОД
    public function login(Request $rq){

        // Получение данных из формы

        $user = $rq->input('user');
        $pass = $rq->input('pass');

        // Валидация

        $validate = $rq->validate([
            'user'=>['required'],
            'pass'=>['required'],
        ]);

        // Проверка на правильность введённых данных

        $db = DB::table('Pols')
            ->where('name_user','=',$user)
            ->orWhere('pochta','=',$user)
            ->where('password','=',$pass)
            ->get();

        if (count($db) != 0){
            foreach ($db as $d)
            $_SESSION['user']=$d->id;

            return redirect()->route('index');
        }
        else{
            $_SESSION['error'] = "login";
            return redirect()->route('error');
        }
    }

    // ОБАБОТКА РЕГИСТРАЦИИ
    public function register(Request $rq){

        // Получение данных из формы

        $last_name = $rq->input('last_name');
        $first_name = $rq->input('first_name');
        $name_user = $rq->input('name_user');
        $pochta = $rq->input('pochta');
        $pass = $rq->input('pass');

        // Валидация

        $validate = $rq->validate([
            'last_name'=>['required'],
            'first_name'=>['required'],
            'name_user'=>['required'],
            'pochta'=>['required'],
            'pass'=>['required']
        ]);

        // Проверка на уникальность имени пользователя

        $db = DB::table('Pols')
            ->where('name_user','=',$name_user)
            ->orWhere('pochta','=',$pochta)
            ->where('password','=',$pass)
            ->get();

        if(count($db)!=1){
            $db = DB::table('Pols')->insert([
                'last_name'=>$last_name,
                'first_name'=>$first_name,
                'name_user'=>$name_user,
                'pochta'=>$pochta,
                'password'=>$pass
            ]);

            $db = DB::table('Pols')
                ->where('name_user','=',$name_user)
                ->orWhere('pochta','=',$pochta)
                ->where('password','=',$pass)
                ->get();

            foreach ($db as $d)
                $_SESSION['user']=$d->id;

            return view('index',['cc'=>true,'db'=>$db,'key'=>true]);
        }
        else{
            $_SESSION['error'] = "register";

            return redirect()->route('error');
        }

    }

    // Метод выхода из акка
    public function leave(){

        $_SESSION['user'] = 0;

        return redirect()->route('index');
    }
}
