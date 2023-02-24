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
            $db = DB::table('Pols')->where('id','=',$_SESSION['user'])->get();
        }
        else{
            $db = DB::table('Pols')->get();
            $id = 0;
        }

        return view('index',['cc'=>false,'id'=>$id,'db'=>$db,'key'=>false,'buy'=>$_SESSION['error']]);
    }

    public function error(){

        $db = DB::table('Pols')->where('id','=',$_SESSION['user'])->get();

        return view('index_error',['id'=>0,'cc'=>false,'db'=>$db,'error_login'=>$_SESSION['error']]);
    }

    // Страница КОНТАКТЫ
    public function contact(){

        $_SESSION['error'] = null;

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

    // Страница КОНТАКТЫ
    public function profile(){

        $_SESSION['error'] = null;

        $db = DB::table('pols')
            ->where('id','=',$_SESSION['user'])
            ->get();

        $bilets = DB::table('bilet')
            ->where('user_id','=',$_SESSION['user'])
            ->get();

        $count = count($bilets);

        return view('profile',['db'=>$db,'bilets'=>$bilets,'count'=>$count]);

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

        $_SESSION['error'] = null;

        // Получение данных из формы

        $last_name = $rq->input('last_name');
        $first_name = $rq->input('first_name');
        $name_user = $rq->input('name_user');
        $phone = $rq->input('phone');
        $pochta = $rq->input('pochta');
        $pass = $rq->input('pass');

        // Валидация

        $validate = $rq->validate([
            'last_name'=>['required'],
            'first_name'=>['required'],
            'name_user'=>['required'],
            'phone'=>['required'],
            'pochta'=>['required'],
            'pass'=>['required']
        ]);

        // Проверка на уникальность имени пользователя

        $db = DB::table('Pols')
            ->where('name_user','=',$name_user)
            ->orWhere('pochta','=',$pochta)
            ->get();

        if(count($db)!=1){
            $db = DB::table('Pols')->insert([
                'last_name'=>$last_name,
                'first_name'=>$first_name,
                'name_user'=>$name_user,
                'phone'=>$phone,
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

            return view('index',['cc'=>true,'db'=>$db,'buy'=>$_SESSION['error'],'key'=>true]);
        }
        else{
            $_SESSION['error'] = "register";

            return redirect()->route('error');
        }

    }

    public function bilet(Request $rq){

        $kid = $rq->input('kid');
        $old = $rq->input('old');
        $date = $rq->input('date');

        $rq->validate([
           'kid'=>'required',
           'old'=>'required',
           'date'=>'required'
        ]);

        if ($kid !=0){
            for ($i = 1; $i<=$kid; $i++){
                DB::table('bilet')->insert([
                    'tarif'=>"Детский",
                    'price'=>350,
                    'date'=>$date,
                    'user_id'=>$_SESSION['user']
                ]);
            }
        }

        if ($old !=0){
            for ($i = 1; $i<=$old; $i++){
                DB::table('bilet')->insert([
                    'tarif'=>"Взрослый",
                    'price'=>800,
                    'date'=>$date,
                    'user_id'=>$_SESSION['user']
                ]);
            }
        }
        if ($kid == 0 && $old == 0){

            $_SESSION['error']="bilet";

            return redirect()->route('error');
        }

        $_SESSION['error'] = "sucess_buy";
        return redirect()->route('index');
    }

    // Метод выхода из акка
    public function leave(){

        $_SESSION['user'] = 0;

        return redirect()->route('index');
    }
}
