<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(){

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

    public function contact(){

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

    public function login(Request $rq){

        $user = $rq->input('user');
        $pass = $rq->input('pass');

        $validate = $rq->validate([
            'user'=>['required'],
            'pass'=>['required'],
        ]);

        $db = DB::table('Pols')
            ->where('name_user','=',$user)
            ->orWhere('pochta','=',$user)
            ->where('password','=',$pass)
            ->get();

        foreach ($db as $d)
            $_SESSION['user']=$d->id;

        return view('index',['cc'=>true,'db'=>$db]);
    }

    public function register(Request $rq){

        $last_name = $rq->input('last_name');
        $first_name = $rq->input('first_name');
        $name_user = $rq->input('name_user');
        $pochta = $rq->input('pochta');
        $pass = $rq->input('pass');

        $validate = $rq->validate([
            'last_name'=>['required'],
            'first_name'=>['required'],
            'name_user'=>['required'],
            'pochta'=>['required'],
            'pass'=>['required']
        ]);

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

    public function leave(){
        $_SESSION['user'] = 0;

        return redirect()->route('index');
    }
}
