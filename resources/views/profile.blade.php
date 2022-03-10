    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | Profile</title>
    </header>
    <body>
        <br>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="/profile/{{auth()->user()->key}}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/security">Security</a>
            </li>
        </ul>
        <br>
        <div class="text-center">
            <h4>Profile</h4>
            <p>Here you can edit your profile information.</p>
        </div>
        <br>
        <div class="card card-shadow col-md-6 offset-md-3">
            <div class="card-body">
                <form method="post" action="/profilesave/{{auth()->user()->key}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-md-12">
                        <label for="mail">Email</label>
                        <input type="email" class="form-control" id="mail" name="mail" value="{{$user->mail}}" required disabled>
                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{$user->firstname}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user->lastname}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="street">Street / Nr.</label>
                            <input type="text" class="form-control" id="street" name="street" value="{{$user->street}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{$user->state}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="zip">ZIP</label>
                            <input type="text" class="form-control" id="zip" name="zip" value="{{$user->zip}}" required>
                        </div>
                        <div class="col-md-8">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{$user->city}}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-warning">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endsection
