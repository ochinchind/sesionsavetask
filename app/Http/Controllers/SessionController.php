<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function endAllSessionsExceptCurrent()
    {
        // Получаем текущий идентификатор сеанса
        $currentSessionId = session()->getId();
        // получаем идентификатор пользователя по идентификатору сеанся
        $userId = DB::table('sessions')->where('id', $currentSessionId)->value('user_id');

        // Получаем все идентификаторы сессий связанные с этим идентификатором пользователя
        $sessionIds = DB::table('sessions')
                ->where('user_id', $userId)
                ->pluck('id');

        // Цикл по идентификаторам сессий
        foreach ($sessionIds as $sessionId) {
            // Сравниваем идентификатор сеанса с идентификатором текущего сеанса
            if ($sessionId != $currentSessionId) {
                // удаляем сессию если это не текущая сессия
                Session::getHandler()->destroy($sessionId);
            }
        }

        // Редайректимся обратно с сообщением об успехе
        return redirect()->back()->with('success', 'All sessions except the current one have been ended.');
    }

    public function logoutByIp($ip)
    {
        // Получаем идентификатор сеанса для IP-адреса пользователя
        $sessionId = DB::table('sessions')->where('ip_address', $ip)->value('id');
        // Если для IP-адреса был найден идентификатор сеанса, удаляем данные сеанса
        if ($sessionId) {
            Session::getHandler()->destroy($sessionId);
        }
        return redirect()->back()->with('success', 'Session ended for IP: ' . $ip);
    }
}
