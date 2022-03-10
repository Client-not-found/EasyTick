    @extends('layout.app')

    @section('content')
    <header>
        <title>Ticketsystem | Knowledge Base</title>
    </header>

    <body>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <br>
                    <div class="text-center">
                        <h4>{{$all->topic}}</h4>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2">Username</h6>
                        <p class="card-text">{{$all->username}}</p>
                        <h6 class="card-subtitle mb-2">Benutzergruppe</h6>
                        <p class="card-text">{{$all->name}}</p>
                        @can('delete', App\Article::class)
                        <hr>
                        <form method="post" action="/deleteArticle/{{$article->key}}">
                            @csrf
                            <div class="col-md-2">
                                <button type="submit" @click="artDelete" class="btn btn-outline-danger">Delete</button>
                            </div>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{{$article->message}}</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    @endsection
