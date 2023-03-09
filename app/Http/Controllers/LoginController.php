<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //функция логина
    public function login(request $request){
        //Проверка если пользователь уже зашел
        if(Auth::check()){
            return redirect()->intended(route('user.private'));
        }
        //Берем имейл и пароль которые пользователь ввел в форме
        $formFields = $request->only(['email', 'password']);
        //Проверка если получилось авторизоваться
        if(Auth::attempt($formFields)){
            //берем айпи пользователя
            $getip = $_SERVER['REMOTE_ADDR'];
            //берем айди авторизованного пользователя
            $user_id = Auth::user()->id;
            //помещаем в сессию айди и айпи (оно сразу запишется в таблице)
            session()->put([
                'user_id', $user_id, 
                'ip_address', $getip
            ]);
            //редайректимся на кабинет пользователя
            return redirect()->intended(route('user.private'));
        }
        //в случае если авторизоваться не удалось показываем ошибку и переходим обратно на логин страницу
        return redirect(route('user.login'))->withErrors([
            'email' => 'Не удалось авторизоваться'
        ]);
    }
}
