<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//выход из сессии по IP 
Route::get('/logout-by-ip/{ip}', [App\Http\Controllers\SessionController::class, 'logoutByIp'])->name('logout.by.ip');
//Выход из всех сессий кроме текущей
Route::get('/logout-all/', [App\Http\Controllers\SessionController::class, 'endAllSessionsExceptCurrent'])->name('logout.all');
//группа всех роутеров которые связаны с пользователем
Route::name('user.')->group(function(){
    //личный кабинет
    Route::get('/private', [\App\Http\Controllers\UsersController::class, 'index'])->name('private');
    //если пользователь уже аутентифицирован, он перенаправляет в личный кабинет. Если нет, он возвращает представление входа в систему
    Route::get('/login', function(){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        return view('login');
    })->name('login');
    //авторизация
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
    //выход из текущей сессии
    Route::get('/logout',function(){
        Auth::logout();
        return redirect('/');
    })->name('logout');
    //если пользователь зарегистрирован, то перенаправляет в личный кабинет. если нет, то на регистрацию
    Route::get('/registration', function(){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        return view('registration');
    })->name('registration');
    //регистрация
    Route::post('/registration', [App\Http\Controllers\RegisterController::class, 'save']);

});
//перенаправляет пустую ссылку на логин
Route::get('/', function () {
    return redirect('/login');
});
