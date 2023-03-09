<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function save(Request $request){
        //проверка если пользователь уже авторизован
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        //Проверка введенной формы и берем значения
        $validateFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required',
        ]);
        //если имейл существует, то редайректим на регистрационную страницу и показываем ошибку
        if(User::where('email', $validateFields['email'])->exists()){
            return redirect(route('user.registration'))->withErrors([
                'email'=> 'Такой пользователь уже зарегистрирован'
            ]);
        }
        //создаем нового пользователя с данными которые он ввел в форму
        $user = User::create($validateFields);
        //проверка если пользователь создан
        if($user){
            //авторизация
            Auth::login($user);
            return redirect(route('user.private'));
        }
        //в случае ошибок переводим пользователя на логин страницу и показываем ошибку
        return redirect(route('user.login'))->withErrors([
            'formError'=>'Произошла ошибка при сохранении пользователя'
        ]);

    }



}
