<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        //проверка если уже авторизован
        if(!Auth::check()){
            return redirect()->intended(route('user.login'));
        }
        //получаем идентификатор пользователя
        $userId = Auth::user()->id;
        //берем все сессии связанные с пользователем 
        $sessions = DB::table('sessions')->get()->where('user_id', $userId);
        //передаем все сессиии которые мы нашли
        return view('private', ['sessions' => $sessions]);
    }
}
