<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
</head>
<body class="text-center pt-40 pb-40">
    <div class="form-signin">
    <!-- Форма отправляющая данные в контроллер -->
    <form method="POST" action="{{ route('user.login') }}" class="mt-5 mb-5">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <div class="form-floating">
            <input id="floatingInput" class="form-control" name="email" type="email" placeholder="Email" >
            <label for="floatingInput">Email address</label>
            @error('email')
            <div > {{$message}} </div>
            @enderror
        </div>
        <div class="form-floating">
            <input id="floatingInput" class="form-control" name="password" type="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
        @error('password')
        <div>{{ $message }}</div>
        @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-lg btn-primary" type="submit" >Войти</button>
        </div>
    </form>
    <a href="/registration">Register </a>
</div>
    
</body>
</html>