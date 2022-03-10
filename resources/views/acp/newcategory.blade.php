@extends('layout.app')

@section('content')
<header>
    <title>Ticketsystem | New Category</title>
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
            <a class="nav-link" href="/departement">Departement</a>
        </li>
        @endcan
        @can('create', App\Category::class)
        <li class="nav-item">
            <a class="nav-link active" href="/knowledgemanagement">Knowledge base management</a>
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
        <h4>Create new Category</h4>
        <p>Here you can create a new category.</P>
    </div>
    <br>
    <div class="card card-center col-md-6 offset-md-3">
        <div class="card-body">
            <form method="post" action="/knowledgemanagement">
                @csrf
                <div class="form-group">
                    <label for="category">Category Name</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="active" name="active" required>
                        <option value="1">Enabled</option>
                        <option value="2">Disabled</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-success">Send</button>
            </form>
        </div>
    </div>
</body>

@endsection
