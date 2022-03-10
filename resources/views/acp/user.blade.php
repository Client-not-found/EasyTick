    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | User management</title>
    </header>

    <body>
        <br>
        <ul class="nav nav-tabs">
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
        </ul>
        <br>
        <div class="text-center">
            <h4>User Management</h4>
            <p>Here you can create new users and edit and delete existing ones.</P>
        </div>
        <br>
        @can('create', App\User::class)
        <button type="button" class="btn btn-success" @click="newUser">Create new user</button>
        @endcan
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                </tr>
            </thead>
        </table>
        @foreach($users as $user)
        <div class="list-group-item list-group-item-action" aria-current="true">
            <a href="/user/{{$user->key}}">
                <div class="row">
                    <b class="col-md-2">{{$user->key}}</b>
                    <p class="col-md-5">{{$user->firstname}}</p>
                    <p class="col-md-5">{{$user->lastname}}</p>
                </div>
            </a>
        </div>
        @endforeach

    </body>

    @endsection
