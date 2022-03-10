<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" lang="de">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Ticketsystem | Login</title>
</head>

<body>
    
    <br>
    <div class="text-center">
        <h1>Please Login</h1>
    </div>
    @if($login->status == 0)
    <div class="text-center">
        <p>If you don't have an account yet please contact a member of our staff</p>
    </div>
    
    <br>
    <div class="card card-shadow col-md-3">
        <div class="card-body">
            <h5 class="card-title text-center">Login</h5>
            <form method="POST" action="/login">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @elseif($login->status == 1)
        <br>
        <div class="row">
            <div class="card card-shadow col-md-5">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item col-md-6">
                            <a class="nav-link active" href="/">Login</a>
                        </li>
                        <li class="nav-item col-md-6">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                    </ul>
                    <br>
                    <h5 class="card-title text-center">Login</h5>
                    <form method="POST" action="/login">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>
