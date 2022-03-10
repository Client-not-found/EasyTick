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
    
    <div class="container">
        <div class="alert alert-danger text-center" role="alert">Your website has not been activated yet. Enter your license key</div>
            <form method="POST" action="/ok">
                @csrf
                <label for="inputPassword5" class="form-label">License key:</label>
                <input type="license" id="license" name="license" class="form-control">
                <br>
                <button type="submit" class="btn btn-success">Success</button>
            </form>
        </div>
    </div>
</body>