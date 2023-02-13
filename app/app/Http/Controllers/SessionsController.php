<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller
{
    //
    public function create (){
        return view ('auth.login');
    }

    public function store (){
       
        return redirect()->to('/');
    }

    public function destroy (){
        auth()->logout();
        return redirect()->to('/');
    }

    public function recovery (){
       
        return view('auth.recovery');
    }

    public function recoverypost (){
       
        $email = request('email');
        $password = request('password');
        $password_repea = request('password_repeat');

        if ($password == $password_repea)  {
            
            update();
        }
       
    }
}
