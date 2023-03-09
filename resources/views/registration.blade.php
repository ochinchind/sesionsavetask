<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body class="text-center">
    <div class="form-signin">
    <!-- Форма отправляющая данные в контроллер -->
    <form method="POST" action="{{ route('user.registration') }}" class="mt-5 mb-5">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Please register</h1>
        <div class="form-floating"> 
            <input id="floatingInput" class="form-control" name="name" type="text" placeholder="Name" >
            <label for="floatingInput">Имя</label>
            @error('name')
            <div> {{$message}} </div>
            @enderror
        </div>
        <div class="form-floating">
            <input id="floatingInput" class="form-control" name="email" type="text" placeholder="Email" >
            <label for="floatingInput">Ваш e-mail</label>
        @error('email')
        <div> {{$message}} </div>
        @enderror
        </div>
        <div class="form-floating">
            <input id="floatingInput" class="form-control" name="password" type="password" placeholder="Password">
            <label for="floatingInput">Пароль</label>
        @error('password')
        <div>{{ $message }}</div>
        @enderror
        </div>
        <div>
            <button class="btn btn-lg btn-primary" type="submit" >Регистрация</button>
        </div>
    </form>
    <a  href="/login">Login </a>
    </div>
</body>
</html>