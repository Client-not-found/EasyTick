@extends('layout.app')

@section('content')
<header>
    <title>Ticketsystem | Departement management</title>
</header>

<body>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="/acp">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/usermanagement">User management</a>
        </li>
        @can('create', App\Departement::class)
        <li class="nav-item">
            <a class="nav-link active" href="/departement">Departement</a>
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
        <h4>Departement Management</h4>
        <p>Here you can create new Departements and edit and delete existing ones.</P>
    </div>
    <br>
    <button type="button" class="btn btn-success" @click="newDepartement">Create new Departement</button>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
    </table>
    @foreach($departements as $departement)
    <div class="list-group-item list-group-item-action" aria-current="true">
        <a href="/departement/{{$departement->key}}">
            <div class="row">
                <b class="col-md-2">{{$departement->key}}</b>
                <p class="col-md-5">{{$departement->name}}</p>
                @if($departement->active === 1)
                <p class="col-md-5">Enabled</p>
                @else
                <p class="col-md-5">Disabled</p>
                @endif
            </div>
        </a>
    </div>
    @endforeach
</body>
@endsection
