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
            <h4>Create new User</h4>
            <p>Here you can create a new user.</P>
        </div>
        <br>
        <div class="card col-md-6 offset-md-3">
            <div class="card-body">
                <form method="post" action="/user">
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
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-outline-success">Send</button>
                        </div>
                    </div>
                </form>
            </div>
            <br>
        </div>
        <br>
        <br>
    </body>
    @endsection
