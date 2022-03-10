<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" lang="de">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Ticketsystem | Login</title>
</head>

<style>
    .card {
        margin: 0 auto;
        /* Added */
        float: none;
        /* Added */
        margin-bottom: 10px;
        /* Added */
    }

</style>
<body>
    <br>
    <div class="text-center">
        <h1>Please Login</h1>
    </div>
    <br>
    <div class="card card-shadow col-md-5">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item col-md-6">
                    <a class="nav-link" href="/">Login</a>
                </li>
                <li class="nav-item col-md-6">
                    <a class="nav-link active" href="/new">Register</a>
                </li>
            </ul>
            <br>
            <h5 class="card-title text-center">Register</h5>
            <br>
            <form method="POST" action="/save">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password confirm</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation">
                    </div>
                </div>
                <br>
                <div class="form-group col-md-12">
                    <label for="mail">Email</label>
                    <input type="email" class="form-control" id="mail" name="mail" placeholder="example@example.ch" required>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Max" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Mustermann" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="street">Street / Nr.</label>
                        <input type="text" class="form-control" id="street" name="street" placeholder="Musterstrasse 1" required>
                    </div>
                    <div class="col-md-6">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Switzerland" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="zip">ZIP</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="0000" required>
                    </div>
                    <div class="col-md-8">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Basel" required>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Register</button>
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
</body>
</html>
