@php
    use Illuminate\Support\Carbon;
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Приватка</title>
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="container">
            <!-- Проверка есть ли сообщения об успехе в сессии -->
    @if(session()->has('success'))
        <div class="alert alert-success mt-5">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="mt-5"> 
    <a class="btn btn-lg btn-primary" href="{{ route('logout.all') }}">End All Sessions</a>
    </div>
    <!-- цикл во всех сессиях которые были получены из контроллера SessionController -->
    @foreach ($sessions as $session)
    <p class="lead"> 
        ip : {{$session->ip_address}} 
        date : {{Carbon::createFromTimestamp($session->last_activity)}}
        <a class="btn btn-lg btn-primary" href="{{ route('logout.by.ip', ['id' => $session->id, ,'ip' => $session->ip_address]) }}">End Session</a>
    </p>
    @endforeach


    <a class="btn btn-lg btn-primary" href="/logout">Logout</a>
        </div>
        </main>
</body>
</html>