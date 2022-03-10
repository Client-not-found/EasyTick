    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | New User</title>
    </header>

    <body>
        <br>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/acp">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/usermanagement">User management</a>
            </li>
            @can('create', App\Departement::class)
            <li class="nav-item">
                <a class="nav-link" href="/departement">Departement</a>
            </li>
            @endcan
            @can('create', App\Category::class)
            <li class="nav-item">
                <a class="nav-link" href="/knowledgemanagement">Knowledge base management</a>
            </li>
            @endcan
            @can('create', App\Page::class)
            <li class="nav-item">
                <a class="nav-link" href="/settings">Settings</a>
            </li>
            @endcan
        </ul>
        <br>
        <div class="text-center">
            <h4>Edit User</h4>
            <p>Here you can edit the user.</P>
        </div>
        <br>
        <div class="card col-md-6 offset-md-3">
            <div class="card-body">
                <form method="post" action="/edit/{{$user->key}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-md-12">
                        <label for="mail">Email</label>
                        <input type="email" class="form-control" id="mail" name="mail" value="{{$user->mail}}" required>
                    </div>
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
                        <div class="col-md-6">
                            <label for="group">Permission Group</label>
                            <select class="form-control" id="group" name="group" required>
                                @foreach($groups as $group)
                                <option value="{{$group->key}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-warning">Edit</button>
                        </div>
                    </div>
                </form>
                <br>
                <form method="post" action="/delete/{{$user->key}}">
                    @csrf
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </div>
                </form>
            </div>
            <br>
        </div>
        <br>
        <br>
    </body>
    @endsection
