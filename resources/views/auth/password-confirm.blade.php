@extends('layout.app')

@section('content')
<header>
    <title>Ticketsystem | Confirm Password</title>
</header>
<body>
    <div class="container">
        <br>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/profile/{{auth()->user()->key}}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/security">Security</a>
            </li>
        </ul>
        <br>
        <div class="text-center">
            <h4>Enter your password</h4>
        </div>
        <br>
        <div class="card col-md-6 offset-md-3">
            <div class="card-body">
                <form method="POST" action="{{ url('user/confirm-password') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="password" class="sr-only">Password</label>
                        <input tpye="password" name="password" id="password" class="form-control">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input name="confirm" id="confirm" class="btn btn-primary btn-block login-btn mb-4" type="submit">
                </form>
            </div>
        </div>
    </div>
    @endsection
